<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('call', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('aspirant_id')->constrained('aspirants')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('date', 40);
            $table->string('conctact_person', 40); // tal cual en el PDF
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('call');
    }
};
