<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();                              // id (PK) int
            $table->char('code', 5);                   // code char(5)
            $table->string('description', 50);         // description varchar(50)

            // state_id (FK) -> states.id
            $table->foreignId('state_id')
                  ->constrained('states')              // references('id')->on('states')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();                // evita borrar un state si tiene cities

            // opcional: evita repetir el mismo code dentro del mismo state
            $table->unique(['state_id', 'code']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
