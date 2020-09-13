@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">แนะนำจากทางร้าน</h2>
    <p>รวมสติ๊กเกอร์ ธีม อิโมจิไลน์ที่น่าสนใจมาไว้ที่นี่แล้ว</p>

    @foreach(@$rs->chunk(3) as $three)
    <div class="row mb-3">
        @foreach($three as $row)
        <div class="col pl-2 pr-2">
            <a href="{{ url('series/'. $row->id) }}">
                <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
    
    <div class="d-flex flex-wrap justify-content-around">{{ $rs->appends(@$_GET)->render() }}</div>
</div>

@endsection
