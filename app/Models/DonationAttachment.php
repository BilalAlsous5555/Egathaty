<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'file_path',
        'file_type',
        'description',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    // علاقة DonationAttachment مع Donation (المرفق ينتمي إلى تبرع واحد)
    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
