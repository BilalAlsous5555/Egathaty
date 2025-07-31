<?php

namespace Database\Seeders;

use App\Models\Donor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $donors = [
            [
                'name' => 'Red Crescent',
                'type' => 'Organization',
                'contact_info' => 'contact@redcrescent.org',
            ],
            [
                'name' => 'Ahmad',
                'type' => 'Individual',
                'contact_info' => 'ahmad@gmail.com',
            ],
            [
                'name' => 'Helping Hands NGO',
                'type' => 'Organization',
                'contact_info' => 'info@helpinghands.org',
            ],
        ];

        foreach ($donors as $donor) {
            Donor::create($donor);
        }
    }
}
