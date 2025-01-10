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
            $table->renameColumn('preferred_coin_id', 'preferred_currency_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       	Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('preferred_currency_id', 'preferred_coin_id');
        });
    }
};