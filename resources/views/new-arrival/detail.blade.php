@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
    <h2>สติ๊กเกอร์ไลน์, อิโมจิไลน์, ธีมไลน์มาใหม่ <small class="text-black-50">({{ ThaiDate($new_arrival->start_date) }})</small></h2>
</div>

@if(count($sticker) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h3><small>สติ๊กเกอร์ไลน์</small></h3>
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
		<h3><small>อิโมจิไลน์</small></h3>
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
		<h3><small>ธีมไลน์</small></h3>
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
