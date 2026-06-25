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
        Schema::create('smart_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->integer('anxiety_score')->default(0);
            $table->integer('stress_score')->default(0);
            $table->integer('depression_score')->default(0);
            $table->foreignId('recommended_specialty_id')->nullable()->constrained('specialties')->onDelete('set null');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('smart_assessments');
    }
};