@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/search') }}">ค้นหา</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ request()->input('query') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <div class="text-center mb-4">ค้นหา</div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ url('/search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control form-control-lg me-2" placeholder="ค้นหาสติ๊กเกอร์..." value="{{ request()->input('query') }}">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 class="text-center mb-4">ผลลัพธ์การค้นหา: {{ request()->input('query') }}</h2>
        @if ($rs_sticker->isEmpty() && $rs_emoji->isEmpty() && $rs_theme->isEmpty())
            <p class="text-center">ไม่พบผลลัพธ์การค้นหาสำหรับคำว่า "{{ request()->input('query') }}"</p>
        @else
            @php
                $type = request()->input('type');
            @endphp

            @if (!$rs_sticker->isEmpty() && ($type === 'sticker' || is_null($type)))
                <h3 class="mt-5 mb-4">สติกเกอร์</h3>
                <div class="row">
                    @foreach ($rs_sticker as $sticker)
                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ get_sticker_img_url($sticker->stickerresourcetype, $sticker->version, $sticker->sticker_code) }}" class="card-img-top" alt="{{ $sticker->title_th }}">
                                    {!! getStickerResourctTypeIcon($sticker->stickerresourcetype) !!}
                                    <span class="position-absolute positionTopRight flag-icon fi fi-{{ $sticker->country }}"></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $sticker->title_th }}</h5>
                                    <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($sticker->price) }}</span> บาท</p>
                                    <a href="{{ url('sticker/' . $sticker->sticker_code) }}" class="btn btn-primary hidden-link">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add "ดูเพิ่มเติม" button or pagination links -->
                <div class="text-center mt-4">
                    @if ($type === 'sticker')
                        <div class="d-flex justify-content-center">
                            {{ $rs_sticker->appends(request()->except('page'))->links() }}
                        </div>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'sticker']) }}" class="btn btn-danger btn-more">ดูเพิ่มเติม</a>
                    @endif
                </div>
            @endif

            @if (!$rs_emoji->isEmpty() && ($type === 'emoji' || is_null($type)))
                <h3 class="mt-5 mb-4">อิโมจิ</h3>
                <div class="row">
                    @foreach ($rs_emoji as $item)
                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $item->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $item->title }}" class="card-img-top">
                                    <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                    <a href="{{ url('emoji/' . $item->emoji_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add "ดูเพิ่มเติม" button or pagination links -->
                <div class="text-center mt-4">
                    @if ($type === 'emoji')
                        <div class="d-flex justify-content-center">
                            {{ $rs_emoji->appends(request()->except('page'))->links() }}
                        </div>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'emoji']) }}" class="btn btn-danger btn-more">ดูเพิ่มเติม</a>
                    @endif
                </div>
            @endif

            @if (!$rs_theme->isEmpty() && ($type === 'theme' || is_null($type)))
                <h3 class="mt-5 mb-4">ธีม</h3>
                <div class="row">
                    @foreach ($rs_theme as $item)
                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <img src="{{ generateThemeUrl($item->theme_code, @$item->section) }}" alt="ธีมไลน์ {{ $item->title }}" class="card-img-top">
                                    <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                    <a href="{{ url('theme/' . $item->id) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add "ดูเพิ่มเติม" button or pagination links -->
                <div class="text-center mt-4 mb-4">
                    @if ($type === 'theme')
                        <div class="d-flex justify-content-center">
                            {{ $rs_theme->appends(request()->except('page'))->links() }}
                        </div>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['type' => 'theme']) }}" class="btn btn-danger btn-more">ดูเพิ่มเติม</a>
                    @endif
                </div>
            @endif
        @endif
    </div>
@endsection
