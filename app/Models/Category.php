<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'image',
        'icon',
        'visible'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visible' => 'boolean',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];

    /**
     * Get Product
     *
     * @return model
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product')->whereNull('products.gift_set');
    }

    /**
     * Get Child Category
     *
     * @return model
     */
    public function childCategory()
    {
        return $this->hasMany('App\Models\Category', 'parent_category_id', 'id');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereVisible(false);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyActive($query)
    {
        return $query->whereVisible(true);
    }

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->image), FILTER_VALIDATE_URL) ? $this->image : Storage::url($this->image);
    }

    /**
     * Get the icon.
     *
     * @param  string  $value
     * @return string
     */
    public function getIconAttribute($value)
    {
        return filter_var(str_replace(" ", "_", $value), FILTER_VALIDATE_URL) ? $value : Storage::url($value);
    }
}
