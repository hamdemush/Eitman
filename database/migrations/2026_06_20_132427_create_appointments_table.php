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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('psychologist_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('availability_id')->constrained('availabilities')->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected', 'cancelled', 'completed'])->default('pending');
            $table->enum('session_type', ['text', 'voice', 'video'])->default('text');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
