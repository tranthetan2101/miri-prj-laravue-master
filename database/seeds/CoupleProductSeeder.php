<?php

use App\Models\CoupleProduct;
use Illuminate\Database\Seeder;

class CoupleProductSeeder extends Seeder
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

        CoupleProduct::create(
            [
                'product1_id' => 1,
                'product2_id' => 2,
            ]
        );

        CoupleProduct::create(
            [
                'product1_id' => 6,
                'product2_id' => 7,
            ]
        );
        
        $this->enableForeignKeys();
    }
}
