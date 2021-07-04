<?php

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
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
        News::create([
            'name' => 'bi quyet duong da tay',
            'data' => 'Từ niềm đam mê bất tận và tình yêu mãnh liệt với cái đẹp, MIRI thật sự tin rằng điều đó có thể tìm được ở mọi nơi và sâu sắc hơn so với những gì chúng ta dễ dàng nhìn thấy, là xúc cảm được sẻ chia, là sự đa  dạng và thống nhất. Khi trở nên xinh đẹp và tự tin, chúng ta được truyền cảm hứng để tạo ra những giá trị tích cực cho cuộc sống của tất cả mọi người, MIRI đã và đang nỗ lực phấn đấu ko ngừng để mang đến những giá trị khác biệt, khơi sáng nét đẹp tiềm ẩn bên trong bạn, từ đó chuyển hoá thành sức mạnh tinh thần giúp bạn đi đến thành công và hạnh phúc đích thực. ',
            'description' => '<p>Để chăm sóc da và dưỡng da tay an toàn đúng cách, khi rửa tay bạn nên chú ý đến dung dịch rửa tay có chứa những thành phần gây hại hay chứa chất tẩy quá mạnh…..</p>',
            'title' => 'goc chia se',
            'slug' => 'bi quyet duong da tay',
            'type' => 1,
            'image' => 'forest.png',
        ]);

        News::create([
            'name' => 'MIRI cam kết bảo hiểm trách nhiệm sản phẩm cho Khách hàng',
            'data' => 'Từ niềm đam mê bất tận và tình yêu mãnh liệt với cái đẹp, MIRI thật sự tin rằng điều đó có thể tìm được ở mọi nơi và sâu sắc hơn so với những gì chúng ta dễ dàng nhìn thấy, là xúc cảm được sẻ chia, là sự đa  dạng và thống nhất. Khi trở nên xinh đẹp và tự tin, chúng ta được truyền cảm hứng để tạo ra những giá trị tích cực cho cuộc sống của tất cả mọi người, MIRI đã và đang nỗ lực phấn đấu ko ngừng để mang đến những giá trị khác biệt, khơi sáng nét đẹp tiềm ẩn bên trong bạn, từ đó chuyển hoá thành sức mạnh tinh thần giúp bạn đi đến thành công và hạnh phúc đích thực. ',
            'description' => '<p>Để chăm sóc da và dưỡng da tay an toàn đúng cách, khi rửa tay bạn nên chú ý đến dung dịch rửa tay có chứa những thành phần gây hại hay chứa chất tẩy quá mạnh…..</p>',
            'title' => 'goc chia se',
            'slug' => 'bi quyet duong da tay',
            'type' => 1,
            'image' => 'forest1.png',
        ]);

        News::create([
            'name' => 'Cau chuyen thuong hieu',
            'data' => 'Từ niềm đam mê bất tận và tình yêu mãnh liệt với cái đẹp, MIRI thật sự tin rằng điều đó có thể tìm được ở mọi nơi và sâu sắc hơn so với những gì chúng ta dễ dàng nhìn thấy, là xúc cảm được sẻ chia, là sự đa  dạng và thống nhất. Khi trở nên xinh đẹp và tự tin, chúng ta được truyền cảm hứng để tạo ra những giá trị tích cực cho cuộc sống của tất cả mọi người, MIRI đã và đang nỗ lực phấn đấu ko ngừng để mang đến những giá trị khác biệt, khơi sáng nét đẹp tiềm ẩn bên trong bạn, từ đó chuyển hoá thành sức mạnh tinh thần giúp bạn đi đến thành công và hạnh phúc đích thực. ',
            'description' => '<p>Để chăm sóc da và dưỡng da tay an toàn đúng cách, khi rửa tay bạn nên chú ý đến dung dịch rửa tay có chứa những thành phần gây hại hay chứa chất tẩy quá mạnh…..</p>',
            'title' => 'goc chia se',
            'slug' => 'bi quyet duong da tay',
            'type' => 2,
            'image' => 'forest1.png',
        ]);

        $this->enableForeignKeys();
    }
}
