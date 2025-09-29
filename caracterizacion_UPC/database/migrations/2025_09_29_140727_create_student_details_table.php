<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('student_details', function (Blueprint $table) {
            // PK que además es FK a users.id
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->primary('user_id');

            $table->foreignId('program_id')->constrained('program')->cascadeOnUpdate()->restrictOnDelete();
            $table->integer('current_semester');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('student_details');
    }
};
