<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['email', 'is_sent'];

    protected $casts = [
        'is_sent' => 'datetime',
    ];
}
