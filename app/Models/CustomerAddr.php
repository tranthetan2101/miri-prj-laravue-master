<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddr extends Model
{
    protected $table = "customer_addresses";

    protected $guarded = [];

    /**
     * Get City
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    /**
     * Get District
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }

    /**
     * Get Ward
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ward()
    {
        return $this->hasOne('App\Models\Ward', 'id', 'ward_id');
    }

    /**
     * Get User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User');
    }
}
