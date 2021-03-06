@extends('layouts.front') @section('content')

@if(count($sticker) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
		@foreach($sticker as $row)
			@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
		<div class="clearfix visible-md-block"></div>
	</div>
</div>
@endif

@if(count($emoji) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
			@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
		<div class="clearfix visible-md-block"></div>
	</div>
</div>
@endif

@if(count($theme) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์อัพเดท <small class="text-black-50">({{ DBToDate($new_arrival->created_at) }})</small></h2>
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
			@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
		<div class="clearfix visible-md-block"></div>
	</div>
</div>
@endif

@endsection
