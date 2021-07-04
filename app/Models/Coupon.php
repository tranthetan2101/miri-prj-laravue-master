<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;
    protected $dates = [
        'period_start',
        'period_end'
    ];
    protected $fillable = ['code', 'price', 'name', 'slug', 'period_start', 'period_end', 'open_time', 'used_num', 'used_num_unlimited'];

}
