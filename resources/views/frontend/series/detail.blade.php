@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/series') }}">รวมชุดแนะนำ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $rs->title }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <h2 class="mb-2">{{ $rs->title }}</h2>
        {!! @!empty($rs->sub_title) ? '<p>' . $rs->sub_title . '</p>' : '' !!}

        @if ($series_items->where('product_type', 'sticker')->count() > 0)
            <h3 class="text-center mb-4 mt-5">สติกเกอร์ไลน์</h3>
            <div class="row">
                @foreach ($series_items->where('product_type', 'sticker') as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="{{ get_sticker_img_url($item->sticker->stickerresourcetype, $item->sticker->version, $item->sticker->sticker_code) }}" class="card-img-top animated-sticker img-fluid" alt="{{ $item->sticker->title_th }}">
                                {!! getStickerResourctTypeIcon($item->sticker->stickerresourcetype) !!}
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->sticker->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->sticker->title_th }}</h5>
                                <p class="card-text">{{ $item->sticker->description }}</p>
                                <a href="{{ url('sticker/' . $item->sticker->sticker_code) }}" class="btn btn-primary hidden-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($series_items->where('product_type', 'emoji')->count() > 0)
            <h3 class="text-center mb-4 mt-5">อิโมจิไลน์</h3>
            <div class="row">
                @foreach ($series_items->where('product_type', 'emoji') as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $item->emoji->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $item->emoji->title }}" class="card-img-top">
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->emoji->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->emoji->title }}</h5>
                                <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->emoji->price) }}</span> บาท</p>
                                <a href="{{ url('emoji/' . $item->emoji->emoji_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($series_items->where('product_type', 'theme')->count() > 0)
            <h3 class="text-center mb-4 mt-5">ธีมไลน์</h3>
            <div class="row">
                @foreach ($series_items->where('product_type', 'theme') as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="{{ generateThemeUrl($item->theme->theme_code, @$item->theme->section) }}" alt="ธีมไลน์ {{ $item->theme->title }}" class="card-img-top">
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->theme->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->theme->title }}</h5>
                                <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->theme->price) }}</span> บาท</p>
                                <a href="{{ url('theme/' . $item->theme->id) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="d-flex flex-wrap justify-content-around">{{ $series_items->appends(@$_GET)->render() }}</div>

    <!-- Popular Products Section -->
    <section class="products" id="series">
        <div class="container">
            <h2 class="text-center mb-4">แนะนำจากทางร้าน</h2>
            <div class="row">
                @foreach ($serie_promote as $row)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="col pl-2 pr-2">
                            <a href="{{ url('series/' . $row->id) }}">
                                <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
