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
        Schema::create('donation_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained('donations')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type', 50)->nullable();
            $table->text('description')->nullable();
            $table->timestamp('uploaded_at')->useCurrent(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_attachments');
    }
};