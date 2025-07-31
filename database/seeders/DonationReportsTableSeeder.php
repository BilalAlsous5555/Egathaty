<?php

namespace Database\Seeders;

use App\Models\DonationReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = [
            [
                'donor_id' => 1, 
                'report_period_start' => now()->subMonth(),
                'report_period_end' => now(),
                'report_file_path' => 'reports/redcrescent_march.pdf',
                'generated_by_user_id' => 1,
            ],
        ];

        foreach ($reports as $report) {
            DonationReport::create($report);
        }
    }
}
