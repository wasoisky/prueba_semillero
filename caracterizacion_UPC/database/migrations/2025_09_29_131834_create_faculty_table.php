<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20);
            $table->string('description', 70);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('faculty');
    }
};
