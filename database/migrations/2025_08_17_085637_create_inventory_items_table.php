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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->foreignId('in_kind_donation_id')->nullable()->constrained('in_kind_donations')->onDelete('set null'); // العلاقة الجديدة مع الوحدة الأولى
            $table->string('item_name');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->date('expiry_date')->nullable();
            $table->integer('threshold_quantity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
