<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();

            // FKs (todas con id() = BIGINT UNSIGNED)
            $table->foreignId('process_id')
                  ->constrained('process')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreignId('aspirant_id')
                  ->constrained('aspirants') // <-- ya confirmada en plural
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->dateTime('date');
            $table->text('description')->nullable();
            $table->string('source_of_information', 40);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
