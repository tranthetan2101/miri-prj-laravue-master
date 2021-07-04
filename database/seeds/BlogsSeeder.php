<?php

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
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

        Blog::create(
            [
                'data'  => '<div class="container" id="blog-detail">
                <div class="wrapper">
                    <h1>Nếu thực hiện chuẩn bước skincare này, da bạn sẽ trắng hồng lấp lánh và tươi trẻ thách thức thời gian</h1>
                    <div class="blog-inner">
                        <div class="hero-image">
                            <p><img src="/images/hero.png"></p>
                        </div>
                        <div class="blog-content">
                            <p>Tham khảo mọi bộ bí kíp chăm sóc da, bạn sẽ thấy bước tẩy tế bào chết luôn có một vị trí vững chắc, dù các tips có tăng giảm số lượng thế nào.
            Nếu không thực hiện bước tẩy da chết đều đặn, những tế bào già cỗi sẽ tích tụ trên bề mặt da, bịt kín lỗ chân lông khiến da xỉn màu, sần sùi, thậm chí là nổi mụn. Thêm nữa, khi bạn lớn tuổi hơn, khả năng tự tái tạo da sẽ suy giảm, đòi hỏi phải có sự trợ giúp của các sản phẩm tẩy da chết để da thêm khỏe mạnh và trẻ lâu. Tuy nhiên, thực hiện bước tẩy da chết sao cho hiệu quả, an toàn nhất cũng không phải việc “dễ như ăn kẹo”, bạn cần lưu ý những điều sau đây.</p>
                            <h2>NÊN TẨY DA CHẾT VỚI TẦN SUẤT NHƯ THẾ NÀO ?</h2>
                            <p>Đây là một thắc mắc muôn thuở đối với những ai mới tập tành skincare hay mới thêm tẩy da chết vào quy trình chăm da hằng ngày. Tất nhiên, mỗi làn da có nhu cầu tẩy tế bào chết không giống nhau nhưng tần suất thực hiện thao tác này chỉ nên du di trong khoảng từ 1 – 3 lần/tuần mà thôi. Nếu tẩy tế bào chết quá nhiều, hàng rào bảo vệ da của bạn sẽ bị tổn thương, khiến da thêm nhạy cảm, yếu ớt, hay trong một số trường hợp, da còn gặp phải tình trạng kích ứng, bỏng rát vô cùng khó chịu.</p>
                            <h3>H3</h3>
                            <h4>H4</h4>
                            <h5>H5</h5>
                            <p><img src="/images/blog-img.png"><span class="caption"></span></p>
                            <h2>TẨY DA CHẾT VÀO BUỔI SÁNG HAY TỐI LÀ HỢP LÝ ?</h2>
                            <p>Vẫn nên tẩy da chết vào buổi tối thì sẽ tốt hơn. Bởi lẽ, việc loại bỏ đi lớp tế bào già nua sẽ khiến làn da trở nên nhạy cảm hơn, đặc biệt là với ánh nắng mặt trời. Thêm một lưu ý nữa, là dù tẩy da chết vào thời điểm nào trong ngày, bạn nhất định phải bôi kem chống nắng để bảo vệ làn da của bạn, tránh viễn cảnh da vừa mịn màng, sáng căng nhờ tẩy tế bào chết thì ngay lập tức, bị tia UV tấn công mà trở nên xỉn màu, tổn thương nhiều hơn.</p>
                        </div>
                        <div class="earn-media">

                            <ul>
                                <li>Chia sẻ bài viết:</li>
                                <li><a href="#"><img src="/images/fb-share.svg"></a></li>
                                <li><a href="#"><img src="/images/yu-share.svg"></a></li>
                                <li><a href="#"><img src="/images/insta-share.svg"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>',
                'description'  => 'Để chăm sóc da và dưỡng da tay an toàn đúng cách, khi rửa tay bạn nên chú ý đến dung dịch rửa tay có chứa những thành phần gây hại hay chứa chất tẩy quá mạnh…..',
                'slug'  => 'blog-'.uniqid(),
                'name'  => 'NẾU THỰC HIỆN CHUẨN BƯỚC SKIN CARE. DA BẠN SẼ TRẮNG HỒNG LẤP LÁNH VÀ TƯƠI TRẺ THÁCH THỨC THỜI GIAN',
                'image'  => 'newest.png',
            ]
        );

        Blog::create(
            [
                'data'  => '<div class="container" id="blog-detail">
                <div class="wrapper">
                    <h1>Nếu thực hiện chuẩn bước skincare này, da bạn sẽ trắng hồng lấp lánh và tươi trẻ thách thức thời gian</h1>
                    <div class="blog-inner">
                        <div class="hero-image">
                            <p><img src="/images/hero.png"></p>
                        </div>
                        <div class="blog-content">
                            <p>Tham khảo mọi bộ bí kíp chăm sóc da, bạn sẽ thấy bước tẩy tế bào chết luôn có một vị trí vững chắc, dù các tips có tăng giảm số lượng thế nào.
            Nếu không thực hiện bước tẩy da chết đều đặn, những tế bào già cỗi sẽ tích tụ trên bề mặt da, bịt kín lỗ chân lông khiến da xỉn màu, sần sùi, thậm chí là nổi mụn. Thêm nữa, khi bạn lớn tuổi hơn, khả năng tự tái tạo da sẽ suy giảm, đòi hỏi phải có sự trợ giúp của các sản phẩm tẩy da chết để da thêm khỏe mạnh và trẻ lâu. Tuy nhiên, thực hiện bước tẩy da chết sao cho hiệu quả, an toàn nhất cũng không phải việc “dễ như ăn kẹo”, bạn cần lưu ý những điều sau đây.</p>
                            <h3>NÊN TẨY DA CHẾT VỚI TẦN SUẤT NHƯ THẾ NÀO ?</h3>
                            <p>Đây là một thắc mắc muôn thuở đối với những ai mới tập tành skincare hay mới thêm tẩy da chết vào quy trình chăm da hằng ngày. Tất nhiên, mỗi làn da có nhu cầu tẩy tế bào chết không giống nhau nhưng tần suất thực hiện thao tác này chỉ nên du di trong khoảng từ 1 – 3 lần/tuần mà thôi. Nếu tẩy tế bào chết quá nhiều, hàng rào bảo vệ da của bạn sẽ bị tổn thương, khiến da thêm nhạy cảm, yếu ớt, hay trong một số trường hợp, da còn gặp phải tình trạng kích ứng, bỏng rát vô cùng khó chịu.</p>
                            <h4>H4</h4>
                            <h5>H5</h5>
                            <p><img src="/images/blog-img.png"><span class="caption"></span></p>
                            <h3>TẨY DA CHẾT VÀO BUỔI SÁNG HAY TỐI LÀ HỢP LÝ ?</h3>
                            <p>Vẫn nên tẩy da chết vào buổi tối thì sẽ tốt hơn. Bởi lẽ, việc loại bỏ đi lớp tế bào già nua sẽ khiến làn da trở nên nhạy cảm hơn, đặc biệt là với ánh nắng mặt trời. Thêm một lưu ý nữa, là dù tẩy da chết vào thời điểm nào trong ngày, bạn nhất định phải bôi kem chống nắng để bảo vệ làn da của bạn, tránh viễn cảnh da vừa mịn màng, sáng căng nhờ tẩy tế bào chết thì ngay lập tức, bị tia UV tấn công mà trở nên xỉn màu, tổn thương nhiều hơn.</p>
                        </div>
                        <div class="earn-media">

                            <ul>
                                <li>Chia sẻ bài viết:</li>
                                <li><a href="#"><img src="/images/fb-share.svg"></a></li>
                                <li><a href="#"><img src="/images/yu-share.svg"></a></li>
                                <li><a href="#"><img src="/images/insta-share.svg"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--End blog-->
            </div>',
                'description'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s',
                'slug'  => 'blog-'.uniqid(),
                'name'  => 'SERUM COLLAGEN',
                'image'  => 'blog.png',
            ]
        );
        $this->enableForeignKeys();
    }
}
