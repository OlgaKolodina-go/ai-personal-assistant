<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'timezone',
    ];

    public function habits()
    {
        return $this->hasMany(Habit::class);
    }
}