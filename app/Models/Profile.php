<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone_number',
        'address',
        'bio',
        'resume_path',
        'linkedin_url',
    ];
    /**
     * Get the user that owns the profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'profile_skill');
    }
}
