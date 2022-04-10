@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">ธีมไลน์ทางการ{{ Request::segment(3) == 'th' ? 'ไทย' : 'ต่างประเทศ' }}</h2>

	<div class="row mb-3">
		<div class="col">
			<select class="custom-select animate-box" data-animate-effect="fadeInLeft" onchange="location = '{{ Request::root() }}/theme/official/{{ Request::segment(3) }}/'+this.value;">
				<option value="top" {{ Request::segment(4) == 'top' ? 'selected' : '' }}>ฮิต</option>
				<option value="new" {{ Request::segment(4) == 'new' ? 'selected' : '' }}>ใหม่ล่าสุด</option>
			</select>
		</div>
	</div>

	<div class="animate-box" data-animate-effect="fadeInLeft">
		<ul class="list-unstyled row">
		@foreach($theme as $row)
			<li class="col-md-2 col-sm-3 col-4 mt-1 mb-1">
				@include('include.front.__product_item2', array('type'=>'theme','row'=>$row))
			</li>
		@endforeach
		</ul>
		<div class="d-flex flex-wrap justify-content-around">{{ $theme->appends(@$_GET)->render() }}</div>
	</div>
</div>

@endsection
