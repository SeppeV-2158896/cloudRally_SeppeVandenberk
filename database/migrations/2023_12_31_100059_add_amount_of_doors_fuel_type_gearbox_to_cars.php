<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->string("gearboxType")->nullable();
            $table->string("fuelType")->nullable();
            $table->integer("amountOfDoors")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('gearboxType');
            $table->dropColumn('amountOfDoors');
            $table->dropColumn('fuelType');
        });
    }
};
