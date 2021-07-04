@extends('frontend.default')

@section('keywords', "tư vấn khách hàng")
@section('page_title', 'Góc tư vấn')
@section('description', 'Nhận tư vấn khách hàng')
@section('og:title', 'Góc tư vấn')
@section('og:description', 'Nhận tư vấn khách hàng')

@section('content')
<div id="quiz">

	<div class="container">
		<div class="quiz">
			<div class="wrapper">
				@if(session()->get('status'))
				<div class="quiz-header">
					<p class="break-title">GÓC TƯ VẤN</p>
					<h1>Trắc nghiệm làn da</h1>
					<p style="text-align: center;">{{ session()->get('status') }}</p>
				</div>
				@else
				<div class="quiz-header">
					<p class="break-title">GÓC TƯ VẤN</p>
					<h1>Trắc nghiệm làn da</h1>
					<p>Hãy để lại thông tin để MIRI có thể hỗ trợ tư vấn bạn một cách tốt nhất nhé</p>
				</div>
				<div class="form-quiz">
					<form method="post" action="{{route('frontend.quiz.index')}}">
						@csrf
						<div class="input-info">
							<div class="quiz-row">
								<h2>THÔNG TIN CỦA KHÁCH HÀNG</h2>
								<input type="text" required name="name" placeholder="Họ và tên của bạn (bắt buộc)">
								<input type="email" required name="email" placeholder="E-mail của bạn (bắt buộc)">
								<input type="text" required name="phone_number" placeholder="Số điện thoại của bạn (bắt buộc)" style="margin-bottom: 0px;">
							</div>
							<div class="quiz-row">
								<h2>LÀN DA CỦA BẠN</h2>
								<div class="custom-select">
									<select id="filter" name="skin_type">
										<option value="0">Da thường</option>
										<option value="1">Da dầu</option>
										<option value="2">Da khô</option>
										<option value="3">Da hỗn hợp</option>
										<option value="4">Da nhạy cảm</option>
									</select>
								</div>
							</div>
							<div class="quiz-row">
								<h2>VẤN ĐỀ DA CỦA BẠN</h2>
								<div class="custom-select">
									<select id="filter" name="skin_problem">
										<option value="0">Da bị lão hoá</option>
										<option value="1">Da bị ửng đỏ</option>
										<option value="2">Da bị khô</option>
										<option value="3">Da bị chấm đỏ, trắng</option>
									</select>
								</div>
							</div>
							<textarea rows="10" cols="50" placeholder="Lưu ý khác"></textarea>
						</div>

						<div class="submit-quiz"><button type="submit" class="common-button">GỬI THÔNG TIN</button></div>
					</form>
				</div>
				@endif
			</div>
		</div>
		<!--End MIRI-->
	</div>
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
	$("#menu_quiz").addClass('active');
</script>

@endpush
