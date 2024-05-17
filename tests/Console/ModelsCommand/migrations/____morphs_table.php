<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MorphsTable extends Migration
{
    public function up(): void
    {
        Schema::create('morphs', function (Blueprint $table) {
            $table->morphs('relation_morph_to');
            $table->nullableMorphs('nullable_relation_morph_to');
        });
    }
}
