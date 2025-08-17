<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_address',
        'latitude',
        'longitude',
        'type',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Get the inventory items for the warehouse.
     *
     * @return HasMany
     */
    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }

    /**
     * Get the goods in operations for the warehouse.
     *
     * @return HasMany
     */
    public function goodsInOperations(): HasMany
    {
        return $this->hasMany(GoodsInOperation::class);
    }

    /**
     * Get the goods out operations for the warehouse.
     *
     * @return HasMany
     */
    public function goodsOutOperations(): HasMany
    {
        return $this->hasMany(GoodsOutOperation::class);
    }

    /**
     * Get the dispatch orders originating from this warehouse.
     *
     * @return HasMany
     */
    public function dispatchOrders(): HasMany
    {
        return $this->hasMany(DispatchOrder::class);
    }

    /**
     * Get the goods out operations where this warehouse is the transfer destination.
     * (Self-referencing relationship for transfers between warehouses)
     *
     * @return HasMany
     */
    public function incomingTransfers(): HasMany
    {
        return $this->hasMany(GoodsOutOperation::class, 'transfer_to_warehouse_id');
    }
}
