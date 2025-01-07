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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->enum('type', ['Despesa', 'Receita']);
            $table->decimal('value', 15, 2);
            $table->date('transaction_date');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
