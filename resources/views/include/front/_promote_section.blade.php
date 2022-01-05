@if(count($sticker_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์แนะนำ</h2>
	</div>
	<div>
		<a href="{{ url('page/view/8') }}"><span class="hilight_yellow text-dark"><i class="fas fa-star fa-spin"
					style="color:#dc3545; margin-right:5px;"></i> <u>สนใจโปรโมทสติ๊กเกอร์ไลน์ ธีม
					อิโมจิคลิ๊ก...</u></span></a>
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

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">แนะนำจากทางร้าน</h2>
		<p class="text-right read-more-text"><a href="{{ url('series') }}">ดูทั้งหมด ></a></p>
	</div>
	@foreach ($serie_promote->chunk(3) as $chunk)
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