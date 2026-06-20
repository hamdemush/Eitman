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
        Schema::create('psychologist_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('specialty_id')->nullable()->constrained('specialties')->onDelete('set null');
            $table->text('bio')->nullable();
            $table->integer('experience_years')->default(0);
            $table->string('cv_attachment')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psychologist_profiles');
    }
};
