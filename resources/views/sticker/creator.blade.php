@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>

	<select class="custom-select col-md-2 animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/sticker/creator/'+this.value;">
		<option value="top" {{ Request::segment(3) == 'top' ? 'selected' : '' }}>ฮิต</option>
		<option value="new" {{ Request::segment(3) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
	</select>

	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($sticker as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/product/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $sticker->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
