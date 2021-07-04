@if ($blogs->count() > 0)
<div>
    <ul class="list-of-blog">
        @foreach($blogs as $blog)
        <li><a href="#">
                <img src="{{ $blog->picture }}" />
                <h3>{{$blog->name}}</h3>
                <p>{{$blog->description}}</p>
                <button>Đọc tiếp</button>
            </a></li>
        <li>
        @endforeach
    </ul>
</div>
@else
<p class="alert">Không tìm thấy kết quả nào.</p>
@endif