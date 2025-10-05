<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('characterization', function (Blueprint $table) {
            $table->id();
            $table->string('description', 80);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->integer('semester')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('characterization');
    }
};
