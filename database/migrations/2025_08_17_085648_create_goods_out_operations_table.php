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
        Schema::create('goods_out_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('warehouses')->onDelete('cascade');
            $table->foreignId('inventory_item_id')->constrained('inventory_items')->onDelete('cascade');
            $table->integer('quantity_dispatched');
            $table->foreignId('dispatched_by_user_id')->constrained('users')->onDelete('restrict'); // أو 'set null'
            $table->timestamp('operation_date');
            $table->foreignId('transfer_to_warehouse_id')->nullable()->constrained('warehouses')->onDelete('set null'); // علاقة ذاتية
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_out_operations');
    }
};