<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class JobListing extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'user_id',
        'company_id',
        'category_id',
        'title',
        'description',
        'responsibilities',
        'requirements',
        'location',
        'work_type',
        'salary_min',
        'salary_max',
        'application_deadline',
        'status',
    ];

    //make application expired after 3 days
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (!$job->application_deadline) {
                $job->application_deadline = Carbon::now()->addDays(3);
            }
        });
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // Define the relationship
    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }

    public function isAppliedByUser()
    {
        return $this->applications()->where('user_id', auth()->id())->exists();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
