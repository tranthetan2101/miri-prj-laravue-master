<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        Model::unguard();

        $this->truncateMultiple([
            'activity_log',
            'failed_jobs',
        ]);

        $this->call([
            AuthSeeder::class,
            AnnouncementSeeder::class,
            BannerSeeder::class,
            ProductSeeder::class,
            SaleSeeder::class,
            CategorySeeder::class,
            BlogsSeeder::class,
            CoupleProductSeeder::class,
            CustomerDetailSeeder::class,
            // CitySeeder::class,
            ContactSeeder::class,
            CartSeeder::class
        ]);
        
        Model::reguard();
    }
}
