<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
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

        factory(App\Models\City::class, 6)->create()->each(
            function($city) {
                factory(App\Models\District::class)->create(['city_id' => $city->id])->each(
                    function($district) {
                        factory(App\Models\Ward::class)->create(['district_id' => $district->id]);
                    }
                );
            }
        );

        $this->enableForeignKeys();
    }
}
