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
        Schema::create('onduties', function (Blueprint $table) {
            $table->id();
            $table->integer('semana_nro')->nullable();
            $table->string('principal')->nullable();
            $table->string('Apoyo')->nullable();
            $table->dateTime('dia_planificacion')->nullable();
            $table->dateTime('lapso_inicio')->nullable();
            $table->dateTime('lapso_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onduties');
    }
};
