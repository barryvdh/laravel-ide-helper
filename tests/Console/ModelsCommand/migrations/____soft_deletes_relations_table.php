<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoftDeletesRelationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('soft_deletable_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('model_with_relations_id')->nullable();
            $table->softDeletes();
        });

        Schema::create('non_soft_deletable_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('model_with_relations_id')->nullable();
        });

        Schema::create('models_with_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('soft_deletable_model_id');
            $table->unsignedBigInteger('non_soft_deletable_model_id');

            $table->foreign('soft_deletable_model_id')
                ->references('id')
                ->on('soft_deletable_models');

            $table->foreign('non_soft_deletable_model_id')
                ->references('id')
                ->on('non_soft_deletable_models');
        });
    }
}
