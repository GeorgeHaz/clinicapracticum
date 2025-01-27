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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('dni')->unique();
            $table->date('birthdate');
            $table->enum('gener', ['Masculino', 'Femenino']);
            $table->string('direction');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('allergies')->nullable();
            $table->string('diseases')->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_telephone')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
