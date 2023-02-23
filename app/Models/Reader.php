<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Reader extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'birthdate', 'is_blocked'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class)->withPivot('count')->withTimestamps();
    }
}


