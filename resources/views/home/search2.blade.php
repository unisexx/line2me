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

				<a href="{{ url('sticker/'.$row->sticker_code) }}">
					<div class="sticker-image-cover">
						<img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
						{!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
					</div>
					<h3 class="fh5co-work-title">{{ $row->title_th }}</h3>
					<p>{{ ucfirst($row->country) }}, {{ convert_line_coin_2_money($row->price) }} บาท</p>
				</a>

			@elseif($type == 'theme')

				<a href="{{ url('theme/'.$row->id) }}">
					<img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
					<h3 class="fh5co-work-title">{{ $row->title }}</h3>
					<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
				</a>

			@elseif($type == 'emoji')

				<a href="{{ url('emoji/'.$row->id) }}">
					<img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
					<h3 class="fh5co-work-title">{{ $row->title }}</h3>
					<p>{{ ucfirst($row->country) }}, {{ $row->price }} บาท</p>
				</a>

			@endif

		</div>
		@endforeach
		<div class="clearfix visible-md-block"></div>
		{{ $search->appends(@$_GET)->render() }}
	</div>
</div>

@endsection
