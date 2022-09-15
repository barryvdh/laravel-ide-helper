<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BelongsToVariationTable extends Migration
{
    public function up(): void
    {
        Schema::create('belongs_to_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('not_null_column_with_foreign_key_constraint');
            $table->integer('not_null_column_with_no_foreign_key_constraint');
            $table->integer('nullable_column_with_foreign_key_constraint')->nullable();
            $table->integer('nullable_column_with_no_foreign_key_constraint')->nullable();
            $table->foreign('not_null_column_with_foreign_key_constraint')->references('id')->on('belongs_to_variations');
            $table->foreign('nullable_column_with_foreign_key_constraint')->references('id')->on('belongs_to_variations');
        });
    }
}
