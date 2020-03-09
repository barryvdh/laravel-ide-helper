<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostsTable extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->char('char_nullable')->nullable();
            $table->char('char_not_nullable');

            $table->string('string_nullable')->nullable();
            $table->string('string_not_nullable');

            $table->text('text_nullable')->nullable();
            $table->text('text_not_nullable');

            $table->mediumText('medium_text_nullable')->nullable();
            $table->mediumText('medium_text_not_nullable');

            $table->longText('long_text_nullable')->nullable();
            $table->longText('long_text_not_nullable');

            $table->integer('integer_nullable')->nullable();
            $table->integer('integer_not_nullable');

            $table->tinyInteger('tiny_integer_nullable')->nullable();
            $table->tinyInteger('tiny_integer_not_nullable');

            $table->smallInteger('small_integer_nullable')->nullable();
            $table->smallInteger('small_integer_not_nullable');

            $table->mediumInteger('medium_integer_nullable')->nullable();
            $table->mediumInteger('medium_integer_not_nullable');

            $table->bigInteger('big_integer_nullable')->nullable();
            $table->bigInteger('big_integer_not_nullable');

            $table->unsignedInteger('unsigned_integer_nullable')->nullable();
            $table->unsignedInteger('unsigned_integer_not_nullable');

            $table->unsignedTinyInteger('unsigned_tiny_integer_nullable')->nullable();
            $table->unsignedTinyInteger('unsigned_tiny_integer_not_nullable');

            $table->unsignedSmallInteger('unsigned_small_integer_nullable')->nullable();
            $table->unsignedSmallInteger('unsigned_small_integer_not_nullable');

            $table->unsignedMediumInteger('unsigned_medium_integer_nullable')->nullable();
            $table->unsignedMediumInteger('unsigned_medium_integer_not_nullable');

            $table->unsignedBigInteger('unsigned_big_integer_nullable')->nullable();
            $table->unsignedBigInteger('unsigned_big_integer_not_nullable');

            $table->float('float_nullable')->nullable();
            $table->float('float_not_nullable');

            $table->double('double_nullable')->nullable();
            $table->double('double_not_nullable');

            $table->decimal('decimal_nullable')->nullable();
            $table->decimal('decimal_not_nullable');

            $table->unsignedDecimal('unsigned_decimal_nullable')->nullable();
            $table->unsignedDecimal('unsigned_decimal_not_nullable');

            $table->boolean('boolean_nullable')->nullable();
            $table->boolean('boolean_not_nullable');

            $table->enum('enum_nullable', ['foo', 'bar'])->nullable();
            $table->enum('enum_not_nullable', ['foo', 'bar']);

            $table->json('json_nullable')->nullable();
            $table->json('json_not_nullable');

            $table->jsonb('jsonb_nullable')->nullable();
            $table->jsonb('jsonb_not_nullable');

            $table->date('date_nullable')->nullable();
            $table->date('date_not_nullable');

            $table->dateTime('datetime_nullable')->nullable();
            $table->dateTime('datetime_not_nullable');

            $table->dateTimeTz('datetimetz_nullable')->nullable();
            $table->dateTimeTz('datetimetz_not_nullable');

            $table->time('time_nullable')->nullable();
            $table->time('time_not_nullable');

            $table->timeTz('timetz_nullable')->nullable();
            $table->timeTz('timetz_not_nullable');

            $table->timestamp('timestamp_nullable')->nullable();
            $table->timestamp('timestamp_not_nullable');

            $table->timestampTz('timestamptz_nullable')->nullable();
            $table->timestampTz('timestamptz_not_nullable');

            $table->year('year_nullable')->nullable();
            $table->year('year_not_nullable');

            $table->binary('binary_nullable')->nullable();
            $table->binary('binary_not_nullable');

            $table->uuid('uuid_nullable')->nullable();
            $table->uuid('uuid_not_nullable');

            $table->ipAddress('ipaddress_nullable')->nullable();
            $table->ipAddress('ipaddress_not_nullable');

            $table->macAddress('macaddress_nullable')->nullable();
            $table->macAddress('macaddress_not_nullable');

            $table->timestamps();
        });
    }
}
