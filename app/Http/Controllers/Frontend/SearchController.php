<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\BlogRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var BlogRepository
     */
    protected $blogRepository;

    /**
     * SearchController constructor
     * 
     * @param ProductRepository $productRepository
     * @param BlogRepository $blogRepository
     */
    public function __construct(ProductRepository $productRepository, BlogRepository $blogRepository)
    {
        $this->productRepository = $productRepository;
        $this->blogRepository = $blogRepository;
    }

    /**
     * SearchController index
     * 
     * @param Request $request
     * 
     * @return view
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $searchTerm = $data['search-terms'];
        $products = $this->productRepository->search($searchTerm);
        $giftSet = $this->productRepository->searchGiftSet($searchTerm);
        $blogs = $this->blogRepository->search($searchTerm);

        return view('frontend.search.index', compact('products', 'giftSet', 'blogs', 'searchTerm'));
    }
}
