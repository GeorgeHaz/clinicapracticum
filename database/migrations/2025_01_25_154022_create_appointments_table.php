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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patients_id');
            $table->unsignedBigInteger('doctors_id');
            $table->unsignedBigInteger('specialties_id')->nullable();
            $table->date('appointments_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['Agendada', 'Confirmada', 'Cancelada', 'Realizada'])->default('Agendada');
            $table->text('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('patients_id')->references('id')->on('patients');
            $table->foreign('doctors_id')->references('id')->on('doctors');
            $table->foreign('specialties_id')->references('id')->on('specialties');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
