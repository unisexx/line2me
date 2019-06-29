@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title }}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->country }}</li>
			</ul>
		</div>
		 
	</div>

	<!-- ปุ่มสั่งซื้อ -->
	<div class="text-center animate-box" data-animate-effect="fadeInLeft">
		<hr>
			<a href="https://line.me/ti/p/@line2me.in.th" target="_blank"><button type="button" class="btn btn-success btn-block">สั่งซื้อคลิก</button></a>
		<hr>
	</div>
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p> @endif

	<div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 5; $x++)
			<img class="align-self-baseline theme-image-detail" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png" alt="ธีมไลน์ {{ $rs->title }}">
		@endfor
	</div>

	<!-- Social Share -->
	<ul class="list-inline">
		<li class="list-inline-item">
			แชร์ลิ้งค์ : 
		</li>
		<li class="list-inline-item">
			<a href="https://social-plugins.line.me/lineit/share?url={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-line"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://twitter.com/home?status={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-twitter"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target="_blank"><i class="fab fa-2x fa-facebook-square"></i></a>
		</li>
		<li class="list-inline-item">
			<a href="https://line.me/S/shop/theme/detail?id={{ $rs->theme_code }}" target="_blank"><i class="fas fa-2x fa-share"></i></a>
		</li>
	</ul>
	<hr>
	<!-- Social Share -->
		
</div>


@if(count($sticker_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์แนะนำ</h2>
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('sticker/'.$row->sticker_code) }}">
				<div class="sticker-image-cover">
					<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
					{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
				</div>
				<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif

@if(count($emoji_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์แนะนำ</h2>
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('emoji/'.$row->id) }}">
				<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif


@if(count($theme_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์แนะนำ</h2>
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_promote as $row)
		<div class="work-item text-center">
			{!! new_icon($row->created_at) !!}
			<a href="{{ url('theme/'.$row->id) }}">
				<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
				<h3 class="fh5co-work-title">{{ $row->title }}</h3>
				<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
			</a>
		</div>
		@endforeach
	</div>
</div>
@endif



@endsection
