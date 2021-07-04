<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'cart_key'];

    public function detail()
    {
        return $this->hasMany('App\Models\CartDetail')->orderByDESC('discount_price');
    }

    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon');
    }
}
