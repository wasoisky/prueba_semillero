<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('process', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aspirant')->constrained('aspirants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('status', 40);
            $table->string('location', 40)->nullable();
            $table->dateTime('update_date');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('process');
    }
};
