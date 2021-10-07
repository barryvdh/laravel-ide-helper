<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SimpleCastsTable extends Migration
{
    public function up(): void
    {
        Schema::create('simple_casts', static function (Blueprint $table) {
            $table->string('cast_to_int');
            $table->string('cast_to_integer');
            $table->string('cast_to_real');
            $table->string('cast_to_float');
            $table->string('cast_to_double');
            $table->string('cast_to_decimal');
            $table->string('cast_to_string');
            $table->string('cast_to_bool');
            $table->string('cast_to_boolean');
            $table->string('cast_to_object');
            $table->string('cast_to_array');
            $table->string('cast_to_json');
            $table->string('cast_to_collection');
            $table->string('cast_to_date');
            $table->string('cast_to_datetime');
            $table->string('cast_to_custom_datetime');
            $table->string('cast_to_immutable_date');
            $table->string('cast_to_immutable_custom_datetime');
            $table->string('cast_to_immutable_datetime');
            $table->string('cast_to_timestamp');
            $table->string('cast_to_encrypted');
            $table->string('cast_to_encrypted_array');
            $table->string('cast_to_encrypted_collection');
            $table->string('cast_to_encrypted_json');
            $table->string('cast_to_encrypted_object');
        });
    }
}
