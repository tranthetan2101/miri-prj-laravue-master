<?php

namespace App\Repositories;

use App\Models\OrderShipping;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class OrderShoppingRepository.
 */
class OrderShoppingRepository extends BaseRepository
{
    /**
     * OrderShoppingRepository constructor.
     *
     * @param  OrderShipping  $model
     */
    public function __construct(OrderShipping $model)
    {
        $this->model = $model;
    }

    public function create($shipping)
    {
        $shipping = $this->format($shipping);

        return $this->model->create($shipping);
    }

    public function remove($order_id)
    {
        return $this->model->where('order_id','=',$order_id)->delete();
    }

    public function format($shipping)
    {
        return [
            'order_id' => $shipping['order_id'] ?? '',
            'name' => $shipping['name'] ?? '',
            'phone_number' => $shipping['phone_number'] ?? '',
            'addr_number' => $shipping['other_addr_number'] ?? '',
            'addr_street' => $shipping['other_addr_street'] ?? '',
            'city_id' => $shipping['city_id'] ?? '',
            'district_id' => $shipping['district_id'] ?? '',
            'ward_id' => $shipping['ward_id'] ?? '',
        ];
    }
}