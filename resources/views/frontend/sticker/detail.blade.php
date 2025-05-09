@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/stickers') }}">สติกเกอร์ไลน์</a></li>
                @if ($rs->category == 'official')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/official') }}">สติกเกอร์ไลน์ทางการ</a></li>
                @elseif($rs->category == 'creator')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/creator') }}">สติกเกอร์ไลน์ครีเอเตอร์</a></li>
                @endif

                @if ($rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/' . $rs->category . '/th') }}">สติกเกอร์ไลน์ไทย</a></li>
                @elseif($rs->country == 'oversea')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/' . $rs->category . '/oversea') }}">สติกเกอร์ไลน์ต่างประเทศ</a></li>
                @elseif($rs->country == 'jp')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/' . $rs->category . '/jp') }}">สติกเกอร์ไลน์ญี่ปุ่น</a></li>
                @elseif($rs->country == 'tw')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/' . $rs->category . '/tw') }}">สติกเกอร์ไลน์ไต้หวัน</a></li>
                @elseif($rs->country == 'id')
                    <li class="breadcrumb-item"><a href="{{ url('/stickers/' . $rs->category . '/id') }}">สติกเกอร์ไลน์อินโดนีเซีย</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $rs->title_th }}</li>
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
                    <div class="me-3 position-relative">
                        <img class="product-cover-img animated-sticker" src="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}" data-animation="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}">

                        @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                            <audio id="mainAudio" class="d-none" controls autoplay preload="metadata">
                                <source src="https://sdl-stickershop.line.naver.jp/stickershop/v1/product/{{ $rs->sticker_code }}/IOS/main_sound.m4a" type="audio/mpeg">
                            </audio>
                        @endif

                        {!! getStickerResourctTypeIcon($rs->stickerresourcetype) !!}
                    </div>
                    <!-- Right Content Column -->
                    <div class="w-100">
                        <h3>{{ @$rs->title_th }}</h3>
                        <p class="d-none d-md-block">{{ @$rs->detail }}</p>
                        <p class="mb-1 d-inline">
                            <strong><a class="no-style" rel="nofollow" href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank">ร</a>หัสสินค้า: </strong> S-{{ @$rs->sticker_code }}
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
                    @if (!empty($rs->stamp))
                        @foreach ($rs->stamp as $item)
                            @php
                                if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                    $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                    $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                } else {
                                    $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                }
                            @endphp
                            <div class="col-3 col-md-3 text-center mb-3 no-padding">
                                <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                    <audio preload="metadata">
                                        <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                    </audio>
                                @endif
                            </div>
                        @endforeach
                    @elseif (!empty($rs->stamp_start))
                        @php
                            $stamp_count = $rs->stamp_end - $rs->stamp_start;
                        @endphp
                        @if ($stamp_count > 40)
                            <img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
                        @else
                            @for ($item = $rs->stamp_start; $item <= $rs->stamp_end; $item++)
                                @php
                                    if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                        $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                    } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                        $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                    } else {
                                        $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                    }
                                @endphp
                                <div class="col-3 col-md-3 text-center mb-3 no-padding">
                                    <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                    @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                        <audio preload="metadata">
                                            <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                        </audio>
                                    @endif
                                </div>
                            @endfor
                        @endif
                    @else
                        <img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
                    @endif
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
