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
            $table->decimal('latitude', 8, 6);
            $table->decimal('longitude', 9, 6);
            $table->integer('duration');
            $table->decimal('vh_angle', 8, 6);
            $table->string('mode');
            $table->string('sensor');
            $table->string('status');
            $table->string('code');
            $table->dateTime('closing_date');
            $table->timestamps();
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
