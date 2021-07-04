<?php

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
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
        Banner::create(
            [
                'name'  => 'forest.png'
            ]
        );

        Banner::create(
            [
                'name'  => 'forest1.png'
            ]
        );
        Banner::create(
            [
                'name'  => 'forest2.png'
            ]
        );
        $this->enableForeignKeys();
    }
}
