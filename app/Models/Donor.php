<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'contact_info',
    ];

    // علاقة Donor مع Donations (مانح واحد يمكن أن يكون لديه عدة تبرعات)
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // علاقة Donor مع DonationReports (مانح واحد يمكن أن يكون لديه عدة تقارير)
    public function reports()
    {
        return $this->hasMany(DonationReport::class);
    }
}
