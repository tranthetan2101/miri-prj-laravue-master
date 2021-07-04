<?php

use App\Models\CustomerDetail;
use Illuminate\Database\Seeder;

class CustomerDetailSeeder extends Seeder
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

        // Add example banner
        CustomerDetail::create(
            [
                'user_id'  => 2,
                'sex'   => 1,
                'phone_number' => '01234566789',
                'addr_number' => '139/D8',
                'addr_street' => 'duong D1',
                'city_id' => '1',
                'district_id' => '1',
                'ward_id' => '1'
            ]
        );
        $this->enableForeignKeys();
    }
}
