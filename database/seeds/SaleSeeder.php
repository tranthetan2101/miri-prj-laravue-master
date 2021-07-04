<?php

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
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

        Sale::create(
            [
                'name' => 'sale 20%',
                'slug' => 'sale 20%',
                'period_end' => date('Y-m-d h:i:s'),
                'sale_amount' => 20,
            ]
        );
        Sale::create(
            [
                'name' => 'sale 10%',
                'slug' => 'sale 10%',
                'period_end' => date('Y-m-d h:i:s'),
                'sale_amount' => 10,
            ]
        );

        SaleItem::create([
            'product_id' => 2,
            'sale_id'   => 2
        ]);

        SaleItem::create([
            'product_id' => 1,
            'sale_id'   => 1
        ]);

        $this->enableForeignKeys();
    }
}
