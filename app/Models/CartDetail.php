<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'discount_price'];
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
