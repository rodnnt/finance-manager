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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('target_value', 15, 2);
            $table->decimal('current_value', 15, 2)->nullable();
            $table->date('deadline');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('financial_accounts')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('coins')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};