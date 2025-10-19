<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name', 'content', 'include_sent', 'image', 'count'];

    protected $casts = [
        'include_sent' => 'boolean',
        'schedule_time' => 'datetime',
        'count' => 'integer',
    ];
}
