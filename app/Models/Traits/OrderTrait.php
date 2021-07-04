<?php

namespace App\Models\Traits;

use App\Repositories\DeliveryFeeRepository;

trait OrderTrait
{
    use \App\Models\Traits\CartTrait;

    /**
     * Format product price
     *
     * @return product
     */
    public function formatOrder($order)
    {
        // $order->detail = $this->formatListProduct($order->detail);

        return $order;
    }

    
}