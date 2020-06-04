@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title }}</h3>
			<ul>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ @countryName($rs->country) }}</li>
			</ul>
		</div>
		
	</div>

	<!-- ปุ่มสั่งซื้อ -->
	@include('include.front._add_line_btn')
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p> @endif

	<div class="animate-box" data-animate-effect="fadeInLeft">

		@for($x = 1; $x <= 50; $x++)
			<img class="img-emoji" src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/{{ $rs->emoji_code }}/iphone/{{ sprintf('%03d', $x) }}.png" alt="อิโมจิไลน์ {{ $rs->title }}" onerror="this.style.display='none'"/>
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
			<a href="https://line.me/S/emoji/?id={{ $rs->emoji_code }}" target="_blank"><i class="fas fa-2x fa-share"></i></a>
		</li>
	</ul>
	<hr>
	<!-- Social Share -->
		
</div>

@include('include.front._promote_section')
@endsection
