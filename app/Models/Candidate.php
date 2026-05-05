<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'address',
        'membership',
        'membership_name',
        'profile_pic',
        'gallery',
        'has_experience',
        'experience_list',
        'has_awards',
        'awards_list',
        'status',
    ];

    protected $casts = [
        'gallery' => 'array',
        'has_experience' => 'boolean',
        'has_awards' => 'boolean',
    ];
}
