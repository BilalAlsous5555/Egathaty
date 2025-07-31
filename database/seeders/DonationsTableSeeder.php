<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $donations = [
            [
                'donor_id' => 2, // Ahmad
                'recorded_by_user_id' => 1, // Admin User
                'type' => 'cash',
                'date_received' => now()->subDays(10),
            ],
            
            [
                'donor_id' => 1, // Red Crescent
                'recorded_by_user_id' => 2, // Donations Manager
                'type' => 'in-kind',
                'date_received' => now()->subDays(5),
            ],

        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}
