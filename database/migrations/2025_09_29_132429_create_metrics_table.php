<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id(); // id (PK)

            // FK a advertising.id
            $table->foreignId('id_advertising')
                  ->constrained('advertising')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->integer('visits')->default(0);
            $table->integer('coments')->default(0);     // (según el diagrama)
            $table->dateTime('measured_at')->nullable(); // datetime (nombre estandarizado)
            $table->timestamps();

            // Índice útil para consultas por campaña y fecha
            $table->index(['id_advertising', 'measured_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
