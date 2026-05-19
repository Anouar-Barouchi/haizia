<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
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
        'code',
        'password',
        'competition_status',
        'competition_started_at',
        'competition_submitted_at',
        'camera_brand',
        'camera_model',
        'camera_lenses',
        'competition_submissions',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function booted()
    {
        static::creating(function ($candidate) {
            if (empty($candidate->code)) {
                $candidate->code = \Illuminate\Support\Str::uuid()->toString();
            }
        });
    }

    protected $casts = [
        'gallery' => 'array',
        'has_experience' => 'boolean',
        'has_awards' => 'boolean',
        'competition_submissions' => 'array',
        'competition_started_at' => 'datetime',
        'competition_submitted_at' => 'datetime',
    ];
}
