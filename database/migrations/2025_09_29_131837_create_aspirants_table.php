<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirants', function (Blueprint $table) {
            $table->id(); // id (PK)

            // Siguiendo los nombres del diagrama:
            // Si ya existen tablas users y programs, estas FKs funcionarán.
            // Si aún no existen, cambia '->constrained()' por solo 'unsignedBigInteger' temporalmente.
            $table->foreignId('id_user')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('id_program')
                  ->constrained('program')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('candidate_program', 40); // varchar(40)
            $table->timestamps();

            // Índices útiles
            $table->index('id_user');
            $table->index('id_program');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirants');
    }
};
