@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content pb-0">
    <h2>สติ๊กเกอร์ไลน์, อิโมจิไลน์, ธีมไลน์มาใหม่ <small class="text-black-50">({{ ThaiDate($new_arrival->start_date)
            }})</small></h2>
</div>


@if(count($sticker) != 0)
<div class="fh5co-narrow-content pt-0 pb-5">
    <ul class="list-unstyled row">
        @foreach($sticker as $row)
        <li class="col-md-{{ @$_GET['row'] ?? 2 }} col-sm-3 col-4">
            @include('include.front.__product_item3', array('type'=>'sticker','row'=>$row))
        </li>
        @endforeach
        @foreach($emoji as $row)
        <li class="col-md-{{ @$_GET['row'] ?? 2 }} col-sm-3 col-4">
            @include('include.front.__product_item3', array('type'=>'emoji','row'=>$row))
        </li>
        @endforeach
        @foreach($theme as $row)
        <li class="col-md-{{ @$_GET['row'] ?? 2 }} col-sm-3 col-4">
            @include('include.front.__product_item3', array('type'=>'theme','row'=>$row))
        </li>
        @endforeach
    </ul>
</div>
@endif

@endsection

@push('css')
<style>
    .productImg {
        margin: 0 auto;
    }

    .productImg img {
        width: 100%;
    }

    p.fh5co-work-title {
        font-size: 30px !important;
        line-height: 35px;
    }

    body #fh5co-main {
        background-image: none;
    }
</style>
@endpush

@push('js')
{{-- <script>
    var colors = ['#eee'];

$('.productImg').each(function() {
    $(this).css('background-color', colors[Math.floor(Math.random() * colors.length)]);
});
</script> --}}
@endpush