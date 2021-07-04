<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ComboRepository;
use App\Repositories\ProductRepository;
use Cart;
use Cookie;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
    use \App\Models\Traits\ProductTrait;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * ProductController constructor.
     *
     * @param  ProductRepository  $productRepository
     * @param  CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository, ComboRepository $comboRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->comboRepository = $comboRepository;
    }

    /**
     * ProductController index
     *
     * @param Request $request
     * @param $id Product Id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $id)
    {
        $product = $this->formatProduct($this->productRepository->getById($id));

        // Don't have page product gift set detail
        if (!empty($product->gift_set) > 0) {
            return abort(404);
        }

        // Get data from cookies
        $arrayCookie = unserialize(Cookie::get('lastSeen'));
        $lastSeen = [];
        if (!empty($arrayCookie)) {
            $lastSeen = $this->formatListProduct($this->productRepository->getById($arrayCookie));
        }

        // Get combo
        $combo = $this->comboRepository->getByCateId($product->category_id);

        // Update data cookies
        $cookies = $this->updateCookies($product, $arrayCookie);
        Cookie::queue(Cookie::make('lastSeen', serialize($cookies),  60 * 60 * 24 * 7));

        return view('frontend.product.index', compact('product', 'lastSeen', 'combo'));
    }

    /**
     * ProductController index
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, string $slug)
    {
        $product = $this->formatProduct($this->productRepository->getByColumn($slug, 'slug'));

        // Don't have page product gift set detail
        if (!empty($product->gift_set) > 0) {
            return abort(404);
        }

        // Get data from cookies
        $arrayCookie = unserialize(Cookie::get('lastSeen'));
        $lastSeen = [];
        if (!empty($arrayCookie)) {
            $lastSeen = $this->formatListProduct($this->productRepository->getById($arrayCookie));
        }

        // Update data cookies
        $cookies = $this->updateCookies($product, $arrayCookie);
        Cookie::queue(Cookie::make('lastSeen', serialize($cookies),  60 * 60 * 24 * 7));

        return view('frontend.product.index', compact('product', 'lastSeen'));
    }

    /**
     * Update cookies
     *
     * @param $product
     * @param $lastSeenProduct
     * @return cookie
     */
    public function updateCookies($product, $arrayCookieProduct)
    {
        if (empty($arrayCookieProduct)) {
            $arrayCookieProduct = [];
        }
        if (!in_array($product->id, $arrayCookieProduct))
        {
            array_push($arrayCookieProduct, $product->id);
        }

        return $arrayCookieProduct;
    }

    /**
     * ProductController list
     *
     * @param Request $request
     * @param $id Category Id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function list(Request $request, $id = null)
    {
        $request->flash();
        $data = $request->all();

        $products = $this->productRepository->sortProduct($id, $data);
        $categories = $this->categoryRepository->getListCategory();
        $combo = $this->comboRepository->getByCateId($id);
        $position = Agent::isMobile() ? 3 : 5;

        return view('frontend.product.list', compact('products', 'categories', 'id', 'position', 'combo'));
    }

    /**
     * ProductController category
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Request $request, $slug = null)
    {
        $request->flash();
        $category = $this->categoryRepository->getByColumn($slug, 'slug', ['id','name']);
        $id = !empty($category) ? $category->id : 0;
        $data = $request->all();
        $products = $this->productRepository->sortProduct($id, $data);
        $categories = $this->categoryRepository->getListCategory();

        return view('frontend.product.list', compact('products', 'categories', 'id', 'slug'));
    }

    /**
     * ProductController sortProduct ajax
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sortProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $products = $this->productRepository->sortProduct($data['id'], $data);
            return view('frontend.product.products', compact('products'))->render();
        }

        return redirect()->back();
    }

    public function rating(Request $request)
    {
        $this->productRepository->updateRating($request->all());
        
        return redirect()->back();
    }
}
