<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Auth\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\CartDetailRepository;
use App\Repositories\CartRepository;
use App\Repositories\CoupleProductRepository;
use App\Repositories\CouponRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use \App\Models\Traits\ProductTrait;
    /**
     * @var CartRepository
     */
    protected $cartRepository;

    /**
     * @var CartDetailRepository
     */
    protected $cartDetailRepository;

    /**
     * @var OrderRepository
     */
    protected $orderRepository;

    /**
     * @var OrderDetailRepository
     */
    protected $orderDetailRepository;

    /**
     * @var CoupleProductRepository
     */
    protected $coupleProductRepository;

    /**
     * CartController constructor
     * 
     * @param CartRepository $cartRepository
     * @param CartDetailRepository $cartDetailRepository
     * @param OrderRepository $orderRepository
     * @param OrderDetailRepository $orderDetailRepository
     * @param CoupleProductRepository $coupleProductRepository
     */
    public function __construct(
        CartRepository $cartRepository, 
        CartDetailRepository $cartDetailRepository,
        OrderRepository $orderRepository,
        OrderDetailRepository $orderDetailRepository,
        CoupleProductRepository $coupleProductRepository,
        ProductRepository $productRepository,
        CouponRepository $couponRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->cartDetailRepository = $cartDetailRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->coupleProductRepository = $coupleProductRepository;
        $this->productRepository = $productRepository;
        $this->couponRepository = $couponRepository;
    }

    /**
     * CartController index
     * 
     * @return view
     */
    function index()
    {
        $cart = $this->cartRepository->getCart();
        $products = !empty($cart) ? $this->productRepository->getProductRecommend($cart) : [];
        return view('frontend.cart.index', compact('cart', 'products'));
    }

    /**
     * Remove item from cart
     * 
     * @param $id // cartItem Id
     * 
     * @return Redirect
     */
    function deleteItem($id)
    {
        $this->cartDetailRepository->delete($id);

        return redirect()->back();
    }

    /**
     * Return model Cart
     * 
     * @return renderView
     */
    function getOnCart()
    {
        $cart = $this->cartRepository->getCart();
        
        return view('frontend.cart.onCart', compact('cart'))->render();
    }

    public function getPageCart()
    {
        $cart = $this->cartRepository->getCart();
        
        if (empty($cart)) {
            return null;
        }
        
        return view('frontend.cart.detail', compact('cart'))->render();
    }

    /**
     * Handle event of model cart
     * 
     * @param Request @request
     * 
     * @return Price
     */
    function handleCart(Request $request)
    {
        $operation = $request->operation;

        switch ($operation) {
            case 'up':
                $this->cartDetailRepository->increment($request->item_id);
                break;
            case 'down':
                $this->cartDetailRepository->decrement($request->item_id);
                break;
            case 'change':
                $this->cartDetailRepository->change($request->item_id, $request->quantity);
                break;
            case 'delete':
                $this->cartDetailRepository->delete($request->item_id);
                break;
            default:
                break;
        }

        $this->cartRepository->addDiscount(null);
        $cart = $this->cartRepository->getCart();

        return [
            'price' => number_format($cart->price),
            'discount_price' => number_format($cart->discount_price)
        ];
    }

    /**
     * Add item to cart
     * 
     * @param Request @request
     * 
     * @return renderView
     */
    function addItem(Request $request)
    {
        // if don't have cart then create cart
        $cart = $this->cartRepository->create();
        $product = $this->productRepository->getById($request->product_id);

        $this->cartDetailRepository->add($product, $request->quantity, $request->product_discount_price, $cart->id);
        $this->cartRepository->addDiscount(null);

        return true;
    }

    function addGiftSet(Request $request)
    {
        // if don't have cart then create cart
        $cart = $this->cartRepository->create();
        $product = $this->productRepository->getById($request->product_id);

        $this->cartDetailRepository->add($product, 1, $request->discount_price, $cart->id);
        $this->cartRepository->addDiscount(null);

        return true;
    }

    /**
     * Add couple item to cart
     * 
     * @param Request @request
     * 
     * @return renderView
     */
    function addCoupleProduct(Request $request)
    {
        // if don't have cart then create cart
        $cart = $this->cartRepository->create();

        $couple = $this->coupleProductRepository->getById($request->couple_id);

        // product 1
        $product = $this->formatProduct($couple->product1);
        $this->cartDetailRepository->add($product, 1, $product->discount_price, $cart->id);

        // product 2
        $product = $this->formatProduct($couple->product2);
        $this->cartDetailRepository->add($product, 1, $product->discount_price, $cart->id);

        return true;
    }

    function addDiscount(Request $request) 
    {
        $coupon = $this->couponRepository->getByCode($request->code);

        if (is_null($coupon)) {
            $this->cartRepository->addDiscount(null);
            return false;
        }

        $this->cartRepository->addDiscount($coupon);
        return true;
    }

    /**
     * Button thanh toán
     * 
     * @return Redirect
     */
    function checkout()
    {
        if (Auth::check()) {
            if (Auth::user()->isType(User::TYPE_ADMIN)) {
                return redirect()->route('admin.dashboard')->withFlashDanger(__('You can not shopping by admin account.'));
            }
            $cart = $this->cartRepository->getCart();
            $order = $this->orderRepository->create($cart);
            foreach ($cart->detail as $item) {
                $item['order_id'] = $order->id;
                $this->orderDetailRepository->create($item);
            }
            return redirect(route('frontend.shopping'));
        } else {
            return redirect(route('frontend.shopping.login'));
        }
    }
}
