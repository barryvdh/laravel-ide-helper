<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomCastsTable extends Migration
{
    public function up(): void
    {
        Schema::create('custom_casts', static function (Blueprint $table) {
            $table->string('casted_property_with_return_type');
            $table->string('casted_property_with_return_docblock');
            $table->string('casted_property_with_return_docblock_fqn');
            $table->string('casted_property_with_return_primitive');
            $table->string('casted_property_with_return_primitive_docblock');
            $table->string('casted_property_with_return_nullable_primitive');
            $table->string('casted_property_without_return');
            $table->string('casted_property_with_param');
            $table->string('casted_property_with_static_return_docblock');
            $table->string('casted_property_with_this_return_docblock');
            $table->string('extended_casted_property_with_static_return_docblock');
            $table->string('extended_casted_property_with_this_return_docblock');
            $table->string('casted_property_with_static_return_docblock_and_param');
        });
    }
}
