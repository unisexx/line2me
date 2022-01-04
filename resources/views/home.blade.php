@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content single-item mb-4 {{-- owl-carousel owl-theme --}}">
	<div><a href="https://line.me/R/ti/p/HuNn5V9sfP"><img class="img-fluid" src="{{ url('image/banner.jpg') }}"
				alt="line2me.in.th" style="width:100%;"></a></div>
	{{-- <div><a href="https://line2me.in.th/page/view/22" target="_blank"><img class="img-fluid"
				src="{{ url('image/free_promote.png') }}" alt="โปรโมทสติ๊กเกอร์ไลน์"></a></div> --}}
</div>


@if(count($sticker_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ขายดีแนะนำ</h2>
		{{-- <p class="text-right read-more-text"><a href="{{ url('page/view/8') }}"><span
					class="simple-highlight">สนใจโปรโมทสติ๊กเกอร์ไลน์ราคาถูกมากคลิก</span></a></p> --}}
	</div>
	<div><a href="{{ url('page/view/8') }}"><span class="hilight_yellow text-dark"><i class="fas fa-star fa-spin"
					style="color:#dc3545;"></i> <u>สนใจโปรโมทสติ๊กเกอร์ไลน์ราคาถูกมากคลิก</u></span></a>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_promote as $row)
		@include('include.front.__product_item', array('type'=>'sticker','row'=>$row->sticker))
		@endforeach
	</div>
</div>
@endif


@if(count($emoji_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์แนะนำ</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_promote as $row)
		@include('include.front.__product_item', array('type'=>'emoji','row'=>$row->emoji))
		@endforeach
	</div>
</div>
@endif


@if(count($theme_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์แนะนำ</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_promote as $row)
		@include('include.front.__product_item', array('type'=>'theme','row'=>$row->theme))
		@endforeach
	</div>
</div>
@endif


@if(count($sticker_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่</h2>
	</div>
	<div><span class="hilight_green">{!! @$new_arrival_note !!}</span></div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_update as $row)
		@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
	</div>
</div>
@endif


@if(count($emoji_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการมาใหม่</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_update as $row)
		@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
	</div>
</div>
@endif


@if(count($theme_update) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการมาใหม่</h2>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_update as $row)
		@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
	</div>
</div>
@endif

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">แนะนำจากทางร้าน</h2>
		<p class="text-right read-more-text"><a href="{{ url('series') }}">ดูทั้งหมด ></a></p>
	</div>
	@foreach ($series->chunk(3) as $chunk)
	<div class="row mb-2">
		@foreach($chunk as $row)
		<div class="col pl-2 pr-2">
			<a href="{{ url('series/'. $row->id) }}">
				<img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}"
					title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
			</a>
		</div>
		@endforeach
	</div>
	@endforeach
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/official/th/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_official_thai as $row)
		@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
	</div>
</div>


<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_official_oversea as $row)
		@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('sticker/creator/all/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($sticker_creator as $row)
		@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/official/th/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_official_thai as $row)
		@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_official_oversea as $row)
		@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('emoji/creator/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($emoji_creator as $row)
		@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการไทย</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/official/th/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_official_thai as $row)
		@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ทางการต่างประเทศ</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/official/oversea/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_official_oversea as $row)
		@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์ครีเอเตอร์</h2>
		<p class="text-right read-more-text"><a href="{{ url('theme/creator/top') }}">ดูทั้งหมด ></a></p>
	</div>
	<div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
		@foreach($theme_creator as $row)
		@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
	</div>
</div>
@endsection

@push('css')
<style>
	.owl-prev,
	.owl-next {
		color: #869791 !important;
	}
</style>
@endpush

@push('js')
<script>
	$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 10,
		responsiveClass: true,
		responsive: {
			0: {
			items: 1,
			nav: true
			}
		},
		autoplay:true,
		autoplayTimeout:5000,
		autoplayHoverPause:true,
		animateOut: 'fadeOut',
		navText : ["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
	})
})
</script>
@endpush