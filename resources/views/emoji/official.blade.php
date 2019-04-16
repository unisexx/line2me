@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ทางการ{{ Request::segment(3) == 'thai' ? 'ไทย' : 'ต่างประเทศ' }}</h2>

	<select class="custom-select col-md-2 animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/emoji/official/{{ Request::segment(3) }}/'+this.value;">
		<option value="top" {{ Request::segment(4) == 'top' ? 'selected' : '' }}>ฮิต</option>
		<option value="new" {{ Request::segment(4) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
	</select>

	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created) !!}
			<a href="{{ url('emoji/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $emoji->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
