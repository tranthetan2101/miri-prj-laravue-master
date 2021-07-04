@extends('frontend.default')

@section('keywords', "MIRI")
@section('page_title', 'Sản phẩm khuyến mãi')
@section('description', 'Danh sách sản phẩm')
@section('og:image', ($listProduct->count()) ? $listProduct->first()->images->first()['picture'] : '')
@section('og:title', 'Sản phẩm khuyến mãi')
@section('og:description', 'Danh sách sản phẩm')

@section('content')
<slide-show-component></slide-show-component>
<div class="container-home">
	@if ($newestSales->count())
	@include('frontend.promotion.newestPromotion')
	@endif
	<!--End favorite-product-->
	<div class="promotion products wrapper">
		<div class="sort-and-arrange"><a href="#filter-modal" rel="modal:open">LỌC VÀ SẮP XẾP</a></div>
		<div class="filter" id="filter-modal">
			<form method="post" id="listForm" action='/promotionSort'>
				@csrf
				<div class="categories">
					<h3>Danh mục sản phẩm</h3>
					<input type="hidden" name="listCate" value="">
					<input type="hidden" name="sort" value="">
					<ul class="check-list">
						@foreach($categories as $category)
						<li>
							<input class="" type="checkbox" id="checkbox-{{$category->id}}" name="category" value="{{$category->id}} ">
							<label class="" for="checkbox-{{$category->id}}">{{$category->name}}</label>
						</li>
						@endforeach
					</ul>
				</div>
				<div class="sort-mobile">
					<h3>Sắp xếp theo</h3>
					<ul>
                        <li><button type="submit" value="0">Thứ tự mặc định</button></li>
                        <li><button type="submit" value="1">Khuyến mãi sắp hết hạn</button></li>
                        <li><button type="submit" value="2">Khuyến mãi 30%</button></li>
                        <li><button type="submit" value="3">Khuyến mãi 50%</button></li>
                        <li><button type="submit" value="4">Khuyến mãi 70%</button></li>
						<li><button type="submit" value="5">Sắp xếp theo giá từ cao-thấp</button></li>
						<li><button type="submit" value="6">Sắp xếp theo giá từ thấp-cao</button></li>
                    </ul>
				</div>
				<div class="price_range">
					<h3>Lọc theo giá</h3>
					<section class="range-slider" id="facet-price-range-slider">
						<input name="range-1" value="0" min="0" max="999001" step="1" type="range">
						<input name="range-2" value="999000" min="500" max="999001" step="1" type="range">
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
							<option value="1" selected="">Khuyến mãi sắp hết hạn</option>
							<option value="2" selected="">Khuyến mãi 30%</option>
							<option value="3" selected="">Khuyến mãi 50%</option>
							<option value="4" selected="">Khuyến mãi 70%</option>
							<option value="5" selected="">Sắp xếp theo giá từ cao-thấp</option>
							<option value="6" selected="">Sắp xếp theo giá từ thấp-cao</option>
						</select>
					</div>
				</div>
			</div>
			@if ($listProduct->count())
			@include('frontend.promotion.product')
			@else 
			<h1>Không có sản phẩm</h1>
			@endif
		</div>
	</div>
	<!--End products-->
</div>

@stop

@push('after-scripts')

<script type="text/javascript">
	$(document).ready(function($) {
		$("input[name='category']").click(function() {
			var selected = [];
			$('input[name="category"]').each(function() {
				var ischecked = $(this).is(":checked");
				if (ischecked) {
					selected.push($(this).attr('value'));
				}
			});
			$("input[name='listCate']").val(selected);
			reloadProduct();

		});

		var sort = {
			'Khuyến mãi sắp hết hạn': 1,
			'Khuyến mãi 30%': 2,
			'Khuyến mãi 50%': 3,
			'Khuyến mãi 70%': 4,
			'Sắp xếp theo giá từ cao-thấp': 5,
			'Sắp xếp theo giá từ thấp-cao': 6,
		};

		$('.select-items').click(function() {
			$('input[name="sort"]').val(sort[$('.select-selected').text()]);
			reloadProduct();
		})

		$('.sort-mobile button').click(function(){
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
				url: '/promotionSort?' + 'listCate=' + values['listCate'] + '&sort=' + values['sort'] + '&start=' + values['range-1'] + '&end=' + values['range-2'],
				success: function(response) {
					$('.list-product-promotion').html(response);
				}
			});
		}
	});
</script>

@endpush

@push('after-scripts')

<script type="text/javascript">
	$("#menu_promo").addClass('active');
</script>
@endpush