<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The profiles that belong to the skill.
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_skill');
    }

    /**
     * The jobs that belong to the skill.
     */
    public function jobs()
    {
        return $this->belongsToMany(JobListing::class, 'job_skill');
    }
}
