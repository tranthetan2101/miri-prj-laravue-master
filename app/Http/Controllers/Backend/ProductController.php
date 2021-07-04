<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Product\UpdateProductRequest;
use App\Http\Requests\Backend\Product\StoreProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class ProductController.
 */
class ProductController extends Controller
{
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
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Log::info('Url: '.config('filesystems.disks.public.url').' === Disk Root: '.config('filesystems.disks.public.root'));
        return view('backend.product.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.product.create')->withCategories($this->categoryRepository->all());
    }

    /**
     * @param StoreProductRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepository->create(
            $request->only(
                'name',
                'slug',
                'description',
                'description_2',
                'description_3',
                'active',
                'category_id',
                'sku',
                'stock',
                'stock_unlimited',
                'price',
                'favorite_flg',
                'capacity',
                'origin',
                'gift_set',
                'recommend',
                'bonus',
                'tag_best',
                'tag_recommend',
                'tag_sale',
                'discount_price',
                'images'
            )
        );

        return redirect()->route('admin.product.index')->withFlashSuccess(__('The product was successfully created.'));
    }

    /**
     * @param  Request  $request
     * @param  Product $product
     *
     * @return mixed
     */
    public function edit(Request $request, Product $product)
    {
        return view('backend.product.edit')
            ->withProduct($product)->withCategories($this->categoryRepository->all());
    }

    /**
     * @param  UpdateProductRequest  $request
     * @param  Product $product
     *
     * @return mixed
     * @throws \Throwable
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update(
            $product,
            $request->only(
                'name',
                'slug',
                'description',
                'description_2',
                'description_3',
                'active',
                'category_id',
                'sku',
                'stock',
                'stock_unlimited',
                'price',
                'favorite_flg',
                'capacity',
                'origin',
                'gift_set',
                'recommend',
                'bonus',
                'tag_best',
                'tag_recommend',
                'tag_sale',
                'discount_price',
                'images'
            )
        );

        return redirect()->route('admin.product.index')->withFlashSuccess(__('The product was successfully updated.'));

//        return redirect()->route('admin.product.show', $product)->withFlashSuccess(__('The product was successfully updated.'));
    }

    /**
     * @param  Request  $request
     * @param  Product $product
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function delete(Request $request, Product $product)
    {
        $this->productRepository->delete($product);

        return redirect()->route('admin.product.deleted')->withFlashSuccess(__('The product was successfully deleted.'));
    }

    /**
     * @param $deletedProductId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function destroy($deletedProductId)
    {
        abort_unless(config('boilerplate.access.user.permanently_delete'), 404);
        $deletedProduct= Product::withTrashed()->findOrFail($deletedProductId);
        $this->productRepository->destroy($deletedProduct);

        return redirect()->route('admin.product.deleted')->withFlashSuccess(__('The product was permanently deleted.'));
    }

    public function deleted()
    {
        return view('backend.product.deleted');
    }

    /**
     * @param $deletedProductId
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore($deletedProductId)
    {
        $deletedProduct= Product::withTrashed()->findOrFail($deletedProductId);
        $this->productRepository->restore($deletedProduct);

        return redirect()->route('admin.product.index')->withFlashSuccess(__('The product was successfully restored.'));
    }

    public function ajaxProducts(Request $request)
    {
        return response()->json($this->productRepository->getActivePaginated(10,
            'created_at',
            'desc',
            $request->get('q'),
            $request->get('category_id'),
            $request->get('type')));
    }
}
