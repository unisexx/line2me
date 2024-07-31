@extends('layouts.front2024')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-10 mx-auto" style="border: 30px solid #ffc107; position:relative;">
                <img src="{{ asset('image/ratasak1234.jpg') }}" style="position: absolute; right:10px; top:10px; width:180px;">
                <div class="d-flex align-items-start {{-- new_icon($rs->created_at) --}}">
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
                        <p class="mb-1"><strong><a class="no-style" rel="nofollow" href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank">รหัสสินค้า: </a></strong> S-{{ @$rs->sticker_code }}</span></p>
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
                        @php
                            $stamp_count = $rs->stamp_end - $rs->stamp_start + 1;
                            $half_count = ceil($stamp_count / 2);
                        @endphp
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = 0; $i < $half_count; $i++)
                                    @php
                                        $item = $rs->stamp_start + $i;
                                        if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                        } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                        } else {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                        }
                                    @endphp
                                    <div class="col-4 text-center mb-3">
                                        <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                        @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                            <audio preload="metadata">
                                                <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                            </audio>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = $half_count; $i < $stamp_count; $i++)
                                    @php
                                        $item = $rs->stamp_start + $i;
                                        if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                        } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                        } else {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                        }
                                    @endphp
                                    <div class="col-4 text-center mb-3">
                                        <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                        @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                            <audio preload="metadata">
                                                <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                            </audio>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @elseif (!empty($rs->stamp_start))
                        @php
                            $stamp_count = $rs->stamp_end - $rs->stamp_start + 1;
                            $half_count = ceil($stamp_count / 2);
                        @endphp
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = 0; $i < $half_count; $i++)
                                    @php
                                        $item = $rs->stamp_start + $i;
                                        if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                        } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                        } else {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                        }
                                    @endphp
                                    <div class="col-4 text-center mb-3">
                                        <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                        @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                            <audio preload="metadata">
                                                <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                            </audio>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = $half_count; $i < $stamp_count; $i++)
                                    @php
                                        $item = $rs->stamp_start + $i;
                                        if (in_array($rs->stickerresourcetype, ['SOUND', 'STATIC', 'NAME_TEXT', 'PER_STICKER_TEXT'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/android/sticker.png;compress=true';
                                        } elseif (in_array($rs->stickerresourcetype, ['POPUP', 'POPUP_SOUND'])) {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_popup.png;compress=true';
                                        } else {
                                            $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item . '/IOS/sticker_animation@2x.png;compress=true';
                                        }
                                    @endphp
                                    <div class="col-4 text-center mb-3">
                                        <img class="sticker-stamp playAnimate img-fluid" src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true" data-animation="{{ $data_animation }}" role="button">
                                        @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
                                            <audio preload="metadata">
                                                <source src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a" type="audio/mpeg">
                                            </audio>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @else
                        <img class="img-fluid" src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png" alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
                    @endif
                </div>
            </div>
        </div>
        <hr>
    </div>

    <div class="container mt-5">
        <div class="row">
            <textarea class="form-control" rows="10">แนะนำสติกเกอร์ไลน์ยอดนิยม 
        .
        {{ $rs->title_th }}
        {{ $rs->detail }}
        .
        สามารถดูลายสติ๊กเกอร์ได้ที่ 
        http://www.line2me.in.th/sticker/{{ $rs->sticker_code }}
        .
        หากเพื่อนๆคนไหนสนใจทักเข้ามาได้เลยครับที่ไลน์ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
        http://line.me/ti/p/~ratasak1234
        .
        ขอบคุณมากครับ ^^
        .
        ===== สติ๊กเกอร์ไลน์ขายดีแนะนำ =====
        https://line2me.in.th/series/24
        .
        ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS
        #line2me #ของแท้ไม่มีหาย #LVS0157</textarea>
        </div>
    </div>
@endsection
