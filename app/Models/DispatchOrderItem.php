<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DispatchOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'dispatch_order_id',
        'inventory_item_id',
        'quantity_requested',
    ];

    /**
     * Get the dispatch order that owns the item.
     *
     * @return BelongsTo
     */
    public function dispatchOrder(): BelongsTo
    {
        return $this->belongsTo(DispatchOrder::class);
    }

    /**
     * Get the inventory item associated with this order item.
     *
     * @return BelongsTo
     */
    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }
}