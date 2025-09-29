<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('user_answer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('question')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('option_id')->nullable()->constrained('option')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->text('answer_text')->nullable();
            $table->dateTime('submission_date');
            $table->timestamps();

            $table->index(['user_id','question_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('user_answer');
    }
};
