<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'expiry_date' => 'date', // لتحويل تاريخ انتهاء الصلاحية إلى كائن Date
    ];

    // علاقة InKindDonation مع Donation (التبرع العيني ينتمي إلى تبرع رئيسي واحد)
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
