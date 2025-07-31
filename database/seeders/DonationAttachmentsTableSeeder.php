<?php

namespace Database\Seeders;

use App\Models\DonationAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationAttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attachments = [
            [
                'donation_id' => 1,
                'file_path' => 'attachments/receipt1.pdf',
                'file_type' => 'pdf',
                'description' => 'Receipt for cash donation',
                'uploaded_at' => now(),
            ],
            [
                'donation_id' => 2,
                'file_path' => 'attachments/medicalkits.jpg',
                'file_type' => 'image',
                'description' => 'Photo of medical kits',
                'uploaded_at' => now(),
            ],
        ];

        foreach ($attachments as $attachment) {
            DonationAttachment::create($attachment);
        }
    }
}
