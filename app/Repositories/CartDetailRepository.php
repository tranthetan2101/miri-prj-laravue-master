<?php

namespace App\Repositories;

use App\Models\CartDetail;
use App\Repositories\BaseRepository;

/**
 * Class CartRepository.
 */
class CartDetailRepository extends BaseRepository
{
    /**
     * CartRepository constructor.
     *
     * @param  CartDetail  $model
     */
    public function __construct(CartDetail $model)
    {
        $this->model = $model;
    }

    public function increment($id)
    {
        $cartDetail = $this->getById($id);

        $cartDetail->increment('quantity');

        foreach ($cartDetail->product->bonuses as $bonus) {
            $this->addBonus($bonus->id, $cartDetail->cart_id, 1);
        }

        $cartDetail->save();
    }

    public function decrement($id)
    {
        $cartDetail = $this->getById($id);

        $cartDetail->decrement('quantity');

        foreach ($cartDetail->product->bonuses as $bonus) {
            $this->deleteBonus($bonus->id, $cartDetail->cart_id, 1);
        }

        if ($cartDetail->quantity == 0) {
            return $cartDetail->delete();
        }

        $cartDetail->save();
    }

    public function minus($id, $quantity)
    {
        $cartDetail = $this->getById($id);

        $cartDetail->quantity -= $quantity;

        if ($cartDetail->quantity == 0) {
            return $cartDetail->delete();
        }

        $cartDetail->save();
    }

    public function change($id, $quantity)
    {
        $cartDetail = $this->getById($id);

        if ($quantity > $cartDetail->quantity) {
            foreach ($cartDetail->product->bonuses as $bonus) {
                $this->addBonus($bonus->id, $cartDetail->cart_id, $quantity - $cartDetail->quantity);
            }
        } else {
            foreach ($cartDetail->product->bonuses as $bonus) {
                $this->deleteBonus($bonus->id, $cartDetail->cart_id, $cartDetail->quantity - $quantity);
            }
        }
        $cartDetail->quantity = $quantity;

        $cartDetail->save();
    }

    public function delete($id)
    {
        $cartDetail = $this->getById($id);
        
        foreach ($cartDetail->product->bonuses as $bonus) {
            $this->deleteBonus($bonus->id, $cartDetail->cart_id, $cartDetail->quantity);
        }
        
        return $cartDetail->delete();
    }

    public function add($product, $quantity, $discount_price, $cart_id)
    {
        $cartDetail = $this->model->where('cart_id', '=', $cart_id)->where('product_id', '=', $product->id)->where('discount_price','!=', 0)->first();
        if (empty($cartDetail)) {
            $params = [
                'cart_id' => $cart_id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'discount_price' => $discount_price
            ];
            $this->model->create($params);
        } else {
            $cartDetail->quantity += $quantity;
            $cartDetail->save();
        }

        foreach ($product->bonuses as $bonus) {
            $this->addBonus($bonus->id, $cart_id, $quantity);
        }
    }

    public function addBonus($id, $cart_id, $quantity)
    {
        $cartDetail = $this->model->where('cart_id', '=', $cart_id)->where('product_id', '=', $id)->where('discount_price', '=', 0)->first();
        if (empty($cartDetail)) {
            $params = [
                'cart_id' => $cart_id,
                'product_id' => $id,
                'quantity' => $quantity,
                'discount_price' => 0,
            ];
            $this->model->create($params);
        } else {
            $cartDetail->quantity += $quantity;
            $cartDetail->save();
        }
    }

    public function deleteBonus($id, $cart_id, $quantity)
    {
        $cartDetail = $this->model->where('cart_id', '=', $cart_id)->where('product_id', '=', $id)->where('discount_price', '=', '0')->first();
        if (!empty($cartDetail)) {
            $this->minus($cartDetail->id, $quantity);
        }
    }
}
