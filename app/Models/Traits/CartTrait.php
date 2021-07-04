<?php

namespace App\Models\Traits;

trait CartTrait
{
    use \App\Models\Traits\ProductTrait;

    public function calculate($cart)
    {
        if (!empty($cart) && $cart->detail->count()) {
            $price = 0;
            $discount_price = 0;
            foreach ($cart->detail as $item) {
                if ($item->discount_price != 0) {
                    $product = $this->formatProduct($item->product);
                    $discount_price += $item->discount_price * $item->quantity;
    
                    $price += $product->price * $item->quantity;
                }
            }

            $cart->price = $price;
            $cart->discount_price = $discount_price;
        }

        return $cart;
    }
}