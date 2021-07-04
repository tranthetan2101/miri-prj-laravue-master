@extends('frontend.default')

@section('keywords', 'MIRI, Blog')
@section('page_title', 'Về MIRI')
@section('description', 'Những bài blog về MIRI')
@section('og:title', 'Về MIRI')
@section('og:description', 'Những bài blog về MIRI')

@section('content')
<div class="container">
    <div class="story">
        <p class="break-title">VỀ MIRI</p>
        <h1>Câu chuyện thương hiệu</h1>
        <a href="/story-miri">
            <div class="main-story-img">
                <p><img src="{{ asset('images/main-story.png') }}"></p>
            </div>
        </a>
        <a href="/story-miri">
            <div class="story-1">
                <div class="story-1-img">
                    <p><img src="{{ asset('images/story-1.png') }}"></p>
                </div>
                <div class="story-1-content">
                    <p>- Từ niềm đam mê bất tận và tình yêu mãnh liệt với cái đẹp, MIRI thật sự tin rằng điều đó có thể tìm được ở mọi nơi và sâu sắc hơn so với những gì chúng ta dễ dàng nhìn thấy, là xúc cảm được sẻ chia, là sự đa dạng và thống nhất.</p>
                    <p>
                        - Khi trở nên xinh đẹp và tự tin, chúng ta được truyền cảm hứng để tạo ra những giá trị tích cực cho cuộc sống của tất cả mọi người, MIRI đã và đang nỗ lực phấn đấu ko ngừng để mang đến những giá trị khác biệt, khơi sáng nét đẹp tiềm ẩn bên trong bạn, từ đó chuyển hoá thành sức mạnh tinh thần giúp bạn đi đến thành công và hạnh phúc đích thực. </p>
                </div>
            </div>
        </a>
        <a href="/process-miri">
            <div class="story-2">
                <div class="story-2-content">
                    <p>- Chúng tôi phối hợp những nét độc đáo của kết cấu sản phẩm, màu sắc và hương thơm cùng với giá trị mỹ học rất riêng của MIRI từ những nguyên liệu thiên nhiên quý giá trên thế giới, áp dụng kết quả thành tựu nghiên cứu với đội ngũ chuyên gia nhiều năm kinh nghiệm, kết hợp công nghệ hiện đại bậc nhất ,quy trình sản xuất tiên tiến, khép kín để tạo ra những siêu phẩm đột phá từ khoa học phương Tây và trí óc phương Đông.
                    </p>
                    <p>- Từ đó chúng tôi hãnh diện trao đến bạn một quyền năng cho làn da, để làm sống dậy vẻ đẹp bên ngoài lẫn vẻ đẹp nội lực tiềm ẩn bên trong.</p>
                    <p>- MIRI mong rằng sẽ trở thành tri kỉ của bạn, là một thứ vũ khí tối thượng để tiếp cho bạn nguồn năng lượng vô tận, đồng hành cùng bạn viết lên những trang sử và khoảnh khắc đáng nhớ nhất trong cuộc đời mình!</p>
                </div>
                <div class="story-2-img">
                    <p><img src="{{ asset('images/message-img.png') }}"></p>
                </div>
            </div>
        </a>
    </div>
    <!--End MIRI-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $("#menu_about").addClass('active');
</script>

@endpush