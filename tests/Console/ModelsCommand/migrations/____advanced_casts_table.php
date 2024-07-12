<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvancedCastsTable extends Migration
{
    public function up(): void
    {
        Schema::create('advanced_casts', static function (Blueprint $table) {
            $table->string('cast_to_date_serialization');
            $table->string('cast_to_datetime_serialization');
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
            $table->string('cast_to_as_collection');
            $table->string('cast_to_as_enum_collection');
            $table->string('cast_to_as_array_object');
        });
    }
}
