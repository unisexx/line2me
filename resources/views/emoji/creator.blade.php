@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ครีเอเตอร์</h2>

	<div class="row mb-3">
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/emoji/creator/'+this.value;">
				<option value="top" {{ Request::segment(3) == 'top' ? 'selected' : '' }}>ฮิต</option>
				<option value="new" {{ Request::segment(3) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
			</select>
		</div>
	</div>

	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
			@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $emoji->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
