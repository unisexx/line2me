@extends('layouts.front')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<!-- <span class="more pull-right">
					<a href="{{ url('sticker') }}">ดูเพิ่มเติม ></a>
				</span> -->
				<h2 class="box-title"><span class="text-green">{{ $sticker[0]->head_credit }}</span> สติ๊กเกอร์ไลน์ {{ $sticker->count() }} รายการ</h2>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@foreach($sticker as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ url('sticker/'.$row->slug) }}">
								<div class="img-cover">
									<img class="img-responsive" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png"> @if($row->stickerresourcetype == 'ANIMATION')
									<span class="MdIcoPlay_m">Animation only icon</span>
									@endif
								</div>
								<h3>{{ $row->name }}</h3>
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-default">
			<div class="box-header with-border">
				<!-- <span class="more pull-right">
					<a href="{{ url('theme') }}">ดูเพิ่มเติม ></a>
				</span> -->
				<h2 class="box-title"><span class="text-green">{{ $sticker[0]->head_credit }}</span> ธีมไลน์ {{ $theme->count() }} รายการ</h2>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				@foreach($theme as $row)
				<div class="col-xs-4 col-sm-3 col-md-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<a href="{{ url('theme/'.$row->slug) }}">
								<div>
									<img class="img-responsive" src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png">
								</div>
								<h3>{{ $row->name }}</h3>
							</a>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection