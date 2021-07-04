<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use App\Models\ReceiveInfo;
use App\Repositories\BannerRepository;
use App\Repositories\BlogRepository;
use App\Repositories\CartDetailRepository;
use App\Repositories\CartRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CityRepository;
use App\Repositories\ContactRepository;
use App\Repositories\CoupleProductRepository;
use App\Repositories\DistrictRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ReceiveInfoRepository;
use App\Repositories\WardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComponentController extends Controller
{
    /**
     * BannerRepository
     */
    protected $bannerRepository;

    /**
     * ProductRepository
     */
    protected $productRepository;

    /**
     * CategoryRepository
     */
    protected $categoryRepository;

    /**
     * CoupleProductRepository
     */
    protected $coupleProductRepository;

    /**
     * ReceiveInfoRepository
     */
    protected $receiveInfoRepository;

    /**
     * BlogRepository
     */
    protected $blogRepository;

    /**
     * CartRepository
     */
    protected $cartRepository;

    /**
     * CartDetailRepository
     */
    protected $cartDetailRepository;

    protected $cityRepository;
    protected $districtRepository;
    protected $wardRepository;

    /**
     * ComponentController contrust
     *
     * @param BannerRepository
     * @param ProductRepository
     * @param CategoryRepository
     * @param CoupleProductRepository
     * @param ReceiveInfoRepository
     * @param BlogRepository
     * @param CartRepository
     * @param CartDetailRepository
     *
     */
    public function __construct(
        BannerRepository $bannerRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        CoupleProductRepository $coupleProductRepository,
        ReceiveInfoRepository $receiveInfoRepository,
        BlogRepository $blogRepository,
        CartRepository $cartRepository,
        CartDetailRepository $cartDetailRepository,
        CityRepository $cityRepository,
        DistrictRepository $districtRepository,
        WardRepository $wardRepository,
        ContactRepository $contactRepository
    ) {
        $this->bannerRepository = $bannerRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->coupleProductRepository = $coupleProductRepository;
        $this->receiveInfoRepository = $receiveInfoRepository;
        $this->blogRepository = $blogRepository;
        $this->cartRepository = $cartRepository;
        $this->cartDetailRepository = $cartDetailRepository;
        $this->cityRepository = $cityRepository;
        $this->districtRepository = $districtRepository;
        $this->wardRepository = $wardRepository;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Get list Banner
     *
     * @return Banners
     */
    public function getBanner()
    {
        return $this->bannerRepository->all();
    }

    /**
     * Get list Favorite Product
     *
     * @return Products
     */
    public function getFavoriteProduct()
    {
        $products = $this->productRepository->getFavoriteProduct();
        return $products->map(function($product) {
            if ($product->sale->count()) {
                $product->sale[0]->period_end_unix_ts = $product->sale[0]->period_end->timestamp;
            }
            return $product;
        });
    }

    /**
     * Get list Category
     *
     * @return Categorys
     */
    public function getListCategory()
    {
        return $this->categoryRepository->getListCategory();
    }

    /**
     * Get list Blog
     *
     * @return Blog
     */
    public function getListBlog()
    {
        return $this->blogRepository->all();
    }

    /**
     * Get list CoupleProduct
     *
     * @return CoupleProducts
     */
    public function getListCoupleProduct()
    {
        return $this->coupleProductRepository->getlistCoupleProduct();
    }

    /**
     * Get list Receive Info
     *
     * @return ReceiveInfos
     */
    public function postReceiveInfo(Request $request)
    {
        return $this->receiveInfoRepository->create($request->all());
    }

    /**
     * Get Cart quantity
     */
    public function getCartQuantity()
    {
        $cart = $this->cartRepository->getCart();

        return !empty($cart->detail) ? $cart->detail->count() : 0;
    }

    public function ajaxLocations(Request $request)
    {
        $repo =  $request->get('type','city').'Repository';
        return response()->json($this->{$repo}->getPaginated(10,
            'id',
            'desc',
            $request->get('parent'),
            $request->get('q')));
    }

    public function ajaxContact()
    {
        return $this->contactRepository->all();
    }
}