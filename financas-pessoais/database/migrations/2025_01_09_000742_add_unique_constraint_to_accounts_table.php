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
        Schema::table('financial_accounts', function (Blueprint $table) {
            $table->unique([
                'account_number', 
                'account_digit', 
                'agency_code', 
                'agency_digit', 
                'bank_code'
            ], 'unique_account_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_accounts', function (Blueprint $table) {
            $table->dropUnique([
                'account_number', 
                'account_digit', 
                'agency_code', 
                'agency_digit', 
                'bank_code'
            ]);
        });
    }
};