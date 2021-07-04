<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Uuid;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'description_2',
        'description_3',
        'active',
        'category_id',
        'sku',
        'stock',
        'stock_unlimited',
        'price',
        'favorite_flg',
        'capacity',
        'origin',
        'gift_set',
        'recommend',
        'bonus',
        'tag_best',
        'tag_recommend',
        'tag_sale',
        'discount_price'
    ];

    protected $table = 'products';

    protected $casts = [
        'gift_set' => 'json',
        'recommend' => 'json',
        'bonus' => 'json'
    ];

    /**
     * Get sale orderBy sale amount
     *
     * @return model
     */
    public function sale()
    {
        return $this->belongsToMany('App\Models\Sale', 'sale_items')->orderBy('sale_amount')->where('period_end', '>', date('Y-m-d H:i:s'))->where('period_start', '<', date('Y-m-d H:i:s'));
    }

    /**
     * Get Image
     *
     * @return model
     */
    public function images()
    {
        return $this->hasMany('App\Models\ProductImage', 'product_id', 'id')->orderBy('sort_no', 'asc');
    }

    /**
     * Get Category
     *
     * @return model
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    /**
     * Get Product
     *
     * @return model
     */
    public function productGiftSet()
    {
        return $this->belongsToJson('App\Models\Product', 'gift_set');
    }


    public function gifts()
    {
        return $this->belongsToJson('App\Models\Product', 'gift_set');
    }

    public function prodGifts()
    {
        return $this->hasManyJson('App\Models\Product', 'gift_set');
    }

    public function recommends()
    {
        return $this->belongsToJson('App\Models\Product', 'recommend');
    }

    public function prodRecommends()
    {
        return $this->hasManyJson('App\Models\Product', 'recommend');
    }

    public function bonuses()
    {
        return $this->belongsToJson('App\Models\Product', 'bonus');
    }

    public function prodBonuses()
    {
        return $this->hasManyJson('App\Models\Product', 'bonus');
    }

    /**
     * @param $query
     * @param bool $status
     *
     * @return mixed
     */
    public function scopeActive($query, $status = true)
    {
        return $query->where('active', $status);
    }

    /**
     * Get Product
     *
     * @return model
     */
    public function productRecommend()
    {
        return $this->belongsToJson('App\Models\Product', 'recommend');
    }

    public function sales()
    {
        return $this->belongsToMany('App\Models\Sale', 'sale_items');
    }

    public function productRating()
    {
        return $this->hasMany('App\Models\ProductRating', 'product_id');
    }
}
