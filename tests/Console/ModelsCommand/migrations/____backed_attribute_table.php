<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BackedAttributeTable extends Migration
{
    public function up(): void
    {
        Schema::create('backed_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_read');
            $table->string('name_write');
        });
    }
}
