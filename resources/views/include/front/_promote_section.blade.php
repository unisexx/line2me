@php
// สติ๊กเกอร์ไลน์โปรโมท
// $sticker_promote = DB::table('promotes')
// 	->join('stickers', 'promotes.product_code', '=', 'stickers.sticker_code')
// 	->select('stickers.*')
// 	->where('promotes.product_type', '=', 'sticker')
// 	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
// 	->inRandomOrder()
// 	->take(30)
// 	->get();

// ธีมไลน์โปรโมท
// $theme_promote = DB::table('promotes')
// 	->join('themes', 'promotes.product_code', '=', 'themes.id')
// 	->select('themes.*')
// 	->where('promotes.product_type', '=', 'theme')
// 	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
// 	->inRandomOrder()
// 	->take(30)
// 	->get();


// อิโมจิไลน์โปรโมท
// $emoji_promote = DB::table('promotes')
// 	->join('emojis', 'promotes.product_code', '=', 'emojis.emoji_code')
// 	->select('emojis.*')
// 	->where('promotes.product_type', '=', 'emoji')
// 	->where('promotes.end_date', '>=', Carbon::now()->toDateString())
// 	->inRandomOrder()
// 	->take(30)
// 	->get();

// editorpick
// $series = App\Models\Series::where('status', 1)->take(3)->inRandomOrder()->get();


$sticker_promote = Cache::remember('sticker_promote', config('calculations.cache_time'), function() {
	return App\Models\Promote::where('product_type', '=', 'sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->orderBy('id', 'desc')->get();
});

$theme_promote = Cache::remember('theme_promote', config('calculations.cache_time'), function() {
	return App\Models\Promote::where('product_type', '=', 'theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->orderBy('id', 'desc')->get();
});

$emoji_promote = Cache::remember('emoji_promote', config('calculations.cache_time'), function() {
	return App\Models\Promote::where('product_type', '=', 'emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->orderBy('id', 'desc')->get();
});

$series = Cache::remember('editor_pick', now()->addMinutes(3), function() {
	return App\Models\Series::where('status', 1)->take(3)->inRandomOrder()->get();
});
@endphp

@if(count($sticker_promote) != 0)
<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์แนะนำ</h2>
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
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
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
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
		<p class="text-right read-more-text"><a href="{{ url('page/view/8') }}">สนใจโปรโมทสติ๊กเกอร์ ธีม อิโมจิไลน์ของท่านอ่านรายละเอียดที่นี่จ้า ></a></p>
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
	<div class="row mb-5">
		@foreach($series as $row)
		<div class="col pl-2 pr-2">
			<a href="{{ url('series/'. $row->id) }}">
				<img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
			</a>
		</div>
		@endforeach
	</div>
</div>

