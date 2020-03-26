@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
    <form class="bd-search" method="get" action="{{ url('search') }}">
        <div class="form-row">
            <div class="form-group col-6">
                <select name="category" class="form-control">
                    <option value="">เลือกประเภท</option>
                    <option value="official" @if(@$_GET['category'] == 'official') selected @endif>ทางการ</option>
                    <option value="creator" @if(@$_GET['category'] == 'creator') selected @endif>ครีเอเตอร์</option>
                </select>
            </div>
            <div class="form-group col-6">
                <select name="country" class="form-control">
                    <option value="">เลือกประเทศ</option>
                    <option value="global" @if(@$_GET['country'] == 'global') selected @endif>ทั่วโลก</option>
                    <option value="thai" @if(@$_GET['country'] == 'thai') selected @endif>ไทย</option>
                    <option value="japan" @if(@$_GET['country'] == 'japan') selected @endif>ญี่ปุ่น</option>
                    <option value="taiwan" @if(@$_GET['country'] == 'taiwan') selected @endif>ไต้หวัน</option>
                    <option value="indonesia" @if(@$_GET['country'] == 'indonesia') selected @endif>อินโดนีเซีย</option>
                </select>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="พิมพ์ค้นหา" name="q" value="{{ @$_GET['q'] }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-danger" type="submit" id="button-addon2" style="margin:0px;"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
</div>

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ผลการค้นหา {{ @$_GET['category'] }} {{ @$_GET['country'] }} {{ @$_GET['q'] }}</h2>

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
