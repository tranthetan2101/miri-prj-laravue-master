<?php

use App\Models\Category;
use App\Models\ProductCategorie;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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

        Category::create(
            [
                'name' => 'duong da',
                'slug' => 'chuyen-muc-'.uniqid(),
                'image' => 'forest.png',
            ]
        );
        Category::create(
            [
                'name' => 'son moi',
                'slug' => 'chuyen-muc-'.uniqid(),
                'image' => 'forest1.png',
            ]
        );

        Category::create(
            [
                'name' => 'cate 1',
                'slug' => 'chuyen-muc-'.uniqid(),
                'image' => 'forest.png',
            ]
        );

        Category::create(
            [
                'name' => 'cate 2',
                'slug' => 'chuyen-muc-'.uniqid(),
                'image' => 'forest1.png',
            ]
        );

        $this->enableForeignKeys();
    }
}
