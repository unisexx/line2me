@extends('layouts.front') @section('content')

@if(@$rs->seriesItem)
    @foreach(@$rs->seriesItem->where('product_code','sticker') as $row)
        @include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
    @endforeach

    @foreach(@$rs->seriesItem->where('product_code','emoji') as $row)
        @include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
    @endforeach

    @foreach(@$rs->seriesItem->where('product_code','theme') as $row)
        @include('include.front.__product_item', array('type'=>'theme','row'=>$row))
    @endforeach
@endif

@endsection
