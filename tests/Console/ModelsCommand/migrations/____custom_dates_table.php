<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomDatesTable extends Migration
{
    public function up(): void
    {
        Schema::create('custom_dates', function (Blueprint $table) {
            $table->timestamps();
        });
    }
}
