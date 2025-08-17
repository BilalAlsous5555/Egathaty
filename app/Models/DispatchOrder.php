<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DispatchOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_user_id',
        'warehouse_id',
        'status',
        'approval_user_id',
        'approval_date',
    ];

    protected $casts = [
        'approval_date' => 'datetime',
    ];

    /**
     * Get the user who requested the dispatch order.
     *
     * @return BelongsTo
     */
    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_user_id');
    }

    /**
     * Get the warehouse from which the dispatch order is requested.
     *
     * @return BelongsTo
     */
    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * Get the user who approved the dispatch order.
     *
     * @return BelongsTo
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approval_user_id');
    }

    /**
     * Get the items included in the dispatch order.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(DispatchOrderItem::class);
    }
}