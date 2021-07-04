<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CoupleProduct extends Model
{
    protected $table = "couple_products";

    protected $fillable = ['product1_id', 'product2_id', 'product1_image', 'product2_image'];

    /**
     * Get Product 1
     *
     * @return model
     */
    public function product1()
    {
        return $this->belongsTo('App\Models\Product', 'product1_id', 'id');
    }

    /**
     * Get Product 2
     *
     * @return model
     */
    public function product2()
    {
        return $this->belongsTo('App\Models\Product', 'product2_id', 'id');
    }

    /**
     * Get the image1.
     *
     * @param  string  $value
     * @return string
     */
    public function getProduct1ImageAttribute($value)
    {
        return empty($value) ? $this->product1->picture : (filter_var(str_replace(" ", "_", $value), FILTER_VALIDATE_URL) ? $value : Storage::url($value));
    }

    /**
     * Get the image2.
     *
     * @param  string  $value
     * @return string
     */
    public function getProduct2ImageAttribute($value)
    {
        return empty($value) ? $this->product2->picture : (filter_var(str_replace(" ", "_", $value), FILTER_VALIDATE_URL) ? $value : Storage::url($value));
    }
}
