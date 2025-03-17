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
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->nullable();
            $table->timestamps();
        });

        // Create the pivot table for profile_skill
        Schema::create('profile_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Create the pivot table for job_skill
        Schema::create('job_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_listings')->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('profile_skill');
        Schema::dropIfExists('job_skill');
    }
};
