<?php

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
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

        Cart::create([
            'user_id' => 2,
            'price' => 100000
        ]);

        CartDetail::create([
            'cart_id' => 1,
            'product_id' => 1,
            'quantity' => 2,
        ]);

        CartDetail::create([
            'cart_id' => 1,
            'product_id' => 2,
            'quantity' => 3,
        ]);

        $this->enableForeignKeys();
    }
}
