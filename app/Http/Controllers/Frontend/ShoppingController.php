<?php

namespace App\Http\Controllers\Frontend;

use App\Exceptions\GeneralException;
use App\Http\Requests\OrderInfoRequest;
use App\Mail\OrderConfirmed;
use App\Models\OrderReceipt;
use App\Repositories\CartRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderReceiptRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderShoppingRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CustomerAddr;
use App\Models\DeliveryFee;
use App\Repositories\CustomerAddrRepository;
use App\Repositories\DeliveryFeeRepository;
use App\Repositories\ReceiveInfoRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ShoppingController extends Controller
{
    use \App\Models\Traits\OrderTrait;
    /**
     * ShoppingController contructor
     *
     * @param OrderRepository $orderRepository
     * @param CartRepository $cartRepository
     * @param OrderDetailRepository $orderDetailRepository
     * @param OrderShoppingRepository $orderShoppingRepository
     * @param OrderReceiptRepository $orderReceiptRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        CartRepository $cartRepository,
        OrderDetailRepository $orderDetailRepository,
        OrderShoppingRepository $orderShoppingRepository,
        OrderReceiptRepository $orderReceiptRepository,
        ProductRepository $productRepository,
        DeliveryFeeRepository $deliveryFeeRepository,
        ReceiveInfoRepository $receiveInfoRepository,
        CustomerAddrRepository $customerAddrRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->cartRepository = $cartRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->orderShoppingRepository = $orderShoppingRepository;
        $this->orderReceiptRepository = $orderReceiptRepository;
        $this->productRepository = $productRepository;
        $this->deliveryFeeRepository = $deliveryFeeRepository;
        $this->receiveInfoRepository = $receiveInfoRepository;
        $this->customerAddrRepository = $customerAddrRepository;
    }

    /**
     * ShoppingController index
     *
     * @return view
     */
    public function index()
    {
        $order = $this->orderRepository->getOrder();

        if ($this->checkExits($order)) {
            return redirect()->route('frontend.cart.index');
        }

        $fee = $this->deliveryFeeRepository->getFee($order);
        $order = $this->orderRepository->updateFeeShip($fee);
        $order = $this->orderRepository->updatePrice($order);
        $address = new CustomerAddr();
        if (Auth::check()) {
            $address = $this->customerAddrRepository->getByUser();
        }
        return view('frontend.shopping.index', compact('order', 'address'));
    }

    /**
     * Page input info for guest
     *
     * @return view
     */
    public function getInfo()
    {
        $cart = $this->cartRepository->getCart();
        $order = $this->orderRepository->getOrder();
        if ($this->checkExits($cart)) {
            return redirect()->route('frontend.cart.index');
        }

        return view('frontend.shopping.info', compact('cart', 'order'));
    }

    /**
     * Submit page input info for guest
     *
     * @param OrderInfoRequest $request
     *
     * @return redirect
     */
    public function postInfo(OrderInfoRequest $request)
    {
        $request->flash();
        $cart = $this->cartRepository->getCart();

        if ($this->checkExits($cart)) {
            return redirect()->route('frontend.cart.index');
        }

        $order = $this->orderRepository->create($cart, $request->parameters());
        foreach ($cart->detail as $item) {
            $item['order_id'] = $order->id;
            $this->orderDetailRepository->create($item);
        }

        if (isset($request['receive-info'])) {
            $this->receiveInfoRepository->create($request->parameters());
        }
        return redirect(route('frontend.shopping'));
    }

    /**
     * Page confirm
     *
     * @param Request $request
     *
     * @return view
     */
    public function confirm(Request $request)
    {
        $order = $this->orderRepository->getOrder();
        $order->note = $request->note;
        $order->save();

        return view('frontend.shopping.confirm', compact('order'));
    }

    /**
     * Page choose payment
     *
     * @return view
     */
    public function payment()
    {
        return view('frontend.shopping.payment');
    }

    public function postPayment(Request $request)
    {
        $paymentMethod = $request->payment_method;
        $order = $this->orderRepository->getOrder();
        if (!in_array($paymentMethod, setting('payment_methods'))) {
            return abort(404);
        }
        $this->productRepository->updateStock($order);
        if ($paymentMethod != 'COD') {
            switch ($paymentMethod) {
                case 'MOMO':
                    $this->orderRepository->updateMethod(2);
                     $response = \MoMoAIO::purchase([
                         'amount' => $order->total,
                         'returnUrl' => route('frontend.momo.complete'),
                         'notifyUrl' => route('frontend.momo.ipn'),
                         'orderId' => \Session::get('order_key'),
                         'requestId' => uniqid(),
                     ])->send();
                    break;
                case 'ATM':
                    $this->orderRepository->updateMethod(3);
                     $response = \OnePayDomestic::purchase([
                         'AgainLink' => url()->full(),
                         'vpc_MerchTxnRef' => uniqid(),
                         'vpc_ReturnURL' => route('frontend.atm.complete'),
                         'vpc_TicketNo' => \Request::ip(),
                         'vpc_Amount' => $order->total * 100,
                         'vpc_OrderInfo' => \Session::get('order_key'),
                         'Title' => 'MIRI ATM order '.date("YmdHis")
                     ])->send();
                    break;
                case 'CC':
                    $this->orderRepository->updateMethod(4);
                    $response = \OnePayInternational::purchase([
                        'AgainLink' => url()->full(),
                        'vpc_MerchTxnRef' => uniqid(),
                        'vpc_ReturnURL' => route('frontend.cc.complete'),
                        'vpc_TicketNo' => \Request::ip(),
                        'vpc_Amount' => $order->total * 100,
                        'vpc_OrderInfo' => \Session::get('order_key'),
                        'Title' => 'MIRI CC order'.date("YmdHis")
                    ])->send();
                    break;
            }
             if ($response->isRedirect() && !empty($response->getRedirectUrl())) {
                 $redirectUrl = $response->getRedirectUrl();
                 //$this->orderRepository->updateTransaction($response->signature ?: $response->vpc_SecureHash);
                 return redirect($redirectUrl);
             } else {
                 return view('frontend.shopping.error');
             }
        } else {
            $this->orderRepository->updateMethod(1);
        }

        return redirect(route('frontend.shopping.complete'));
    }

    public function error()
    {
        return view('frontend.shopping.error');
    }

    /**
     * Page complete
     *
     * @return view
     * @throws GeneralException
     */
    public function complete()
    {
        $this->cartRepository->destroy();
        $order = $this->orderRepository->completeOrder();
        if (empty($order)) {
            return redirect(route('frontend.index'));
        }

        if (false) {
            $this->productRepository->revertStock($order);
        }
        // send Order email
        Mail::to($order->email)->send(new OrderConfirmed($order));

        return view('frontend.shopping.complete', compact('order'));
    }

    /**
     * Page complete
     *
     * @return view
     * @throws GeneralException
     */
    public function momoComplete()
    {
         $response = \MoMoAIO::completePurchase()->send();
         if ($response->isSuccessful()) {
             $this->cartRepository->destroy();
             $order = $this->orderRepository->completeOrder();
             if (empty($order)) {
                 return redirect(route('frontend.index'));
             }
             Mail::to($order->email)->send(new OrderConfirmed($order));
             return view('frontend.shopping.complete', compact('order'));
         } else {
             $order = $this->orderRepository->getOrder();
             if ($order)
             {
                 $this->productRepository->revertStock($order);
             }
             return redirect(route('frontend.shopping.error'))->with('error', $response->getMessage());
         }
    }

    public function momoIpn()
    {
        $response = \MoMoAIO::notification()->send();

        if ($response->isSuccessful()) {
            try {
                $this->orderRepository->updateTransaction($response->transId);
                $order = $this->orderRepository->completeOrderByKey($response->orderId);
                if (empty($order))
                {
                    Log::error('Momo Ipn order not found: '.$response->orderId);
                }
            } catch (GeneralException $e) {
                Log::error('Momo Ipn error on update transaction '.$response->orderId);
            }
        } else {
            Log::error('Momo Ipn error: '.$response->getMessage());
        }
    }

    /**
     * Page complete
     *
     * @return view
     * @throws GeneralException
     */
    public function atmComplete()
    {
         $response = \OnePayDomestic::completePurchase()->send();

         if ($response->isSuccessful()) {
             $this->cartRepository->destroy();
             $order = $this->orderRepository->completeOrder();
             if (empty($order)) {
                 return redirect(route('frontend.index'));
             }
             Mail::to($order->email)->send(new OrderConfirmed($order));
             return view('frontend.shopping.complete', compact('order'));
         } else {
             $order = $this->orderRepository->getOrder();
             if ($order)
             {
                 $this->productRepository->revertStock($order);
             }
             return redirect(route('frontend.shopping.error'))->with('error',$response->getCode() == 99 ? 'Bạn đã hủy đơn hàng' : $response->getMessage());
         }
    }

    /**
     * Page complete
     *
     * @return view
     * @throws GeneralException
     */
    public function ccComplete()
    {
        $response = \OnePayInternational::completePurchase()->send();

        if ($response->isSuccessful()) {
            $this->cartRepository->destroy();
            $order = $this->orderRepository->completeOrder();
            if (empty($order)) {
                return redirect(route('frontend.index'));
            }
            Mail::to($order->email)->send(new OrderConfirmed($order));
            return view('frontend.shopping.complete', compact('order'));
        } else {
            $order = $this->orderRepository->getOrder();
            if ($order)
            {
                $this->productRepository->revertStock($order);
            }
            return redirect(route('frontend.shopping.error'))->with('error',$response->getCode() == 99 ? 'Bạn đã hủy đơn hàng' : $response->getMessage());
        }
    }

    public function onepayIpn()
    {
        $response = \OnePayDomestic::notification()->send();

        if ($response->isSuccessful()) {
            try {
                $this->orderRepository->updateTransaction($response->vpc_TransactionNo);
                $order = $this->orderRepository->completeOrderByKey($response->vpc_OrderInfo);
                if (empty($order))
                {
                    Log::error('Onepay Ipn order not found: '.$response->vpc_OrderInfo);
                }
            } catch (GeneralException $e) {
                Log::error('Onepay Ipn error on update transaction '.$response->vpc_OrderInfo);
            }
        } else {
            Log::error('Onepay Ipn error: '.$response->getMessage());
        }
    }

    /**
     * Add other address
     *
     * @param Request $request
     *
     * @return reloadPage
     */
    public function addOtherAddr(Request $request)
    {
        $order = $this->orderRepository->getOrder();

        if ($this->checkExits($order)) {
            return redirect()->route('frontend.cart.index');
        }

        $params = $request->all();
        $params['order_id'] = $order->id;
        $this->orderShoppingRepository->remove($order->id);
        $this->orderShoppingRepository->create($params);
        return redirect()->back();
    }

    /**
     * Cancel add other address
     *
     * @return reloadPage
     */
    public function cancelOtherAddr()
    {
        $order = $this->orderRepository->getOrder();

        if ($this->checkExits($order)) {
            return redirect()->route('frontend.cart.index');
        }

        $this->orderShoppingRepository->remove($order->id);
        return redirect()->back();
    }

    /**
     * Add receipt info
     *
     * @return reloadPage
     */
    public function addReceipt(Request $request)
    {
        $order = $this->orderRepository->getOrder();

        if ($this->checkExits($order)) {
            return redirect()->route('frontend.cart.index');
        }

        $params = $request->all();
        $params['order_id'] = $order->id;

        $this->orderReceiptRepository->create($params);

        return redirect()->back();
    }

    /**
     * Cancel add receipt info
     *
     * @return reloadPage
     */
    public function cancelReceipt()
    {
        $order = $this->orderRepository->getOrder();

        if ($this->checkExits($order)) {
            return redirect()->route('frontend.cart.index');
        }

        $this->orderReceiptRepository->remove($order->id);
        return redirect()->back();
    }

    public function checkExits($cart)
    {
        return (!isset($cart)) || ($cart->detail->count() == 0);
    }

    public function checkStock($order)
    {
        foreach ($order->detail as $item)
        {
            if ($item->product->stock_unlimited != 1 && $item->product->stock < $item->quantity) {
                return false;
            }
        }

        return true;
    }
}
