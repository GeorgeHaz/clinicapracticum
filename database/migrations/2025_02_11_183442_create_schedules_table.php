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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->enum('day_of_week', ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']); // O usar tinyint
            //$table->tinyInteger('day_of_week')->unsigned(); // Otra opción: 1=Lunes, 2=Martes, etc.
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedTinyInteger('interval')->default(30); // Intervalo en minutos
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
