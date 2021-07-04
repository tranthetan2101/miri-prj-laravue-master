@extends('frontend.default')

@section('keywords', "MIRI")
@section('page_title', "Danh sách sản phẩm")
@section('description', 'Danh sách sản phẩm')
@section('og:image', ($products->count()) ? $products->first()->images->first()['picture'] : '')
@section('og:title', 'Danh sách sản phẩm')
@section('og:description', 'Danh sách sản phẩm')

@section('content')
<div class="container">
    <div class="products wrapper">
        @if ($id)
        @foreach ($categories as $category)
        @if ($category->id == $id)
        <h2 style="text-transform: uppercase;">{{$category->name}}</h2>
        @endif
        @endforeach
        @else
        <h2>Tất cả sản phẩm</h2>
        @endif
        <div class="sort-and-arrange"><a href="#filter-modal" rel="modal:open">LỌC VÀ SẮP XẾP</a></div>
        <div class="filter" id="filter-modal">
            <div class="categories">
                <h3>Danh mục sản phẩm</h3>
                <ul id="my-accordion" class="accordionjs">
                    @foreach ($categories as $category)
                    <li @if ($category->id == $id) class="active" @endif>
                        <div><a href="/product/list/{{$category->id}}" class="{{$category->id}}"><img width="15" height="15" src="{{ $category->icon }}">{{$category->name}}</a></div>
                        <div>
                            <ul>
                                @foreach ($category->product as $product)
                                <li><a href="/product/detail/{{$product->id}}">{{$product->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <form method="get" id="listForm">
                <input type="hidden" name="sort" value="{{ old('sort') }}">
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="sort-mobile">
                    <h3>Sắp xếp theo</h3>
                    <ul>
                        <li><button type="submit" value="0">Thứ tự mặc định</button></li>
                        <li><button type="submit" value="1">Sản phẩm best-seller</button></li>
                        <li><button type="submit" value="2">Sản phẩm khuyến mãi</button></li>
                        <li><button type="submit" value="3">Sản phẩm mới nhất</button></li>
                        <li><button type="submit" value="4">Sản phẩm đề xuất</button></li>
                        <li><button type="submit" value="5">Sản phẩm theo giá</button></li>
                    </ul>
                </div>
                <div class="price_range">
                    <h3>Lọc theo giá</h3>

                    <section class="range-slider" id="facet-price-range-slider">
                        <input name="range-1" value="{{old('range-1') ?? 0}}" min="0" max="999000" step="1" type="range">
                        <input name="range-2" value="{{old('range-2') ?? 999000}}" min="0" max="999001" step="1" type="range">
                    </section>
                </div>
            </form>

        </div>
        <div class="list">
            <div class="sort">
                <div class="sort-inner">
                    <span>Sắp xếp theo :</span>
                    <div class="custom-select">
                        <select id="filter">
                            <option value="0" selected="selected">Thứ tự mặc định</option>
                            <option value="1" selected="">Sản phẩm best-seller</option>
                            <option value="2" selected="">Sản phẩm khuyến mãi</option>
                            <option value="3" selected="">Sản phẩm mới nhất</option>
                            <option value="4" selected="">Sản phẩm đề xuất</option>
                            <option value="5" selected="">Sản phẩm theo giá</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- list product -->
            @if ($products->count())
            @include('frontend.product.products')
            @else
            <br>
            <h2>Không tìm thấy sản phẩm</h2>
            @endif
        </div>
    </div>
    <!--End products-->
</div>
<div id="scroll-top"><a href="#"><img src="{{ asset('images/totop.svg') }}" width="17" height="53"></a></div>
@stop

@push('after-scripts')

<script type="text/javascript">
    $("#menu_product").addClass('active');
    $(document).ready(function($) {
        $("#my-accordion").accordionjs({
            activeIndex: $('li.active').index() + 1
        });
        var sort = {
            'Sản phẩm best-seller': 1,
            'Sản phẩm khuyến mãi': 2,
            'Sản phẩm mới nhất': 3,
            'Sản phẩm đề xuất': 4,
            'Sản phẩm theo giá': 5,
        };

        $('.select-items').click(function() {
            $('input[name="sort"]').val(sort[$('.select-selected').text()]);
            reloadProduct();
        })

        $('.sort-mobile button').click(function() {
            $('input[name="sort"]').val($(this).val());
        })

        $('.price_range').change(function() {
            var range1 = $('input[name="range-1"]').val();
            var range2 = $('input[name="range-2"]').val();

            if (range1 > range2) {
                $('input[name="range-1"]').val(range2);
                $('input[name="range-2"]').val(range1);
            }

            reloadProduct();
        });

        function reloadProduct() {
            // get all the inputs into an array.
            var $inputs = $('#listForm :input');

            // not sure if you wanted this, but I thought I'd add it.
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });
            $.ajax({
                type: 'get',
                url: '/product/sortProduct?' +
                    'id=' + values['id'] +
                    '&sort=' + values['sort'] +
                    '&start=' + values['range-1'] +
                    '&end=' + values['range-2'],
                success: function(response) {
                    $('.list-product').html(response);
                }
            });
        }
    });
</script>

@endpush
