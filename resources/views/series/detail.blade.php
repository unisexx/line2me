@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content pb-0">
    <h2 class="mb-2">{{ $rs->title }}</h2>
    {!! @!empty($rs->sub_title) ? '<p>'.$rs->sub_title.'</p>' : '' !!}
</div>

@if(@$series_items->where('product_type','sticker')->count() > 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>สติ๊กเกอร์ไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach($series_items->where('product_type','sticker') as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item2', array('type'=>'sticker','row'=>$row->sticker))
        </li>
    @endforeach
    </ul>
</div>
@endif

@if(@$series_items->where('product_type','emoji')->count() > 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>อิโมจิไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach($series_items->where('product_type','emoji') as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item2', array('type'=>'emoji','row'=>$row->emoji))
        </li>
    @endforeach
    </ul>
</div>
@endif

@if(@$series_items->where('product_type','theme')->count() > 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>ธีมไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach(@$series_items->where('product_type','theme') as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item2', array('type'=>'theme','row'=>$row->theme))
        </li>
    @endforeach
    </ul>
</div>
@endif 


<div class="d-flex flex-wrap justify-content-around">{{ $series_items->appends(@$_GET)->render() }}</div>


{{-- more series --}}
<div class="fh5co-narrow-content pt-0">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ชุดอื่นๆที่น่าสนใจ</h2>
		<p class="text-right read-more-text"><a href="{{ url('series') }}">ดูทั้งหมด ></a></p>
	</div>
	@foreach ($serie_promote->chunk(3) as $chunk)
        <div class="row mb-5">
            @foreach($chunk as $row)
            <div class="col pl-2 pr-2">
                <a href="{{ url('series/'. $row->id) }}">
                    <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                </a>
            </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection