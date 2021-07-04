<?php

namespace App\Models\Traits;

use App\Models\Sale;

trait ProductTrait
{
    /**
     * Format product price
     *
     * @return product
     */
    public function formatProduct($product)
    {
        if ($product->sale->count()) {
            $product->discount_price = $product->price - $this->getSaleAmount($product); // giá giảm
        }
        return $product;
    }

    public function formatListProduct($products)
    {
        if (empty($products)) {
            return null;
        }
        foreach ($products as $key => $product) {
            $products[$key] = $this->formatProduct($product);
        }

        return $products;
    }

    public function getSaleAmount($product) 
    {
        if ($product->sale->first()->type == Sale::PERCENT) {
            return ($product->price * $product->sale->first()->sale_amount) / 100;
        }

        return $product->sale->first()->sale_amount;
    }
}