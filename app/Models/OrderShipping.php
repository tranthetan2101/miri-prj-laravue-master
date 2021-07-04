<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    protected $guarded = [];

    protected $table = "order_shipping";

    /**
     * Get City
     *
     * @return model
     */
    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    /**
     * Get District
     *
     * @return model
     */
    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
    
    /**
     * Get Ward
     *
     * @return model
     */
    public function ward()
    {
        return $this->hasOne('App\Models\Ward', 'id', 'ward_id');
    }
}
