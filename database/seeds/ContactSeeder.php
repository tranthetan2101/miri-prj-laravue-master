<?php

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
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
        Contact::create(
            [
                'address'  => '110 - 112 Kinh Dương Vương, Phường 13, Quận 6, Tp. Hồ Chí Minh',
                'email'  => 'info@miri.com.vn',
                'phone_number'  => '(028) 38 7777 66',
                'link'  => 'www.miri.com.vn',
                'image'  => 'map.png',
                'open_time'  => date('Y-m-d h:i:s'),
                'close_time'  => date('Y-m-d h:i:s'),
            ]
        );

        Contact::create(
            [
                'address'  => '139/D8, Lý Chính Thắng Phường 13, Quận 6, Tp. Hồ Chí Minh',
                'email'  => 'info@miri.com.vn',
                'phone_number'  => '(028) 12 1234 888',
                'link'  => 'www.miri.com.vn',
                'image'  => 'map.png',
                'open_time'  => date('Y-m-d h:i:s'),
                'close_time'  => date('Y-m-d h:i:s'),
            ]
        );

        $this->enableForeignKeys();
    }
}
