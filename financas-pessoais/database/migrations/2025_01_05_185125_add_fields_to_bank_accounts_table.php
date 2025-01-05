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
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->string('account_name');
            $table->enum('account_type', ['Conta Corrente', 'Conta Poupança', 'Cartão de Crédito']);
            $table->decimal('credit_limit', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bank_accounts', function (Blueprint $table) {
            $table->dropColumn('account_name');
            $table->dropColumn('account_type');
            $table->dropColumn('credit_limit');
        });
    }
};
