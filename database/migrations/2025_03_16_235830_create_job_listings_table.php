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
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->text('responsibilities')->nullable();
            $table->text('requirements')->nullable();
            $table->string('location');
            $table->enum('work_type', ['remote', 'onsite', 'hybrid']);
            $table->enum('experience_level', ['intern','fresh', 'junior', 'senior', 'expert', 'lead', 'manager'])->default('fresh');
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->date('application_deadline')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->boolean('is_featured')->default(false);
            $table->integer('availble_vacancies')->nullable()->default(1);
            $table->enum('job_nature', ['full-time', 'part-time', 'hybrid'])->nullable()->default('full-time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
