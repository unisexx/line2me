@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">รวมสติ๊กเกอร์ไลน์ชุดน่าสนใจ</h2>

    @foreach(@$rs->chunk(3) as $three)
    <div class="row mb-3">
        @foreach($three as $row)
        <div class="col">
            <a href="{{ url('series/'. $row->id) }}">
                <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
            </a>
        </div>
        @endforeach
    </div>
    @endforeach

    {{ $rs->appends(@$_GET)->render() }}
</div>

@endsection
