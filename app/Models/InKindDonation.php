<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InKindDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'item_name',
        'quantity',
        'description',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];

    
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }


    public function inventoryItem(): HasOne
    {
        return $this->hasOne(InventoryItem::class, 'in_kind_donation_id');
    }
}
