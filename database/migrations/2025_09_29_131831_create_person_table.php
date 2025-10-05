<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dni_type_id')->constrained('dni_type')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('dni')->unique();
            $table->string('name', 40);
            $table->string('lastname', 60);
            $table->string('phone', 15)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('email', 50)->unique();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('birthday')->nullable();
            $table->enum('biological_gender', ['M','F','O'])->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('person');
    }
};
