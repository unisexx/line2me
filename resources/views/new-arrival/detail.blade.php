@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content pb-0">
    <h2>สติ๊กเกอร์ไลน์, อิโมจิไลน์, ธีมไลน์มาใหม่ <small class="text-black-50">({{ ThaiDate($new_arrival->start_date) }})</small></h2>
</div>


@if(count($sticker) != 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>สติ๊กเกอร์ไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach($sticker as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
        </li>
    @endforeach
    </ul>
</div>
@endif

@if(count($emoji) != 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>อิโมจิไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach($emoji as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
        </li>
    @endforeach
    </ul>
</div>
@endif

@if(count($theme) != 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <div class="d-flex justify-content-start align-items-baseline animate-box" data-animate-effect="fadeInLeft">
        <h3><small>ธีมไลน์</small></h3>
    </div>
    <ul class="list-unstyled row">
    @foreach($theme as $row)
        <li class="col-md-2 col-sm-3 col-4">
            @include('include.front.__product_item', array('type'=>'theme','row'=>$row))
        </li>
    @endforeach
    </ul>
</div>
@endif 


@include('include.front._promote_section')

@endsection
