<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SimpleTable extends Migration
{
    public function up(): void
    {
        Schema::create('simples', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
    }
}
