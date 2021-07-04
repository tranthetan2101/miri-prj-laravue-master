<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;

class Order extends Model
{
    use SoftDeletes;
    public const STATUSES = ['Đang tạo đơn hàng','Chờ xác nhận','Đang vận chuyển','Hoàn thành','Hủy'];
    public const PAYMENT_TYPES = ['1' => 'COD', '2' => 'Momo', '3' => 'ATM', '4' => 'CC'];
    protected $guarded = [];
    protected $appends = [
        'status',
        'payment_type'
    ];
    protected $dates = [
        'order_date',
        'payment_date'
    ];

    public function user()
    {
        return $this->belongsTo('App\Domains\Auth\Models\User');
    }

    public function shipping()
    {
        return $this->hasOne('App\Models\OrderShipping');
    }

    public function receipt()
    {
        return $this->hasOne('App\Models\OrderReceipt');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

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

    public function getStatusAttribute()
    {
        return !empty(self::STATUSES[$this->order_status]) ? self::STATUSES[$this->order_status] : 'Unknown';
    }
    public function getPaymentTypeAttribute()
    {
        return !empty(self::PAYMENT_TYPES[$this->payment_method]) ? self::PAYMENT_TYPES[$this->payment_method] : 'Unknown';
    }
}
