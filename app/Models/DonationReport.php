<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'report_period_start',
        'report_period_end',
        'report_file_path',
        'generated_by_user_id',
    ];

    protected $casts = [
        'report_period_start' => 'date',
        'report_period_end' => 'date',
    ];

    // علاقة DonationReport مع Donor (التقرير ينتمي إلى مانح واحد)
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }

    // علاقة DonationReport مع User (التقرير تم إنشاؤه بواسطة مستخدم واحد)
    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by_user_id');
    }
}
