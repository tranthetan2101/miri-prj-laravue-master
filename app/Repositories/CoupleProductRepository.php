<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\CoupleProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Class CoupleProductRepository.
 */
class CoupleProductRepository extends BaseRepository
{
    use \App\Models\Traits\ProductTrait;
    /**
     * CoupleProductRepository constructor.
     *
     * @param  CoupleProduct  $model
     */
    public function __construct(CoupleProduct $model)
    {
        $this->model = $model;
    }

    /**
     * Get list CoupleProduct
     *
     * @return CoupleProduct
     */
    public function getlistCoupleProduct()
    {
        $data = $this->with('product1.images','product1.sale','product1.category','product2.images','product2.sale','product2.category')->all();
        foreach ($data as $key => $product) {
            $data[$key]['product1'] = $this->formatProduct($product->product1);
            $data[$key]['product2'] = $this->formatProduct($product->product2);
        }
        return $data;
    }

    /**
     * Format price product
     *
     * @return CoupleProduct
     */
    public function formatProduct($product)
    {
        $product['price2'] = $product['price']; // giá ban đầu
        if (!empty($product->sale->first()))
        {
            $product['price'] = $product['price'] - ($product['price'] * $product->sale->first()->sale_amount) / 100; // giá giảm
        }

        return $product;
    }

    /**
     * @param array $data
     *
     * @return CoupleProduct
     * @throws \Throwable
     * @throws \Exception
     */
    public function create(array $data): CoupleProduct
    {
        $product1_image = request()->has('product1_image') ? request()->file('product1_image') : false;
        $product2_image = request()->has('product2_image') ? request()->file('product2_image') : false;
        return DB::transaction(
            function () use ($data, $product1_image, $product2_image) {
                $picture1 = null;
                if ($product1_image) {
                    $picture1 = Storage::put('couple', $product1_image);
                }
                $picture2 = null;
                if ($product2_image) {
                    $picture2 = Storage::put('couple', $product2_image);
                }
                $couple_product = $this->model::create(
                    [
                        'product1_id' => $data['product1_id'],
                        'product1_image' => $picture1,
                        'product2_id' => $data['product2_id'],
                        'product2_image' => $picture2
                    ]
                );

                if ($couple_product) {
                    return $couple_product;
                }

                throw new GeneralException(__('exceptions.backend.couple_product.create_error'));
            }
        );
    }

    public function update(CoupleProduct $couple_product, array $data)
    {
        $product1_image = request()->has('product1_image') ? request()->file('product1_image') : false;
        $product2_image = request()->has('product2_image') ? request()->file('product2_image') : false;
        return DB::transaction(
            function () use ($couple_product, $data, $product1_image, $product2_image) {
                $picture1 = $couple_product->product1_image;
                if ($product1_image) {
                    $picture1 = Storage::put('couple', $product1_image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($couple_product->product1_image);
                }
                $picture2 = $couple_product->product2_image;;
                if ($product2_image) {
                    $picture2 = Storage::put('couple', $product2_image);
                    // remove old avatar if there is new avatar uploaded
                    Storage::delete($couple_product->product2_image);
                }
                if ($couple_product->update(
                    [
                        'product1_id' => $data['product1_id'],
                        'product1_image' => $picture1,
                        'product2_id' => $data['product2_id'],
                        'product2_image' => $picture2
                    ]
                )) {
                    return $couple_product;
                }

                throw new GeneralException(__('Update CoupleProduct Error'));
            }
        );
    }

    /**
     * @param CoupleProduct $couple_product
     * @return bool
     * @throws GeneralException
     */
    public function destroy(CoupleProduct $couple_product): bool
    {
        if ($couple_product->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this couple_product. Please try again.'));
    }
}
