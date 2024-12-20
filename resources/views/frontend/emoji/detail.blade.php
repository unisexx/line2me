@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/emojis') }}">อิโมจิไลน์</a></li>
                @if ($rs->category == 'official')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/official') }}">อิโมจิไลน์ทางการ</a></li>
                @elseif($rs->category == 'creator')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/creator') }}">อิโมจิไลน์ครีเอเตอร์</a></li>
                @endif

                @if ($rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/' . $rs->category . '/th') }}">อิโมจิไลน์ไทย</a></li>
                @elseif($rs->country == 'oversea')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/' . $rs->category . '/oversea') }}">อิโมจิไลน์น์ต่างประเทศ</a></li>
                @elseif($rs->country == 'jp')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/' . $rs->category . '/jp') }}">อิโมจิไลน์ญี่ปุ่น</a></li>
                @elseif($rs->country == 'tw')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/' . $rs->category . '/tw') }}">อิโมจิไลน์ไต้หวัน</a></li>
                @elseif($rs->country == 'id')
                    <li class="breadcrumb-item"><a href="{{ url('/emojis/' . $rs->category . '/id') }}">อิโมจิไลน์อินโดนีเซีย</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $rs->title }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 mx-auto">
                <div class="d-flex align-items-start {{ new_icon($rs->created_at) }}">
                    <!-- Left Image Column -->
                    <div class="me-3 fixed-width-240">
                        <img class="product-cover-img" src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $rs->title }}">
                    </div>
                    <!-- Right Content Column -->
                    <div class="w-100">
                        <h3>{{ @$rs->title }}</h3>
                        <p class="d-none d-md-block">{{ @$rs->detail }}</p>
                        <p class="mb-1 d-inline">
                            <strong><a class="no-style" rel="nofollow" href="https://line.me/S/emoji/?id={{ $rs->emoji_code }}" target="_blank">ร</a>หัสสินค้า: </strong> e-{{ @$rs->id }}
                        </p>
                        <!-- Include ปุ่ม Copy Link -->
                        @include('frontend._inc._copy_link')
                        <p class="mb-1"><strong>ประเทศ: </strong> <span class="fi fi-{{ $rs->country }}"></span></p>
                        <h4>Price: <span class="text-danger">{{ convert_line_coin_2_money($rs->price) }}</span>THB</h4>
                        <a href="https://line.me/ti/p/~ratasak1234" target="_blank" class="btn custom-btn-blue btn-primary d-none d-md-block">สั่งซื้อชุดนี้แอดไลน์ไอดี ratasak1234</a>
                    </div>
                </div>
                <div class="w-100 mt-3 d-md-none">
                    <a href="https://line.me/ti/p/~ratasak1234" target="_blank" class="w-100 btn custom-btn-blue btn-primary">สั่งซื้อชุดนี้แอดไลน์ไอดี ratasak1234</a>
                </div>
                <hr class="custom-hr">
                <div class="w-100 d-md-none">
                    <p>{{ @$rs->detail }}</p>
                </div>
                <div class="row mt-4">
                    @for ($x = 1; $x <= 50; $x++)
                        <div class="col-2 col-md-2 text-center mb-3">
                            <img class="img-fluid" src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/{{ $rs->emoji_code }}/iphone/{{ sprintf('%03d', $x) }}.png" alt="อิโมจิไลน์ {{ $rs->title }}" onerror="this.style.display='none'" role="button">
                        </div>
                    @endfor
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-lg-4 border-start">
                @include('frontend._partials.sidebar')
            </div>
        </div>
        <hr>
    </div>

    {{-- หมวดหมู่ --}}
    @include('frontend._inc._category')

    <hr>
    <!-- สติกเกอร์ขายดี Section -->
    <section class="categories">
        @include('frontend._inc._sticker-grid-promote', [
            'title' => 'สติกเกอร์ไลน์ขายดี',
            'stickers' => $sticker_promote,
            // 'seeMoreUrl' => url('/series/24'),
            // 'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    {{-- ประวัติการเข้าชม --}}
    @include('frontend._partials.view_history')
@endsection
