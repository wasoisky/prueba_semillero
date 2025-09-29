<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advertising', function (Blueprint $table) {
            $table->id();                               // id (PK)
            $table->string('type', 40);                 // varchar(40)
            $table->string('content', 10);              // varchar(10)
            $table->string('channel', 40);              // varchar(40)
            $table->text('description')->nullable();    // text
            $table->dateTime('start_date')->nullable(); // datetime
            $table->dateTime('end_date')->nullable();   // datetime
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('advertising');
    }
};
