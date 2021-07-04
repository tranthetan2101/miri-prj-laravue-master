@extends('frontend.default')

@section('keywords', 'MIRI')
@section('page_title', 'MIRI contact')
@section('description', 'MIRI contact')
@section('og:title', 'MIRI contact')
@section('og:description', 'MIRI contact')

@section('content')
<div class="container">
	<div class="showroom wrapper">
		@foreach ($contacts as $index => $contact)
		<div class="">
			<h1>Hệ thống Showroom {{$index + 1}}</h1>
			<div></div>
		</div>
		<div class="gmap">
			<p><img src="{{$contact->picture}}"></p>
		</div>
		<div class="showroom-info mt-1">
			<div class="showroom-row building">
				<h2>{{$contact->address_building}}</h2>
				<p class="confirm confirm-address">{{$contact->address}}</p>
				<p class="confirm confirm-phone">{{$contact->phone_number}}</p>
				<p class="confirm confirm-envelope">{{$contact->email}}</p>
				<p class="confirm confirm-internet">{{$contact->link}}</p>
				<p class="confirm confirm-time">{{$contact->open_time->format('h:i A')}} - {{$contact->close_time->format('h:i A')}}</p>
			</div>
			<div class="showroom-row">
				<h2><b>HOTLINE: {{$contact->hotline}}</b></h2>
			</div>
			<div class="showroom-row">
				<h2>{{$contact->name}}</h2>
			<p>{{$contact->description}}</p>
			</div>
		</div>
		@endforeach
	</div>

	<!--End MIRI-->
</div>
@stop

@push('after-scripts')

<script type="text/javascript">
	$("#menu_contact").addClass('active');
</script>
@endpush
