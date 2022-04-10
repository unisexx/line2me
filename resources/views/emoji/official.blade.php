@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">อิโมจิไลน์ทางการ{{ @getCountryTh(Request::segment(3)) }}</h2>

	<div class="row mb-3">
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/emoji/official/{{ Request::segment(3) }}/'+this.value;">
				<option value="top" {{ Request::segment(4) == 'top' ? 'selected' : '' }}>ฮิต</option>
				<option value="new" {{ Request::segment(4) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
			</select>
		</div>
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/emoji/official/'+this.value+'/{{ Request::segment(4) }}'">
				<option value="th" {{ Request::segment(3) == 'th' ? 'selected' : '' }}>ไทย</option>
				<option value="oversea" {{ Request::segment(3) == 'oversea' ? 'selected' : '' }}>ต่างประเทศ</option>
				<option value="jp" {{ Request::segment(3) == 'jp' ? 'selected' : '' }}>ญุี่ปุ่น</option>
				<option value="tw" {{ Request::segment(3) == 'tw' ? 'selected' : '' }}>ไต้หวัน</option>
				<option value="id" {{ Request::segment(3) == 'id' ? 'selected' : '' }}>อินโดนีเซีย</option>
				{{-- <option value="othercountry" {{ Request::segment(3) == 'othercountry' ? 'selected' : '' }}>อื่นๆ</option> --}}
			</select>
		</div>
	</div>

	<div class="animate-box" data-animate-effect="fadeInLeft">
		<ul class="list-unstyled row">
		@foreach($emoji as $row)
			<li class="col-md-2 col-sm-3 col-4 mt-1 mb-1">
				@include('include.front.__product_item2', array('type'=>'emoji','row'=>$row))
			</li>
		@endforeach
		</ul>
		<div class="d-flex flex-wrap justify-content-around">{{ $emoji->appends(@$_GET)->render() }}</div>
	</div>
</div>

@endsection
