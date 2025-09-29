<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('program', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('description', 70);
            $table->foreignId('faculty_id')->constrained('faculty')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('program');
    }
};
