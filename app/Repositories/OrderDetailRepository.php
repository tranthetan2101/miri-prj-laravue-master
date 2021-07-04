<?php

namespace App\Repositories;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class OrderDetailRepository.
 */
class OrderDetailRepository extends BaseRepository
{
    /**
     * OrderDetailRepository constructor.
     *
     * @param  OrderDetail  $model
     */
    public function __construct(OrderDetail $model)
    {
        $this->model = $model;
    }

    public function create($item)
    {
        $item = $this->parameters($item);
        $this->model->create($item);
    }

    public function parameters($item)
    {
        return [
            'order_id' => $item['order_id'] ?? '',
            'product_id' => $item['product_id'] ?? '',
            'quantity' => $item['quantity'] ?? '',
            'product_name' => $item->product->name ?? '',
            'price' => $item->discount_price ?? '',
            'price2' => $item->product->price ?? '',
            'cate_name' => $item->product->category->name ?? '',
        ];
    }
}