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
        Schema::create('in_kind_donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->unique()->constrained('donations')->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_kind_donations');
    }
};
