@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'Trang cá nhân')
@section('description', 'Trang cá nhân')
@section('og:title', 'Trang cá nhân')
@section('og:description', 'Trang cá nhân')

@section('content')
<div class="container">
	<div class="wrapper user">
		<div class="user-tabs">
			<ul>
				<li class="tab-link @if(!$errors->any() && old('mode') == '') current @endif" data-tab="order-history">Lịch sử đơn hàng</li>
				<li class="tab-link @if($errors->has('errorInfo') || old('mode') == 'info') current @endif" data-tab="user-info">Thông tin cá nhân</li>
				<li class="tab-link @if(old('mode') == 'addr') current @endif" data-tab="user-address">Địa chỉ đã lưu</li>
				<form action="{{route('frontend.auth.logout')}}" method="post" id="logout-form" style="display:none;">@csrf</form>
				<li class="tab-link" data-tab="logout" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><a>Đăng xuất</a></li>
			</ul>
		</div>
		<div class="wrap-info">
			<div class="user-tab-content tab-content">
				@include('frontend.mypage.history')
				@include('frontend.mypage.info')
				@include('frontend.mypage.address')
			</div>
		</div>
	</div>
	<!--End payment-method-->
</div>
@stop

@push('after-scripts')
<script type="text/javascript">
	$(document).ready(function($) {
		$("#my-accordion").accordionjs();


		$('a.cart-popup').click(function(event) {
			$(this).modal({
				fadeDuration: 250
			});
			return false;
		});
	});
</script>
@endpush