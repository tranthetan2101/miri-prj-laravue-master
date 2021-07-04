<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'area',
        'type',
        'starts_at',
        'ends_at',
        'message',
        'enabled'
    ];
    protected $dates = [
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'enabled' => 'boolean'
    ];
    protected $attributes = [
        'area' => 'frontend',
        'type' => 'info'
    ];


    protected $table = 'announcements';


}
