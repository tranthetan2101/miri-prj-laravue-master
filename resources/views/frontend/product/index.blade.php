@extends('frontend.default')

@section('keywords', "MIRI")
@section('page_title', $product->name)
@section('description', 'Chi tiết sản phẩm')
@section('og:image', $product->images->first()['picture'])
@section('og:title', $product->name)
@section('og:description', 'Chi tiết sản phẩm')

@section('content')
<div class="container">
	<div class="product-detail wrapper">
		<div class="gallery">
			<div class="gallery-inner">
				<p class="label product-detail">
					@if($product->sale->count() > 0)
					<span class="off">{{$product->sale->first()->name}}</span>
					@elseif (!empty($product->tag_sale))
					<span class="off">{{$product->tag_sale}}</span>
					@endif
					@if( $product->tag_best == 1)
					<span class="best">Best seller</span>
					@elseif ($product->tag_recommend == 1)
					<span class="best">Nên mua</span>
					@endif
				</p>
				<ul class="slides">
					@foreach($product->images->pluck('picture') as $idx => $img)
					<li><img src="{{$img}}"></li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="content">
			<div class="content-header">
				<p class="cats">{{$product->category->name}}</p>
				<h2>{{$product->name}}</h2>
				<h3 style="margin-top: -10px;margin-bottom: 15px;"><span>{{$product->name_mini}}</span></h3>
				<p>
					<span class="sale-price">{{number_format($product->discount_price)}}VND</span>
					@if ($product->discount_price < $product->price)
						<span class="old-price">{{number_format($product->price)}}VND</span>
						@endif
				</p>
			</div>
			<div class="few-info">
				<p class="product-code">Mã SP: {{$product->sku}}</p>
				<p>Dung tích: {{$product->capacity}}</p>
				<p>Xuất xứ: {{$product->origin}}</p>
			</div>
			<div class="rating-container">
				<div class="ratings">
					<div class="rating-box">
						@if (Auth::check() && !$product->productRating->contains('user_id', Auth::user()->id))
						<div class="rating_item rating_item_1" data-rating="1"></div>
						<div class="rating_item rating_item_2" data-rating="2"></div>
						<div class="rating_item rating_item_3" data-rating="3"></div>
						<div class="rating_item rating_item_4" data-rating="4"></div>
						<div class="rating_item rating_item_5" data-rating="5"></div>
						@endif
						<div class="rating" style="width:{{($product->productRating()->avg('rating') * 100) / 5}}%;"></div>
					</div>
					<div class="amount">({{$product->productRating->count()}} đánh giá)</div>
				</div>
			</div>
			<form action="{{route('frontend.product.rating')}}" method="post" name="form_rating">
				@csrf
				<input type="hidden" name="product_id" value="{{$product->id}}">
				<input type="hidden" name="rating">
			</form>
			<div class="countdown">
				@if($product->sale->count() > 0)
				<count-down :date="'{{$product->sale->first()->period_end->timestamp}}'"></count-down>
				@endif
			</div>
			<div class="add-to-cart">
				<form class="addItemForm">
					@csrf
					<input type="hidden" name="product_id" value="{{$product->id}}" />
					<input type="hidden" name="product_name" value="{{$product->name}}" />
					<input type="hidden" name="product_discount_price" value="{{$product->discount_price}}" />
					<div class="qty-input"><i class="less"></i>
						<input type="number" value="1" name="quantity" /><i class="more"></i>
					</div>
					<div class="cart-btn">
						@if ($product->stock > 0 || $product->stock_unlimited == 1)
						<button type="button" onclick="addItem()">THÊM VÀO GIỎ</button>
						@else
						<button type="button" class="sale-out" disabled>Hết hàng</button>
						@endif
					</div>
				</form>
			</div>
			<div class="content-footer">
				@if ($product->bonuses->count())
				<div class="gift-bonus">
					<span class="gift-title">Quà tặng kèm</span>
					@foreach ($product->bonuses as $bonus)
					<a href="{{route('frontend.product.detail', $bonus->id)}}" style="margin-bottom: 20px">
						<p>{{$bonus->name}}</p>
						<img src="{{$bonus->images->first()['picture']}}">
					</a>
					@endforeach
				</div>
				@endif
				<div class="other-bonus">
					<ul>
						<li class="delivery">Freeship từ {{number_format(setting('free_ship_min_cost', 500000))}}VND</li>
						@if( $product->sale->count())
						<li class="sale-off">Giảm giá {{$product->sale->first()->sale_amount}} {{$product->sale->first()->type == 1 ? 'VND' : '%'}}</li>
						@endif

						<!-- <li class="score">Tích luỹ được {{round($product->price1 / 1000)}} điểm</li> -->
					</ul>
				</div>
			</div>
		</div>
		<div class="description">
			<div class="description-tabs">
				<ul>
					<li class="tab-link current" data-tab="info">Thông tin</li>
					<li class="tab-link" data-tab="process">Quy trình</li>
					<li class="tab-link" data-tab="qa">Câu hỏi</li>
				</ul>
			</div>
			<div class="tab-content">
				<div id="info" class="tab-content-inner current product-description">
					{!! $product->description !!}
				</div>
				<div id="process" class="tab-content-inner product-description">
					{!! $product->description_2 !!}
				</div>
				<div id="qa" class="tab-content-inner product-description">
					{!! $product->description_3 !!}
				</div>
			</div>
		</div>
	</div>
	<!--End product-detail-->
	@if (!empty($combo))
	<div class="get-double">
		<div class="get-double-content">
			<h1>{{$combo->name}}</h1>
			<p>{{$combo->description}}</p>
			<button onclick="addGiftSet({{ $combo->product_id }}, {{ $combo->discount_price }})">MUA NGAY</button>
		</div>
		<div class="get-double-img">
			<img src="{{ $combo->image }}" />
		</div>
	</div>
	@endif

	@if ($lastSeen)
	@include('frontend.product.lastSeen')
	@endif
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
	$("#menu_product").addClass('active');
	$('.more').click(function() {
		$(this).prev().val(parseInt($(this).prev().val()) + 1)
	});

	$('.less').click(function() {
		$(this).next().val(parseInt($(this).next().val()) - 1)
	});

	$('.rating_item').hover(
		function() {
			var i;
			for (i = 1; i <= $(this).data('rating'); i++) {
				$('.rating_item_' + i).addClass('active');
			}

			for (i = $(this).data('rating') + 1; i <= 5; i++) {
				$('.rating_item_' + i).removeClass('active');
			}
		}
	)

	$('.rating').hover(
		function() {
			if ($('.rating_item').length) {
				$('.rating').addClass('hidden');
			}
		},
	)

	$('.rating_item').click(function() {
		$('input[name="rating"]').val($(this).data('rating'));
		$('form[name="form_rating"]').submit();
	})
</script>

@endpush