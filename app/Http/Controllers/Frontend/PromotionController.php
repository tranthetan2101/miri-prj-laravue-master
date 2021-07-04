<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SaleRepository;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * @var SaleRepository
     */
    protected $saleRepository;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * PromotionController constructor
     *
     * @param SaleRepository $saleRepository
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(SaleRepository $saleRepository, ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * PromotionController index
     *
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $request->flash();
        $listProduct = $this->productRepository->getListProductSale();
        $newestSales = $this->productRepository->getNewestSale();
        $categories = $this->categoryRepository->getListCategory();
        return view('frontend.promotion.index', compact('newestSales', 'listProduct', 'categories'));
    }

    /**
     * PromotionController ajax sort Product
     *
     * @param Request $request
     * @return view
     */
    public function reloadProduct(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $listProduct = $this->productRepository->sortProductPromotion($data);

            return view('frontend.promotion.product', compact('listProduct'))->render();
        }

        return redirect()->back();
    }
}
