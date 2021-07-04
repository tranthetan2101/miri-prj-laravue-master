<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Combo extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'sku',
        'stock',
        'image',
        'product_id',
//        'products',
        'price',
        'discount_price'
    ];

    protected $table = 'combos';

    protected $casts = [
        'products' => 'json'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'picture',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function items()
    {
        return $this->belongsToJson('App\Models\Product', 'products', 'id');
    }

    /**
     * Get Category
     *
     * @return model
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function getPictureAttribute()
    {
        return filter_var(str_replace(" ", "_", $this->image), FILTER_VALIDATE_URL) ? $this->image : Storage::url($this->image);
    }
}
