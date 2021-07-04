<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryFee extends Model
{
    use SoftDeletes;
    protected $fillable = ['city_id', 'district_id', 'ward_id', 'fee'];
    /**
     * Get City
     *
     * @return model
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'city_id', 'id');
    }
    /**
     * Get Dist
     *
     * @return model
     */
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }
    /**
     * Get Ward
     *
     * @return model
     */
    public function ward()
    {
        return $this->belongsTo('App\Models\Ward', 'ward_id', 'id');
    }
}
