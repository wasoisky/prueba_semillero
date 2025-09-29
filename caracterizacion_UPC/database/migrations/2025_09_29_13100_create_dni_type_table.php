<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('dni_type', function (Blueprint $table) {
            $table->id(); // PK
            $table->string('description', 40);
            $table->string('abbreviation', 10);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('dni_type');
    }
};
