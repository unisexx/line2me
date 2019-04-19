@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ครีเอเตอร์</h2>

	<select class="custom-select col-md-2 animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/theme/creator/'+this.value;">
		<option value="top" {{ Request::segment(3) == 'top' ? 'selected' : '' }}>ฮิต</option>
		<option value="new" {{ Request::segment(3) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
	</select>

	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $theme->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
