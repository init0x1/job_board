<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id', 'job_id', 'website', 'cover_letter', 'resume_path', 'status'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the jobs for the company.
     */
    public function job()
    {
        return $this->belongsTo(JobListing::class, 'job_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
