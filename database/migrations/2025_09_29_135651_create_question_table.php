<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Ejecuta la migración: crea la tabla 'question' con sus columnas y llaves foráneas.
     */
    public function up(): void {
        Schema::create('question', function (Blueprint $table) {
            // Clave primaria autoincremental (BIGINT sin signo por defecto en Laravel)
            $table->id();

            // Clave foránea a la tabla 'test'.
            // constrained('test') infiere la columna 'id' en la tabla destino.
            // cascadeOnUpdate(): si cambia el id en 'test', actualiza aquí.
            // cascadeOnDelete(): si se elimina el registro en 'test', elimina la pregunta asociada.
            $table->foreignId('test_id')
                  ->constrained('test')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // Clave foránea a la tabla 'question_type'.
            // restrictOnDelete(): impide eliminar un 'question_type' si hay preguntas que lo referencian.
            $table->foreignId('question_type_id')
                  ->constrained('question_type')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Clave foránea a la tabla 'criterion'.
            // Igual que arriba: actualiza en cascada, restringe al eliminar.
            $table->foreignId('criterion_id')
                  ->constrained('criterion')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // Descripción de la pregunta (texto largo).
            $table->text('description');

            // Indica si la pregunta es obligatoria.
            // Por defecto, false (0).
            $table->boolean('is_mandatory')->default(false);

            // Marca de tiempo de creación y actualización: created_at y updated_at
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('question');
    }
};
