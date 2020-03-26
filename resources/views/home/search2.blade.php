@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
    <form class="bd-search d-flex align-items-center" method="get" action="{{ url('search2') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ค้นหา" name="q" value="{{ @$_GET['q'] }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-danger" type="submit" id="button-addon2" style="margin:0px;"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ผลการค้นหา "{{ @$_GET['q'] }}"</h2>

	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($search as $row)
		<div class="work-item text-center">

			@if($type == 'sticker')

				@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))

			@elseif($type == 'theme')

				@include('include.front.__product_item', array('type'=>'theme','row'=>$row))

			@elseif($type == 'emoji')

				@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))

			@endif

		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $search->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
