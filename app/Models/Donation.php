<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'recorded_by_user_id',
        'type',
        'date_received',
    ];

    // علاقة Donation مع Donor (التبرع ينتمي إلى مانح واحد)
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    // علاقة Donation مع User (التبرع تم تسجيله بواسطة مستخدم واحد)
    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by_user_id');
    }

    // علاقة 1:1 مع CashDonation
    public function cashDonation()
    {
        return $this->hasOne(CashDonation::class);
    }

    // علاقة 1:1 مع InKindDonation
    public function inKindDonation()
    {
        return $this->hasOne(InKindDonation::class);
    }

    // علاقة Donation مع DonationAttachments (التبرع يمكن أن يكون لديه عدة مرفقات)
    public function attachments()
    {
        return $this->hasMany(DonationAttachment::class);
    }
}
