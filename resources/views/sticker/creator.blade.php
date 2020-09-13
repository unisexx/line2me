@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>

	<div class="row mb-3">
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/sticker/creator/{{ Request::segment(3) }}/'+this.value;">
				<option value="top" {{ Request::segment(4) == 'top' ? 'selected' : '' }}>ฮิต</option>
				<option value="new" {{ Request::segment(4) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
			</select>
		</div>
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/sticker/creator/'+this.value+'/{{ Request::segment(4) }}'">
			<option value="all" {{ Request::segment(3) == 'all' ? 'selected' : '' }}>ทั้งหมด</option>
				<option value="thai" {{ Request::segment(3) == 'thai' ? 'selected' : '' }}>ไทย</option>
				<option value="oversea" {{ Request::segment(3) == 'oversea' ? 'selected' : '' }}>ต่างประเทศ</option>
				<option value="japan" {{ Request::segment(3) == 'japan' ? 'selected' : '' }}>ญุี่ปุ่น</option>
				<option value="taiwan" {{ Request::segment(3) == 'taiwan' ? 'selected' : '' }}>ไต้หวัน</option>
			</select>
		</div>
	</div>

	<div class="animate-box" data-animate-effect="fadeInLeft">
		<ul class="list-unstyled row">
		@foreach($sticker as $row)
			<li class="col-md-2 col-sm-3 col-4">
				@include('include.front.__product_item2', array('type'=>'sticker','row'=>$row))
			</li>
		@endforeach
		</ul>
		<div class="d-flex flex-wrap justify-content-around">{{ $sticker->appends(@$_GET)->render() }}</div>
	</div>
</div>

@endsection
