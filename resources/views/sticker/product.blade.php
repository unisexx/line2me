@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">

	<div class="d-flex animate-box" data-animate-effect="fadeInLeft">

		<div class="sticker-image-cover">
			<img class="img-fluid playAnimate" src="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}" data-animation="{{ get_sticker_img_url($rs->stickerresourcetype,$rs->version,$rs->sticker_code) }}">
			<audio id="mainAudio" class="d-none" controls autoplay preload="metadata">
				<source src="https://sdl-stickershop.line.naver.jp/stickershop/v1/product/{{ $rs->sticker_code }}/IOS/main_sound.m4a" type="audio/mpeg">
			</audio>
			{!! getStickerResourctTypeIcon($rs->stickerresourcetype) !!}
		</div>

		<div class="sticker-infomation">
			<h3>{{ $rs->title_th }} {{ getStickerResourctTypeName($rs->stickerresourcetype) }}</h3>
			<ul>
				<li>ราคา : {{ convert_line_coin_2_money($rs->price) }} บาท</li>
				<li>ประเภท : {{ $rs->category }}</li>
				<li>ประเทศ : {{ $rs->country }}</li>
			</ul>
		</div>

	</div>

	<!-- ปุ่มสั่งซื้อ -->
	@include('include.front._add_line_btn')
	<!-- ปุ่มสั่งซื้อ -->

	@if($rs->detail)
		<p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
	@endif
	<p class="animate-box" data-animate-effect="fadeInLeft"><small>*** โปรดแตะที่ตัวสติ๊กเกอร์เพื่อดูตัวอย่าง หรือฟังเสียง (ถ้าเป็นสติ๊กเกอร์แบบมีเสียง) ***</small></p>

	<div class="animate-box" data-animate-effect="fadeInLeft">
		@if($rs->stamp_start === null)

			<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

		@else

			@php
				$stamp_count = $rs->stamp_end - $rs->stamp_start;
			@endphp

			<!-- ถ้าจำนวน stamp มากกว่า 40 แสดงว่ามี stamp ซ้อนกันกับชุดอื่น ให้แสดงเป็นรูปใหญ่แทน -->
			@if($stamp_count > 40)

				<img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

			@else

				<ul class="list-inline">
					@for($x = $rs->stamp_start; $x <= $rs->stamp_end; $x++)
					@php
						if($rs->stickerresourcetype == 'SOUND' || $rs->stickerresourcetype == 'STATIC' || $rs->stickerresourcetype == 'NAME_TEXT' || $rs->stickerresourcetype == 'PER_STICKER_TEXT'){
							$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$x."/android/sticker.png;compress=true";
						}elseif($rs->stickerresourcetype == 'POPUP' || $rs->stickerresourcetype == 'POPUP_SOUND'){
							$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$x."/IOS/sticker_popup.png;compress=true";
						}
						else{
							$data_animation = "https://stickershop.line-scdn.net/stickershop/v1/sticker/".$x."/IOS/sticker_animation@2x.png;compress=true";
						}
					@endphp
						<li class="sticker-stamp-list">
							<img class="sticker-stamp playAnimate" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $x }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}">
							<audio preload="metadata">
								<source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $x }}.m4a" type="audio/mpeg">
							</audio>
						</li>
					@endfor
				</ul>

			@endif

		@endif
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
			<a href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank"><i class="fas fa-2x fa-share"></i></a>
		</li>
	</ul>
	<hr>
	<!-- Social Share -->

</div>

@include('include.front._promote_section')

@endsection
