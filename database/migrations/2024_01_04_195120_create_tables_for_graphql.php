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
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('rallies');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('participants');
        
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->timestamps();
        });

        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('pilot');
            $table->integer('copilot');
            $table->string('car');
            $table->string('constructor');
            $table->timestamps();
        });

        Schema::create('rallies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('winner');
            $table->integer('second_place');
            $table->integer('third_place');
            $table->string('interval_second');
            $table->string('interval_third');
            $table->int('season_id');
            $table->timestamps();
        });

        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->string('champion');
            $table->string('constructor_champion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('rallies');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('participants');
    }
};
