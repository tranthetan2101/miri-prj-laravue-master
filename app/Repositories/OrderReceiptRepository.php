<?php

namespace App\Repositories;

use App\Models\OrderReceipt;
use App\Repositories\BaseRepository;
use Auth;

/**
 * Class OrderReceiptRepository.
 */
class OrderReceiptRepository extends BaseRepository
{
    /**
     * OrderReceiptRepository constructor.
     *
     * @param  OrderReceipt  $model
     */
    public function __construct(OrderReceipt $model)
    {
        $this->model = $model;
    }

    public function create($item)
    {
        $this->remove($item['order_id']);
        $item = $this->parameters($item);
        $this->model->create($item);
    }

    public function remove($order_id)
    {
        return $this->model->where('order_id','=',$order_id)->delete();
    }
    public function parameters($item)
    {
        return [
            'order_id' => $item['order_id'] ?? '',
            'company_name' => $item['receipt_company_name'] ?? '',
            'company_tax_number' => $item['receipt_tax_number'] ?? '',
            'addr' => $item['receipt_addr'] ?? '',
            'email' => $item['receipt_email'] ?? '',
            'receipt_phone_number' => $item['receipt_phone_number'] ?? '',
        ];
    }
}