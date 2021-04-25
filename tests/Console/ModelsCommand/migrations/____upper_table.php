<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpperTable extends Migration
{
    public function up(): void
    {
        Schema::create('uppers', function (Blueprint $table) {
            $table->bigIncrements('ID');

            $table->char('CHAR_NULLABLE')->nullable();
            $table->char('CHAR_NOT_NULLABLE');

            $table->string('STRING_NULLABLE')->nullable();
            $table->string('STRING_NOT_NULLABLE');

            $table->text('TEXT_NULLABLE')->nullable();
            $table->text('TEXT_NOT_NULLABLE');

            $table->mediumText('MEDIUM_TEXT_NULLABLE')->nullable();
            $table->mediumText('MEDIUM_TEXT_NOT_NULLABLE');

            $table->longText('LONG_TEXT_NULLABLE')->nullable();
            $table->longText('LONG_TEXT_NOT_NULLABLE');

            $table->integer('INTEGER_NULLABLE')->nullable();
            $table->integer('INTEGER_NOT_NULLABLE');

            $table->tinyInteger('TINY_INTEGER_NULLABLE')->nullable();
            $table->tinyInteger('TINY_INTEGER_NOT_NULLABLE');

            $table->smallInteger('SMALL_INTEGER_NULLABLE')->nullable();
            $table->smallInteger('SMALL_INTEGER_NOT_NULLABLE');

            $table->mediumInteger('MEDIUM_INTEGER_NULLABLE')->nullable();
            $table->mediumInteger('MEDIUM_INTEGER_NOT_NULLABLE');

            $table->bigInteger('BIG_INTEGER_NULLABLE')->nullable();
            $table->bigInteger('BIG_INTEGER_NOT_NULLABLE');

            $table->unsignedInteger('UNSIGNED_INTEGER_NULLABLE')->nullable();
            $table->unsignedInteger('UNSIGNED_INTEGER_NOT_NULLABLE');

            $table->unsignedTinyInteger('UNSIGNED_TINY_INTEGER_NULLABLE')->nullable();
            $table->unsignedTinyInteger('UNSIGNED_TINY_INTEGER_NOT_NULLABLE');

            $table->unsignedSmallInteger('UNSIGNED_SMALL_INTEGER_NULLABLE')->nullable();
            $table->unsignedSmallInteger('UNSIGNED_SMALL_INTEGER_NOT_NULLABLE');

            $table->unsignedMediumInteger('UNSIGNED_MEDIUM_INTEGER_NULLABLE')->nullable();
            $table->unsignedMediumInteger('UNSIGNED_MEDIUM_INTEGER_NOT_NULLABLE');

            $table->unsignedBigInteger('UNSIGNED_BIG_INTEGER_NULLABLE')->nullable();
            $table->unsignedBigInteger('UNSIGNED_BIG_INTEGER_NOT_NULLABLE');

            $table->float('FLOAT_NULLABLE')->nullable();
            $table->float('FLOAT_NOT_NULLABLE');

            $table->double('DOUBLE_NULLABLE')->nullable();
            $table->double('DOUBLE_NOT_NULLABLE');

            $table->decimal('DECIMAL_NULLABLE')->nullable();
            $table->decimal('DECIMAL_NOT_NULLABLE');

            $table->unsignedDecimal('UNSIGNED_DECIMAL_NULLABLE')->nullable();
            $table->unsignedDecimal('UNSIGNED_DECIMAL_NOT_NULLABLE');

            $table->boolean('BOOLEAN_NULLABLE')->nullable();
            $table->boolean('BOOLEAN_NOT_NULLABLE');

            $table->enum('ENUM_NULLABLE', ['foo', 'bar'])->nullable();
            $table->enum('ENUM_NOT_NULLABLE', ['foo', 'bar']);

            $table->json('JSON_NULLABLE')->nullable();
            $table->json('JSON_NOT_NULLABLE');

            $table->jsonb('JSONB_NULLABLE')->nullable();
            $table->jsonb('JSONB_NOT_NULLABLE');

            $table->date('DATE_NULLABLE')->nullable();
            $table->date('DATE_NOT_NULLABLE');

            $table->dateTime('DATETIME_NULLABLE')->nullable();
            $table->dateTime('DATETIME_NOT_NULLABLE');

            $table->dateTimeTz('DATETIMETZ_NULLABLE')->nullable();
            $table->dateTimeTz('DATETIMETZ_NOT_NULLABLE');

            $table->time('TIME_NULLABLE')->nullable();
            $table->time('TIME_NOT_NULLABLE');

            $table->timeTz('TIMETZ_NULLABLE')->nullable();
            $table->timeTz('TIMETZ_NOT_NULLABLE');

            $table->timestamp('TIMESTAMP_NULLABLE')->nullable();
            $table->timestamp('TIMESTAMP_NOT_NULLABLE');

            $table->timestampTz('TIMESTAMPTZ_NULLABLE')->nullable();
            $table->timestampTz('TIMESTAMPTZ_NOT_NULLABLE');

            $table->year('YEAR_NULLABLE')->nullable();
            $table->year('YEAR_NOT_NULLABLE');

            $table->binary('BINARY_NULLABLE')->nullable();
            $table->binary('BINARY_NOT_NULLABLE');

            $table->uuid('UUID_NULLABLE')->nullable();
            $table->uuid('UUID_NOT_NULLABLE');

            $table->ipAddress('IPADDRESS_NULLABLE')->nullable();
            $table->ipAddress('IPADDRESS_NOT_NULLABLE');

            $table->macAddress('MACADDRESS_NULLABLE')->nullable();
            $table->macAddress('MACADDRESS_NOT_NULLABLE');

            // $table->timestamps();
            $table->dateTime('CREATED_AT')->nullable();
            $table->dateTime('UPDATED_AT')->nullable();
        });
    }
}
