<?php


namespace Barryvdh\LaravelIdeHelper;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class MigrationQueryRecorder
{
    /** @var Collection|string[] */
    protected $table_model_map;
    /** @var Collection|string[] */
    protected $queries;
    /** @var bool  */
    protected $recording = false;

    public function __construct()
    {
        $this->queries = collect();
        $this->table_model_map = $this->resolveModels();
    }

    /**
     * Record an executed query
     * @param  string  $sql
     */
    public function recordQuery(string $sql)
    {
        $this->queries->push($sql);
    }

    /**
     * @return Collection
     */
    public function getAffectedModels(): Collection
    {
        $models = collect();
        foreach ($this->queries as $query) {
            if (preg_match_all('/(?:create|alter) table [\'"`]?(\w*)[\'"`]/i', $query, $matches)) {
                $modified_tables = array_unique($matches[1]);
                foreach ($modified_tables as $modified_table) {
                    $model = $this->resolveModel($modified_table);
                    if ($model && !$models->contains($model)) {
                        $models->push($model);
                    }
                }
            }
        }
        return $models;
    }

    /**
     * @param  string  $table
     * @return string|null
     */
    private function resolveModel(string $table)
    {
        return $this->table_model_map->get($table);
    }

    private function resolveModels(): Collection
    {
        $app_files = Finder::create()->in(app_path())->name('*.php');
        $namespace = app()->getNamespace();
        $map = collect();
        /** @var SplFileInfo $app_file */
        foreach ($app_files as $app_file) {
            $path = $app_file->getRelativePathname();
            $fqn = '\\'.$namespace.preg_replace_callback([
                    '/\//',
                    '/\.php/'
                ], static function ($match) {
                    if ($match[0] === '/') {
                        return '\\';
                    }
                    return '';
                }, $path);
            try {
                $reflection = new ReflectionClass($fqn);
                if ($reflection->isSubclassOf(Model::class)) {
                    /** @var Model $model */
                    $model = new $fqn;
                    $table = $model->getTable();
                    $map->put($table, $fqn);
                }
            } catch (ReflectionException $e) {
            }
        }
        return $map;
    }

    /**
     * @return bool
     */
    public function isRecording(): bool
    {
        return $this->recording;
    }

    /**
     * @param  bool  $recording
     */
    public function setRecording(bool $recording)
    {
        $this->recording = $recording;
    }
}
