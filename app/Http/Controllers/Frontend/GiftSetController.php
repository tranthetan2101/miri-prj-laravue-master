<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\ProductGiftSetRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class GiftSetController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * GiftSetController constructor
     * 
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * GiftSetController index
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->getGiftSetProduct();
        return view('frontend.gift-set.index', compact('products'));
    }
}
