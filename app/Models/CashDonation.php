<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'amount',
        'currency',
        'receipt_number',
    ];

    // علاقة CashDonation مع Donation (التبرع النقدي ينتمي إلى تبرع رئيسي واحد)
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
