@extends('layouts.front') @section('content')
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
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">สติ๊กเกอร์ไลน์</h2>
		@if(@$_GET != '') <p class="text-right read-more-text"><a href="{{ url('search/sticker?q='.@$_GET['q'].'&country='.@$_GET['country'].'&category='.@$_GET['category']) }}">ดูทั้งหมด ></a></p> @endif
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($sticker as $row)
			@include('include.front.__product_item', array('type'=>'sticker','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">อิโมจิไลน์</h2>
		@if(@$_GET != '') <p class="text-right read-more-text"><a href="{{ url('search/emoji?q='.@$_GET['q'].'&country='.@$_GET['country'].'&category='.@$_GET['category']) }}">ดูทั้งหมด ></a></p> @endif
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($emoji as $row)
			@include('include.front.__product_item', array('type'=>'emoji','row'=>$row))
		@endforeach
	</div>
</div>

<div class="fh5co-narrow-content">
	<div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
		<h2 class="fh5co-heading">ธีมไลน์</h2>
		@if(@$_GET != '') <p class="text-right read-more-text"><a href="{{ url('search/theme?q='.@$_GET['q'].'&country='.@$_GET['country'].'&category='.@$_GET['category']) }}">ดูทั้งหมด ></a></p> @endif
	</div>
	<div class="animate-box d-flex flex-wrap justify-content-around" data-animate-effect="fadeInLeft">
		@foreach($theme as $row)
			@include('include.front.__product_item', array('type'=>'theme','row'=>$row))
		@endforeach
	</div>
</div>

@endsection
