<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GoodsOutOperation extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'inventory_item_id',
        'quantity_dispatched',
        'dispatched_by_user_id',
        'operation_date',
        'transfer_to_warehouse_id',
    ];

    protected $casts = [
        'operation_date' => 'datetime',
    ];

    /**
     * Get the warehouse from which goods were dispatched.
     *
     * @return BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the inventory item that was dispatched.
     *
     * @return BelongsTo
     */
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    /**
     * Get the user who dispatched the goods.
     *
     * @return BelongsTo
     */
    public function dispatchedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dispatched_by_user_id');
    }

    /**
     * Get the warehouse to which goods were transferred (if it was a transfer).
     *
     * @return BelongsTo
     */
    public function transferToWarehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'transfer_to_warehouse_id');
    }
}