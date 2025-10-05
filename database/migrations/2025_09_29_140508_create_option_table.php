<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('option', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->foreignId('question_id')->constrained('question')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('description', 40);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('option');
    }
};
