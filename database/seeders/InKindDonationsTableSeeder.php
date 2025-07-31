<?php

namespace Database\Seeders;

use App\Models\InKindDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InKindDonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inKindDonations = [
            [
                'donation_id' => 2, 
                'item_name' => 'Medical Kits',
                'quantity' => 50,
                'description' => 'First aid kits',
                'expiry_date' => now()->addYear(),
            ],
        ];

        foreach ($inKindDonations as $inKindDonation) {
            InKindDonation::create($inKindDonation);
        }
    }
}
