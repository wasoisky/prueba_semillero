<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();

            // Columnas exactas como en la imagen
            $table->unsignedBigInteger('id_process');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_aspirant');

            $table->dateTime('date');
            $table->text('description')->nullable();
            $table->string('source_of_information', 40);

            $table->timestamps();

            // Claves foráneas (ajusta nombres de tablas si difieren)
            $table->foreign('id_process')
                  ->references('id')->on('process')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreign('id_user')
                  ->references('id')->on('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreign('id_aspirant')
                  ->references('id')->on('aspirant')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
