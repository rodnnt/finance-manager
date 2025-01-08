<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ceps', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 10)->unique();
            $table->string('street');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state', 2);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceps');
    }
};
