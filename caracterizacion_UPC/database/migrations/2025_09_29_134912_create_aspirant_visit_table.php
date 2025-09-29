<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('aspirant_visit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_aspirant')->constrained('aspirants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_visit')->constrained('visit')->cascadeOnUpdate()->cascadeOnDelete();
            $table->unique(['id_aspirant','id_visit']);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('aspirant_visit');
    }
};
