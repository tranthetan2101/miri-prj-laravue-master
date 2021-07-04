<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class CartRepository.
 */
class CartRepository extends BaseRepository
{
    use \App\Models\Traits\CartTrait;
    /**
     * CartRepository constructor.
     *
     * @param  Cart  $model
     */
    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    public function create()
    {
        if (Auth::check()) {
            if (!$this->model->where('user_id', '=', Auth::user()->id)->exists()) {
                $this->model->create([
                    'user_id' => Auth::user()->id
                ]);
            }
        } else {
            $cart_key = request()->session()->get('cart_key');
            if (empty($cart_key) || !$this->model->where('cart_key', '=', $cart_key)->where('user_id', '=', null)->exists()) {
                $cart_key = Str::random(32);
                request()->session()->put('cart_key', $cart_key);
                $this->model->create([
                    'cart_key' => $cart_key
                ]);
            }
        }

        return $this->getCart();
    }

    public function getCart()
    {
        $cart = new Cart();
        if (Auth::check()) {
            $cart = $this->model->with('detail.product', 'coupon')->where('user_id', '=', Auth::user()->id)->first();
        } else {
            $cart_key = request()->session()->get('cart_key');
            if (!empty($cart_key)) {
                $cart = $this->model->with('detail.product', 'coupon')->where('cart_key', '=', $cart_key)->first();
            }
        }

        return $this->calculate($cart);
    }

    public function updateCartAfterLogin()
    {
        $cart_key = request()->session()->get('cart_key');
        if (!empty($cart_key)) {
            $cartSession = $this->model->with('detail.product', 'coupon')->where('cart_key', '=', $cart_key)->first();

            if (Auth::check()) {
                $cartUser = $this->model->with('detail.product', 'coupon')->where('user_id', '=', Auth::user()->id)->first();
                if (empty($cartUser)) {
                    $cartUser = $this->create();
                }
                $this->cartDetailRepository = new CartDetailRepository(new CartDetail());
                $this->productRepository = new ProductRepository(new Product());
                foreach ($cartSession->detail as $item) {
                    if ($item->discount_price != 0) {
                        $product = $this->productRepository->getById($item->product_id);
                        $this->cartDetailRepository->add($product, $item->quantity, $item->discount_price, $cartUser->id);
                    }
                }
            }
        }
    }

    public function addDiscount($coupon)
    {
        $cart = $this->getCart();
        $cart->coupon_id = $coupon->id ?? null;
        unset($cart->discount_price);
        if ($cart->save()) {
            return $cart;
        }
    }

    // public function calculate($cart)
    // {
    //     if (!empty($cart) && $cart->detail->count()) {
    //         $price = 0;
    //         $discount_price = 0;
    //         foreach ($cart->detail as $item) {
    //             $product = $item->product;
    //             if ($product->sale->count()) {
    //                 $product = $this->getPrice($product);
    //                 $discount_price += $product->discount_price * $item->quantity;
    //             }
    //             $price += $product->price * $item->quantity;
    //         }

    //         $cart->price = $price;
    //         $cart->discount_price = $discount_price;
    //     }

    //     return $cart;
    // }

    /**
     * Format product price
     *
     * @return product
     */
    // public function getPrice($product)
    // {
    //     $product->discount_price = $product->price - ($product->price * $product->sale->first()->sale_amount) / 100; // giá giảm
    //     return $product;
    // }

    public function destroy()
    {
        $cart = $this->getCart();
        if (!empty($cart)) {
            foreach ($cart->detail as $item) {$item->delete();};
            $cart->delete();
        }
    }
}
