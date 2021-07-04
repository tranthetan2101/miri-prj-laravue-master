<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
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
        
        $this->enableForeignKeys();
    }
}
