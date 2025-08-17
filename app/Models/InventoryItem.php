<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'in_kind_donation_id', 
        'item_name',
        'quantity',
        'description',
        'expiry_date',
        'threshold_quantity',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    /**
     * Get the warehouse that owns the inventory item.
     *
     * @return BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the in-kind donation that this inventory item originated from.
     *
     * @return BelongsTo
     */
    public function inKindDonation(): BelongsTo
    {
        return $this->belongsTo(InKindDonation::class);
    }

    /**
     * Get the goods in operations for the inventory item.
     *
     * @return HasMany
     */
    public function goodsInOperations(): HasMany
    {
        return $this->hasMany(GoodsInOperation::class);
    }

    /**
     * Get the goods out operations for the inventory item.
     *
     * @return HasMany
     */
    public function goodsOutOperations(): HasMany
    {
        return $this->hasMany(GoodsOutOperation::class);
    }

    /**
     * Get the dispatch order items for this inventory item.
     *
     * @return HasMany
     */
    public function dispatchOrderItems(): HasMany
    {
        return $this->hasMany(DispatchOrderItem::class);
    }
}
