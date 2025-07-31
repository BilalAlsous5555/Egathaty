<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donation_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->onDelete('cascade');
            $table->date('report_period_start');
            $table->date('report_period_end');
            $table->string('report_file_path');
            $table->foreignId('generated_by_user_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_reports');
    }
};