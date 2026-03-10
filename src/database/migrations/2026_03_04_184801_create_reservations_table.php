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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // 1. On crée d'abord la colonne (non signée et de type Big Integer)
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            // 2. On définit explicitement la contrainte de clé étrangère
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('table_id')
                  ->references('id')
                  ->on('tables')
                  ->onDelete('cascade');
            $table->dateTime('reserved_at');
            $table->integer('guest_count');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
