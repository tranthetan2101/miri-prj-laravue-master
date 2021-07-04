<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;
    public const PERCENT = 0;
    public const MONEY = 1;
    protected $fillable = [
        'name',
        'slug',
        'period_start',
        'period_end',
        'sale_amount',
        'type'
    ];
    protected $dates = [
        'period_start',
        'period_end',
    ];

    protected $table = 'sales';

    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'sale_items')->whereNull('gift_set');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'sale_items')->withTimestamps();
    }
}
