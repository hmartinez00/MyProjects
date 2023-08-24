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
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('satellite');
            $table->string('target');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('duration');
            $table->float('vh_angle');
            $table->string('mode');
            $table->string('sensor');
            $table->string('status');
            $table->string('code')->nullable();
            $table->timestamps();
            $table->dateTime('closing_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priorities');
    }
};
