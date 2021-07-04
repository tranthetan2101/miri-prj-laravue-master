<?php

use App\Models\Product;
use App\Models\ProductGiftSet;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Sale;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        Product::firstOrCreate(
            [
                'name' => 'product1',
                'stock_unlimited' => 1,
                'price' => 1000,
                'favorite_flg' => true,
                'description' => '<p> test description product 1 </p>',
                'description_2' => '<p> test description 2 product 1</p>',
                'description_3' => '<p> test description 3 product 1</p>',
                'sku' => 'ABC01234P1',
                'capacity' => '20ml',
                'origin' => 'viet nam',
                'category_id'=> 1,
                'tag_best' => 1,
                'tag_sale' => "sale 30%",
                'discount_price' => 700,
                'recommend' => [1,2,3],
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product2',
                'stock_unlimited' => 1,
                'price' => 1000,
                'favorite_flg' => true,
                'description' => '<p> test description product 2 </p>',
                'description_2' => '<p> test description 2 product 2</p>',
                'description_3' => '<p> test description 3 product 2</p>',
                'sku' => 'ABC01234P2',
                'capacity' => '30ml',
                'origin' => 'tq',
                'category_id'=> 2,
                'tag_recommend' => 1,
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product3',
                'stock_unlimited' => 1,
                'price' => 0,
                'favorite_flg' => false,
                'description' => '<p> test description product 3 </p>',
                'description_2' => '<p> test description 2 product 3</p>',
                'description_3' => '<p> test description 3 product 3</p>',
                'sku' => 'ABC01234P3',
                'capacity' => '30ml',
                'origin' => 'tq',
                'category_id'=> 2,
                'tag_best' => 1,
                'tag_sale' => "sale 40%",
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product gift set',
                'stock_unlimited' => 1,
                'price' => 350000,
                'favorite_flg' => false,
                'description' => '<p> test description product 3 </p>',
                'description_2' => '<p> test description 2 product 3</p>',
                'description_3' => '<p> test description 3 product 3</p>',
                'sku' => 'ABC01234P5',
                'capacity' => '30ml',
                'origin' => 'tq',
                'gift_set' => [1,2],
                'category_id'=> 1,
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product5',
                'stock_unlimited' => 1,
                'price' => 1000,
                'favorite_flg' => true,
                'description' => '<p> test description product 2 </p>',
                'description_2' => '<p> test description 2 product 2</p>',
                'description_3' => '<p> test description 3 product 2</p>',
                'sku' => 'ABC01234P2',
                'capacity' => '30ml',
                'origin' => 'tq',
                'category_id'=> 2,
                'tag_recommend' => 1,
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product7',
                'stock_unlimited' => 1,
                'price' => 1000,
                'favorite_flg' => true,
                'description' => '<p> test description product 2 </p>',
                'description_2' => '<p> test description 2 product 2</p>',
                'description_3' => '<p> test description 3 product 2</p>',
                'sku' => 'ABC01234P2',
                'capacity' => '30ml',
                'origin' => 'tq',
                'category_id'=> 2,
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product8',
                'stock_unlimited' => 1,
                'price' => 1000,
                'favorite_flg' => true,
                'description' => '<p> test description product 2 </p>',
                'description_2' => '<p> test description 2 product 2</p>',
                'description_3' => '<p> test description 3 product 2</p>',
                'sku' => 'ABC01234P2',
                'capacity' => '30ml',
                'origin' => 'tq',
                'category_id'=> 2,
                'discount_price' => 700,
            ]
        );

        Product::firstOrCreate(
            [
                'name' => 'product gift set 2',
                'stock_unlimited' => 1,
                'price' => 350000,
                'favorite_flg' => false,
                'description' => '<p> test description product 3 </p>',
                'description_2' => '<p> test description 2 product 3</p>',
                'description_3' => '<p> test description 3 product 3</p>',
                'sku' => 'ABC01234P5',
                'capacity' => '30ml',
                'origin' => 'tq',
                'gift_set' => [1,2,3],
                'category_id'=> 1,
                'discount_price' => 700,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 1,
                'file_name' => 'couple.png',
                'sort_no'   => 1,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 1,
                'file_name' => 'couple-1.png',
                'sort_no'   => 2,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 2,
                'file_name' => 'couple-1.png',
                'sort_no'   => 1,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 3,
                'file_name' => 'couple-1.png',
                'sort_no'   => 1,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 5,
                'file_name' => 'couple.png',
                'sort_no'   => 1,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 6,
                'file_name' => 'couple.png',
                'sort_no'   => 1,
            ]
        );

        ProductImage::firstOrCreate(
            [
                'product_id' => 7,
                'file_name' => 'couple.png',
                'sort_no'   => 1,
            ]
        );

        $this->enableForeignKeys();
    }
}
