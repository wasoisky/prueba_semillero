<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login', 40)->unique();
            $table->string('password', 255);
            $table->foreignId('person_id')->constrained('person')->cascadeOnUpdate()->restrictOnDelete();
            // Apunta a Roles
            $table->foreignId('role_id')->constrained('roles')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
