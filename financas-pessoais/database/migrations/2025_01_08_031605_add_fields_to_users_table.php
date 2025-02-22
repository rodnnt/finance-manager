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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('type', ['Admin', 'Cliente', 'Outro'])->default('Cliente');
            $table->unsignedBigInteger('cep_id')->nullable();
            $table->string('address_number')->nullable();
            $table->string('address_complement')->nullable();
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->string('profile_image')->nullable();
            $table->unsignedBigInteger('preferred_coin_id')->nullable();

            $table->foreign('cep_id')->references('id')->on('ceps')->onDelete('restrict');
            $table->foreign('preferred_coin_id')->references('id')->on('coins')->onDelete('restrict');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('cep_id');
            $table->dropColumn('address_number');
            $table->dropColumn('address_complement');
            $table->dropColumn('status');
            $table->dropColumn('profile_image');
            $table->dropColumn('preferred_coin_id');
        });
    }
};
