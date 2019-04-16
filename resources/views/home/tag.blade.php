@extends('layouts.front')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
			<h2 class="box-title">สติ๊กเกอร์ไลน์ตาม คำพูด ความรู้สึก : "{{ $tag }}"</h2>
			<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body" style="display: flex; flex-wrap: wrap;">
			@foreach($stamp as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
						<a href="{{ url('sticker/'.$row->sticker->slug) }}">
							<div class="img-cover">
								<img class="img-responsive" src="https://stickershop.line-scdn.net/stickershop/v{{ $row->version }}/sticker/{{ $row->stamp_code }}/android/sticker.png;compress=true" width="124" height="124">
							</div>
							<h3>{{ $row->sticker->name }}</h3>
						</a>
						</div>
					</div>
				</div>
			@endforeach
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-center">
			{{-- $stamp->appends(@$_GET)->render() --}}
			</div>
			<!-- /.box-footer -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection