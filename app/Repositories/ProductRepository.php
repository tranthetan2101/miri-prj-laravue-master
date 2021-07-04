<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductRating;
use App\Repositories\BaseRepository;
use Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    use \App\Models\Traits\ProductTrait;
    /**
     * ProductRepository constructor.
     *
     * @param  Product  $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    /**
     * Get list FavoriteProduct
     *
     * @return FavoriteProduct
     */
    public function getFavoriteProduct()
    {
        return $this->formatListProduct(
                    $this->model
                        ->whereNull('gift_set')
                        ->with('sale', 'category', 'images')
                        ->where('favorite_flg', '=', 1)
                        ->get()
                );
    }

    // public function getProductByCateId($id)
    // {
    //     $data = empty($id) ?
    //         $this->model->whereNull('gift_set')->with('sale', 'category')->get() :
    //         $this->model->whereNull('gift_set')->with('sale', 'category')->where('category_id', '=', $id)->get();

    //     foreach ($data as $key => $product) {
    //         if ($product->sale->count()) {
    //             $data[$key] = $this->getPrice($product);
    //         }
    //     }
    //     return $data;
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

    public function formatProductByJoin($product)
    {
        $product->discount_price = $product->price - ($product->price * $product->sale_amount) / 100; // giá giảm

        return $product;
    }

    /**
     * Get list gift set product
     *
     * @return model
     */
    public function getGiftSetProduct()
    {
        return $this->formatListProduct(
                    $this->model
                        ->whereNotNull('gift_set')
                        ->with('images')
                        ->get()
                );
    }

    /**
     * Get List Sale Product
     *
     * @return model
     */
    public function getListProductSale()
    {
        return $this->formatListProduct(
                    $this->model
                        ->whereNull('gift_set')
                        ->has('sale')
                        ->get()
                );
    }

    /**
     * Get List newestSale Product
     *
     * @return model
     */
    public function getNewestSale()
    {
        $listProduct = $this->model
            ->select(['products.*', 'sale_items.product_id','sales.period_end','sales.name', 'sales.sale_amount'])
            ->addSelect('products.name as product_name')
            ->whereNull('gift_set')
            ->has('sale')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->orderBy('sales.created_at', 'desc')->get();

        $products = [];
        foreach ($listProduct as $key => $product) {
            if (!in_array($product->product_id, $products)) {
                $listProduct[$key] = $this->formatProductByJoin($product);
                $products[] = $product->product_id;
            } else {
                unset($listProduct[$key]);
            }
        }

        return $listProduct;
    }

    /**
     * Sort array Product by Data
     *
     * @param Product $listProduct
     * @param Request $data
     *
     * @return Product $listProduct
     */
    public function sortProduct($id, $data)
    {
        $listProduct = empty($id) ?
            $this->model->whereNull('gift_set')->with('sale', 'category') :
            $this->model->whereNull('gift_set')->with('sale', 'category')->where('category_id', '=', $id);

        // Sort by select
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 1: // best Seller
                    $listProduct = $listProduct->orderByRaw('-tag_best ASC')->orderByRaw('-tag_recommend ASC');
                    break;
                case 3: // moi nhat
                    $listProduct = $listProduct->orderBy('created_at');
                    break;
                case 4: //
                    $listProduct = $listProduct->orderByRaw('-tag_recommend ASC')->orderByRaw('-tag_best ASC');
                    break;
                case 5: // theo gia
                    $listProduct = $listProduct->orderBy('price');
                    break;
                default:
                    break;
            }
        }

        $listProduct = $this->formatListProduct($listProduct->get());
        // Sort by khuyen mai moi nhat
        if (isset($data['sort']) && $data['sort'] == 2) {
            $listProduct = $listProduct->sortBy('sale.sale_amount');
        }

        // Sort by price ranger slide
        if (isset($data['start'])) {
            $listProduct = $listProduct
                ->Where('price', '>', $data['start'])
                ->where('price', '<', $data['end']);
        }

        return $listProduct;
    }

    /**
     * Sort sale product
     *
     * @param Request $data
     *
     * @return Product $listProduct
     */
    public function sortProductPromotion($data)
    {
        $listProduct = $this->model->whereNull('gift_set')->has('sale');

        // Sort by Category
        if (isset($data['listCate'])) {
            $categoryId = explode(',', $data['listCate']);
            $listProduct = $listProduct
                ->with('category')
                ->whereIn('category_id', $categoryId);
        }

        // Sort by price ranger slide
        if (isset($data['start'])) {
            $listProduct = $listProduct
                ->where('price', '>', $data['start'])
                ->where('price', '<', $data['end']);
        }

        $listProduct = $this->formatListProduct($listProduct->get()->load('sale'));

        // Sort by select
        if (isset($data['sort'])) {
            switch ($data['sort']) {
                case 1: // khuyen mai sap hen han
                    $listProduct = $listProduct->sortBy(function ($item) {
                        $sort = isset($item->sale[0]->period_end) ? $item->sale[0]->period_end : null;
                        return $sort;
                    });
                    break;
                case 2: // Khuyến mãi 30%
                    foreach ($listProduct as $key => $product) {
                        if ($product->sale->first()->sale_amount < 30) {
                            unset($listProduct[$key]);
                        }
                    }
                    break;
                case 3: // Khuyến mãi 50%
                    foreach ($listProduct as $key => $product) {
                        if ($product->sale->first()->sale_amount < 50) {
                            unset($listProduct[$key]);
                        }
                    }
                    break;
                case 4: // Khuyến mãi 70%
                    foreach ($listProduct as $key => $product) {
                        if ($product->sale->first()->sale_amount < 70) {
                            unset($listProduct[$key]);
                        }
                    }
                    break;
                case 5: // Sắp xếp theo giá từ cao-thấp
                    $listProduct = $listProduct->sortByDesc('discount_price');
                    break;
                case 6: // Sắp xếp theo giá từ cao-thấp
                    $listProduct = $listProduct->sortBy('discount_price');
                    break;
                default:
                    break;
            }
        }

        return $listProduct;
    }

    public function search($searchTerm)
    {
        return $this->formatListProduct(
                    $this->model
                        ->whereNull('gift_set')
                        ->with('sale')
                        ->where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->get()
                );
    }

    public function searchGiftSet($searchTerm)
    {
        return $this->formatListProduct(
                    $this->model
                        ->whereNotNull('gift_set')
                        ->with('sale')
                        ->where('name', 'LIKE', '%' . $searchTerm . '%')
                        ->get()
                );
    }

    public function getProductRecommend($cart)
    {
        $products = [];
        $ids = [];
        foreach($cart->detail as $item)
        {
            if (!empty($item->product->recommend)) {
                foreach ($item->product->productRecommend as $product) {
                    if (!in_array($product->id, $ids)) {
                        $products[] = $product;
                        array_push($ids, $product->id);
                    }
                }
            }
        }

        return $products;
    }

    public function getActivePaginated($paged, $orderBy = 'id', $orderDir = 'desc', $keyword = NULL, $category_id = NULL, $type = NULL)
    {
        $query = $this->model->active()->with('sale');
        if ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        // if ($type == 'gift_set')
        // {
        //     $query->whereNotNull('gift_set');
        // } else {
        //     $query->whereNull('gift_set');
        // }
        return $query->orderBy($orderBy, $orderDir)->paginate($paged);
    }

    public function create(array $data): Product
    {
        return DB::transaction(
            function () use ($data) {
                $product = $this->model::create(
                    [
                        'name' => $data['name'],
                        'slug'=> $data['slug'],
                        'description' => $data['description'],
                        'description_2' => $data['description_2'],
                        'description_3' => $data['description_3'],
                        'active' => isset($data['active']) && $data['active'] == 1,
                        'category_id' => $data['category_id'],
                        'sku' => $data['sku'],
                        'stock' => $data['stock'],
                        'stock_unlimited' => isset($data['stock_unlimited']) && $data['stock_unlimited'] == 1,
                        'price' => str_replace('.', '', $data['price']),
                        'favorite_flg' => isset($data['favorite_flg']) && $data['favorite_flg'] == 1,
                        'capacity' => $data['capacity'],
                        'origin' => $data['origin'],
                        'gift_set' => isset($data['gift_set']) ? $data['gift_set'] : NULL,
                        'recommend' => isset($data['recommend']) ? $data['recommend'] : NULL,
                        'bonus' => isset($data['bonus']) ? $data['bonus'] : NULL,
                        'tag_best' => isset($data['tag_best']) && $data['tag_best'] == 1,
                        'tag_recommend' => isset($data['tag_recommend']) && $data['tag_recommend'] == 1,
                        'tag_sale' => $data['tag_sale'],
                        'discount_price' => str_replace('.', '', $data['discount_price'])
                    ]
                );
                // save images
                $images = [];
                foreach (explode(',',$data['images']) as $idx => $image) {
                    $images[] = new ProductImage(['product_id' => $product->id, 'file_name' => $image, 'sort_no' => $idx]);
                }
                $product->images()->saveMany($images);
                return $product;
            }
        );
    }

    public function update(Product $product, array $data)
    {
        return DB::transaction(
            function () use ($product, $data) {
                if ($product->update(
                    [
                        'name' => $data['name'],
                        'slug' => $data['slug'],
                        'description' => $data['description'],
                        'description_2' => $data['description_2'],
                        'description_3' => $data['description_3'],
                        'active' => isset($data['active']) && $data['active'] == 1,
                        'category_id' => $data['category_id'],
                        'sku' => $data['sku'],
                        'stock' => $data['stock'],
                        'stock_unlimited' => isset($data['stock_unlimited']) && $data['stock_unlimited'] == 1,
                        'price' => str_replace('.', '', $data['price']),
                        'favorite_flg' => isset($data['favorite_flg']) && $data['favorite_flg'] == 1,
                        'capacity' => $data['capacity'],
                        'origin' => $data['origin'],
                        'gift_set' => isset($data['gift_set']) ? $data['gift_set'] : NULL,
                        'recommend' => isset($data['recommend']) ? $data['recommend'] : NULL,
                        'bonus' => isset($data['bonus']) ? $data['bonus'] : NULL,
                        'tag_best' => isset($data['tag_best']) && $data['tag_best'] == 1,
                        'tag_recommend' => isset($data['tag_recommend']) && $data['tag_recommend'] == 1,
                        'tag_sale' => $data['tag_sale'],
                        'discount_price' => str_replace('.', '', $data['discount_price'])
                    ]
                )) {
                    // save images
                    $images = [];
                    foreach (explode(',', $data['images']) as $idx => $image) {
                        $images[] = new ProductImage(['product_id' => $product->id, 'file_name' => $image, 'sort_no' => $idx]);
                    }
                    $product->images()->delete();
                    $product->images()->saveMany($images);
                    return $product;
                }

                throw new GeneralException(__('Update Product Error'));
            }
        );
    }

    /**
     * @param Product $product
     * @return Product
     * @throws GeneralException
     */
    public function delete(Product $product): Product
    {
        if ($this->deleteById($product->id)) {
            return $product;
        }

        throw new GeneralException('There was a problem deleting this product. Please try again.');
    }

    /**
     * @param Product $product
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Product $product): bool
    {
        if ($product->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this product. Please try again.'));
    }

    /**
     * @param  Product $product
     *
     * @throws GeneralException
     * @return  Product
     */
    public function restore( Product $product):  Product
    {
        if ($product->restore()) {
            return $product;
        }

        throw new GeneralException(__('There was a problem restoring this product. Please try again.'));
    }

    public function updateStock($order)
    {
        if (empty($order)) {
            return false;
        }

        foreach ($order->detail as $item) {
            $product = $this->getById($item->product_id);

            if ($product->stock_unlimited != 1) {
                $product->stock = $item->quantity < $product->stock ? $product->stock - $item->quantity : 0;
            }

            if (!$product->save()) {
                throw new GeneralException(__('There was a problem restoring this product. Please try again.'));
            }
        }
    }

    public function revertStock($order)
    {
        foreach ($order->detail as $item) {
            $product = $this->getById($item->product_id);

            if ($product->stock_unlimited != 1) {
                $product->stock += $item->quantity;
            }

            if (!$product->save()) {
                throw new GeneralException(__('There was a problem restoring this product. Please try again.'));
            }
        }
    }

    public function updateRating($param)
    {
        $product = $this->getById($param['product_id']);

        $productRating[] = new ProductRating(['product_id' => $param['product_id'], 'user_id' => Auth::user()->id, 'rating' => $param['rating']]);

        if ($product->productRating()->saveMany($productRating)) {
            throw new GeneralException(__('There was a problem restoring this product. Please try again.'));
        }
    }
}
