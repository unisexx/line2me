@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
    <h2>รวมสติ๊กเกอร์ไลน์ชุด {{ $rs->title }}</h2>
</div>

@if(@$series_items->where('product_type','sticker')->count() > 0)
<div class="fh5co-narrow-content">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>สติ๊กเกอร์ไลน์</small></h3>
    </div>
    <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
        @foreach($series_items->where('product_type','sticker') as $row)
            @include('include.front.__product_item', array('type'=>'sticker','row'=>$row->sticker))
        @endforeach
        <div class="clearfix visible-md-block"></div>
        {{ $series_items->appends(@$_GET)->render() }}
    </div>
</div>
@endif

@if(@$series_items->where('product_type','emoji')->count() > 0)
<div class="fh5co-narrow-content">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>อิโมจิไลน์</small></h3>
    </div>
    <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
        @foreach($series_items->where('product_type','emoji') as $row)
            @include('include.front.__product_item', array('type'=>'emoji','row'=>$row->emoji))
        @endforeach
        <div class="clearfix visible-md-block"></div>
        {{ $series_items->appends(@$_GET)->render() }}
    </div>
</div>
@endif

@if(@$series_items->where('product_type','theme')->count() > 0)
<div class="fh5co-narrow-content">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>ธีมไลน์</small></h3>
    </div>
    <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
        @foreach(@$series_items->where('product_type','theme') as $row)
            @include('include.front.__product_item', array('type'=>'theme','row'=>$row->theme))
        @endforeach
        <div class="clearfix visible-md-block"></div>
    </div>
</div>
@endif

@endsection
