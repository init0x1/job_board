<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'image',
    ];
    public function jobs()
    {
        return $this->hasMany(JobListing::class);
    }
}
