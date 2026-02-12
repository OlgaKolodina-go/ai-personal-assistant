<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Habit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }
}