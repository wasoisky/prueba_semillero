<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('visit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('place', 40);
            $table->dateTime('date');
            $table->string('purpuse', 40); // tal cual en el PDF
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('visit');
    }
};
