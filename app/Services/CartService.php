<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Hash;

class CartService
{
    use \App\Models\Traits\ProductTrait;
    
    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function calculate($cart)
    {
        if (!empty($cart) && $cart->detail->count()) {
            $price = 0;
            $discount_price = 0;
            foreach ($cart->detail as $item) {
                $product = $this->formatProduct($item->product);
                $discount_price += $product->discount_price * $item->quantity;

                $price += $product->price * $item->quantity;
            }

            $cart->price = $price;
            $cart->discount_price = $discount_price;
        }

        return $cart;
    }
}