<?php

namespace Database\Seeders;

use App\Models\CashDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashDonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashDonations = [
            [
                'donation_id' => 1, 
                'amount' => 500.00,
                'currency' => 'USD',
                'receipt_number' => 'RCPT-1001',
            ],
        ];

        foreach ($cashDonations as $cashDonation) {
            CashDonation::create($cashDonation);
        }
    }
}
