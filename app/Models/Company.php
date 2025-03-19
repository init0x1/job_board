<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'logo_path',
        'website',
        'description',
        'industry',
        'established_year',
        'brands_images' 
    ];
    
    protected $casts = [
        'brands_images' => 'array',
    ];
    

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the jobs for the company.
     */
    public function jobs()
    {
        return $this->hasMany(JobListing::class);
    }
}
