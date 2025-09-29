<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirant_advertising', function (Blueprint $table) {
            $table->id(); // PK propia (según diagrama)

            // FKs
            $table->foreignId('id_aspirant')
                  ->constrained('aspirants')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreignId('id_advertising')
                  ->constrained('advertising')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            // Evitar duplicados del par aspirant–advertising
            $table->unique(['id_aspirant', 'id_advertising']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirant_advertising');
    }
};
