<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class OrderRepository.
 */
class OrderRepository extends BaseRepository
{
    use \App\Models\Traits\OrderTrait;
    /**
     * OrderRepository constructor.
     *
     * @param  Order  $model
     */
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create($cart, $params = null)
    {
        if (Auth::check()) {
            $params = $this->getParamForUser();
        }

        $order_key = Str::random(32);
        \Session::put('order_key', $order_key);
        $params['order_key'] = $order_key;
        $params['subtotal'] = $cart->discount_price;
        $params['total'] = $cart->discount_price;
        $params['order_status'] = 0;
        if ($cart->coupon) {
            $params['discount'] = $cart->coupon->price;
            $params['coupon_code'] = $cart->coupon->code;
            $params['total'] = $cart->discount_price - $cart->coupon->price;
        }

        unset($params['receive-info']);
        unset($params['rule']);

        $params['uuid'] = Str::upper(uniqid());

        return $this->model->create($params);
    }

    public function getOrder()
    {
        return $this->model->with('shipping', 'receipt', 'detail')->where('order_key', \Session::get('order_key'))->first();
    }

    public function getHistoryOrder()
    {
        return $this->model->where('user_id', Auth::user()->id)->where('order_status', '!=', 0)->get();
    }

    public function getParamForUser()
    {
        $user = Auth::user();
        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone_number' => $user->detail->phone_number,
            'receive_phone_number' => '',
            'addr_number' => $user->detail->addr_number,
            'addr_street' => $user->detail->addr_street,
            'city_id' => $user->detail->city_id,
            'district_id' => $user->detail->district_id,
            'ward_id' => $user->detail->ward_id,
        ];
    }

    public function deleteAll($order)
    {
        if ($order->shipping) $order->shipping->delete();
        if ($order->receipt) $order->receipt->delete();
        foreach ($order->detail as $item) {
            $item->delete();
        };
        $order->delete();
    }

    public function completeOrder()
    {
        $order = $this->getOrder();

        if (empty($order)) {
            return $order;
        }

        \Session::forget('order_key');

        $order['order_status'] = 1;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function updateFeeShip($fee)
    {
        $order = $this->getOrder();

        $order['delivery_fee'] = $fee;

        $order['total'] = $order['subtotal'] + $fee;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function updatePrice($order)
    {
        $order['total'] = $order['total'] - $order['discount'] > 0 ? $order['total'] - $order['discount'] : 0;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function updateTransaction($transactionId)
    {
        $order = $this->getOrder();

        if (empty($order)) {
            return null;
        }

        $order['transaction_id'] = $transactionId;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function updateMethod($method)
    {
        $order = $this->getOrder();

        if (empty($order)) {
            return null;
        }

        $order['payment_method'] = $method;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function cancelOrder($id)
    {
        $order = $this->getById($id);

        if (empty($order)) {
            return null;
        }

        $order['order_status'] = 4;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function mark(Order $order, $status): Order
    {
        $order->order_status = $status;
        if ($order->save()) {
            return $order;
        }
        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }

    public function getOrderByKey($key)
    {
        return $this->model->with('shipping', 'receipt', 'detail')->where('order_key', $key)->first();
    }

    public function completeOrderByKey($key)
    {
        $order = $this->getOrderByKey($key);

        if (empty($order)) {
            return $order;
        }

        \Session::forget('order_key');

        $order['order_status'] = 1;

        if ($order->save()) {
            return $order;
        }

        throw new GeneralException(__('There was a problem updating this order. Please try again.'));
    }
}
