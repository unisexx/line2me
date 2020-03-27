@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
    <h2>รวมสติ๊กเกอร์ไลน์ชุด {{ $rs->title }}</h2>
</div>

@if(@$rs->seriesItem)
    @if(@$rs->seriesItem->where('product_type','sticker')->count() > 0)
    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h3>สติ๊กเกอร์ไลน์</h3>
        </div>
        <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
            @foreach(@$rs->seriesItem->where('product_type','sticker') as $row)
                @include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
            @endforeach
            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
    @endif

    @if(@$rs->seriesItem->where('product_type','emoji')->count() > 0)
    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h3>อิโมจิไลน์</h3>
        </div>
        <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
            @foreach(@$rs->seriesItem->where('product_type','emoji') as $row)
                @include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
            @endforeach
            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
    @endif

    @if(@$rs->seriesItem->where('product_type','theme')->count() > 0)
    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h3>ธีมไลน์</h3>
        </div>
        <div class="animate-box d-flex flex-wrap justify-content-start" data-animate-effect="fadeInLeft">
            @foreach(@$rs->seriesItem->where('product_type','theme') as $row)
                @include('include.front.__product_item', array('type'=>'theme','row'=>$row))
            @endforeach
            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
    @endif
@endif

@endsection
