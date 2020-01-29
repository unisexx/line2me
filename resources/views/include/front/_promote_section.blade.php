@php
// สติ๊กเกอร์ไลน์โปรโมท
$sticker_promote = DB::table('promotes')
	->join('stickers', 'promotes.product_code', '=', 'stickers.sticker_code')
	->select('stickers.*')
	->where('promotes.product_type', '=', 'sticker')
	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
	->inRandomOrder()
	->take(30)
	->get();

// ธีมไลน์โปรโมท
$theme_promote = DB::table('promotes')
	->join('themes', 'promotes.product_code', '=', 'themes.id')
	->select('themes.*')
	->where('promotes.product_type', '=', 'theme')
	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
	->inRandomOrder()
	->take(30)
	->get();

// อิโมจิไลน์โปรโมท
$emoji_promote = DB::table('promotes')
	->join('emojis', 'promotes.product_code', '=', 'emojis.emoji_code')
	->select('emojis.*')
	->where('promotes.product_type', '=', 'emoji')
	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
	->inRandomOrder()
	->take(30)
	->get();
@endphp

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
