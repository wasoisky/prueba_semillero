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
        Schema::create('interview_questions', function (Blueprint $table) {
            $table->id();

            // FK a la tabla interviews
            $table->unsignedBigInteger('interview_id');
            $table->foreign('interview_id')
                ->references('id')->on('interviews')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // FK al banco de preguntas
            $table->unsignedBigInteger('id_question_bank');
            $table->foreign('id_question_bank')
                ->references('id')->on('interview_question_bank')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // En caso que la pregunta sea de tipo abierta
            $table->text('answer_text')->nullable();

            // FK a la opción escogida (en caso que sea pregunta cerrada)
            $table->unsignedBigInteger('id_interview_option')->nullable();
            $table->foreign('id_interview_option')
                ->references('id')->on('interview_option')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Observación
            $table->text('description')->nullable();

            // Solo una vez
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_questions');
    }
};
