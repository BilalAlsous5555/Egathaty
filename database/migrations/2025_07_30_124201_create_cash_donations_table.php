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
        Schema::create('cash_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->unique()->constrained('donations')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10);
            $table->string('receipt_number')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_donations');
    }
};