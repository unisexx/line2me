@extends('layouts.front')

@section('content')
@include('include.front._auth_change_status', ['table' => 'themes', 'var' => $rs])

<div class="fh5co-narrow-content">
	@include('include.front._breadcrumb')

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid" src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $rs->title }}">
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title }}</h3>
			<ul>
				<li>รหัสสินค้า : {{ $rs->id }}</li>
				<li>ราคา : {{ $rs->price }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ @countryName($rs->country) }}</li>
				@if($rs->status == 0)
				<li>สถานะ : <span class="badge badge-danger">ไม่สามารถซื้อได้เนื่องจากหมดเวลาจำหน่าย</span></li>
				@endif
			</ul>
		</div>
		
	</div>

	<!-- ปุ่มสั่งซื้อ -->
	@include('include.front._add_line_btn')
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->detail)
		<p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
		<p class="text-muted"><small>***บางส่วนของธีมอาจแสดงผลไม่ถูกต้องบน LINE เวอร์ชั่นที่คุณใช้อยู่*** | รหัสสินค้า : {{ $rs->id }}</small></p>
	@endif

	<div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap" data-animate-effect="fadeInLeft">
		@for($x = 1; $x <= 5; $x++)
		<a href="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png" class="venobox" data-gall="themeDetail" title="ธีมไลน์ {{ $rs->title }}">
			<img class="align-self-baseline theme-image-detail" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png" alt="ธีมไลน์ {{ $rs->title }}">
		</a>
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

@include('include.front._promote_section')
@endsection
