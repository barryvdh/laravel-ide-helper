<?php

namespace Barryvdh\LaravelIdeHelper\DocBlock;

use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlock\TagFactory;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\TypeResolver;
use phpDocumentor\Reflection\Types\Context;

class DocBlockBuilder
{
    /** @var $tagFactory TagFactory  */
    private $tagFactory = null;

    private function __construct(
        protected string $summary = '',
        protected ?DocBlock\Description $description = null,
        protected array $tags = [],
        protected ?Context $context = null
    ) {
    }

    public static function createFromReflector(\Reflector $reflector, ?Context $context = null): static
    {
        if ($doc = $reflector->getDocComment()) {
            $docblock = DocBlockFactory::createInstance()->create($doc, $context);

            return new static(
                $docblock->getSummary(),
                $docblock->getDescription(),
                $docblock->getTags(),
                $docblock->getContext()
            );
        }

        return static::create('', null, [], $context);
    }

    public static function create(
        string $summary = '',
        ?DocBlock\Description $description = null,
        array $tags = null,
        ?Context $context = null
    ): static {
        return new static($summary, $description, $tags, $context);
    }

    public function getDocBlock(): DocBlock
    {
        $tags = collect($this->tags)->unique(function (Tag $tag) {
            if (method_exists($tag, 'getVariableName')) {
                return $tag->getName() . ' ' . $tag->getVariableName();
            }
            return (string) $tag;
        })->toArray();

        return new DocBlock($this->summary, $this->description, $tags, $this->context);
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary)
    {
        $this->summary = $summary;
    }

    public function getDescription(): ?DocBlock\Description
    {
        return $this->description;
    }

    public function setDescription(?DocBlock\Description $description)
    {
        $this->description = $description;
    }

    public function getContext()
    {
        return $this->context;
    }
    public function getTags()
    {
        return $this->tags;
    }

    public function appendTagline(string $tagline)
    {
        $tag = $this->getTagFactory()->create($tagline, $this->context);

        $this->appendTag($tag);
    }

    public function hasTag(string $name): bool
    {
        /** @var Tag $tag */
        foreach ($this->tags as $tag) {
            if ($tag->getName() === $name) {
                return true;
            }
        }

        return false;
    }

    public function getTagsByName($name)
    {
        $result = [];

        /** @var Tag $tag */
        foreach ($this->tags as $tag) {
            if ($tag->getName() != $name) {
                continue;
            }

            $result[] = $tag;
        }

        return $result;
    }

    public function appendTag(Tag $tag)
    {
        $this->tags[] = $tag;
    }

    public function removeTag(Tag $tagToRemove)
    {
        foreach ($this->tags as $i => $tag) {
            if ($tag === $tagToRemove) {
                unset($this->tags[$i]);
                break;
            }
        }
    }

    public function clearTags()
    {
        $this->tags = [];
    }

    private function getTagFactory(): TagFactory
    {
        if ($this->tagFactory === null) {
            $fqsenResolver = new LocalFsqenResolver();
            $tagFactory = new StandardTagFactory($fqsenResolver);
            $descriptionFactory = new DescriptionFactory($tagFactory);

            $tagFactory->addService($descriptionFactory);
            $tagFactory->addService(new TypeResolver($fqsenResolver));

            $this->tagFactory = $tagFactory;
        }
        return $this->tagFactory;
    }
}
