@extends('layouts.front')

@section('content')
{{-- @include('include.front._auth_change_status', ['table' => 'stickers', 'var' => $rs]) --}}

<div class="fh5co-narrow-content">
    @include('include.front._breadcrumb')

    <div class="d-flex animate-box bg-white-faded p-3 rounded" data-animate-effect="fadeInLeft">

        <div class="sticker-image-cover">
            <img class="img-fluid playAnimate"
                src="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}"
                alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}"
                data-animation="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}">

            @if(in_array($rs->stickerresourcetype, ['SOUND','POPUP_SOUND','ANIMATION_SOUND']))
            <audio id="mainAudio" class="d-none" controls autoplay preload="metadata">
                <source
                    src="https://sdl-stickershop.line.naver.jp/stickershop/v1/product/{{ $rs->sticker_code }}/IOS/main_sound.m4a"
                    type="audio/mpeg">
            </audio>
            @endif
            {!! getStickerResourctTypeIcon($rs->stickerresourcetype) !!}
        </div>

        @include('include.front._sticker_infomation', ['type' => 'sticker', 'rs' => $rs])

    </div>

    <!-- ปุ่มสั่งซื้อ -->
    @include('include.front._add_line_btn')
    <!-- ปุ่มสั่งซื้อ -->

    @if ($rs->detail)
    <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
    @endif
    <p class="animate-box" data-animate-effect="fadeInLeft"><small> <a
                href="https://line.me/S/sticker/{{ $rs->sticker_code }}" target="_blank">*** </a>
            โปรดแตะที่ตัวสติ๊กเกอร์เพื่อดูตัวอย่าง
            หรือฟังเสียง (ถ้าเป็นสติ๊กเกอร์แบบมีเสียง) ***<br>S-{{ $rs->sticker_code }}</small>
    </p>

    <div class="animate-box" data-animate-effect="fadeInLeft">
        @if ($rs->stamp_start === null)

        <img class="img-fluid"
            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
            alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

        @else

        @php
        $stamp_count = $rs->stamp_end - $rs->stamp_start;
        @endphp

        <!-- ถ้าจำนวน stamp มากกว่า 40 แสดงว่ามี stamp ซ้อนกันกับชุดอื่น ให้แสดงเป็นรูปใหญ่แทน -->
        @if ($stamp_count > 40)

        <img class="img-fluid"
            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
            alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

        @else

        <ul class="list-inline">
            @for ($x = $rs->stamp_start; $x <= $rs->stamp_end; $x++)
                @php
                if (in_array($rs->stickerresourcetype, ['SOUND','STATIC','NAME_TEXT','PER_STICKER_TEXT'])) {
                $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $x .
                '/android/sticker.png;compress=true';
                } elseif (in_array($rs->stickerresourcetype, ['POPUP','POPUP_SOUND'])) {
                $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $x .
                '/IOS/sticker_popup.png;compress=true';
                } else {
                $data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $x .
                '/IOS/sticker_animation@2x.png;compress=true';
                }
                @endphp

                <li class="sticker-stamp-list">

                    <img class="sticker-stamp playAnimate"
                        src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $x }}/android/sticker.png;compress=true"
                        data-animation="{{ $data_animation }}">

                    @if(in_array($rs->stickerresourcetype, ['SOUND','POPUP_SOUND','ANIMATION_SOUND']))
                    <audio preload="metadata">
                        <source
                            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $x }}.m4a"
                            type="audio/mpeg">
                    </audio>
                    @endif
                </li>
                @endfor
        </ul>

        @endif

        @endif
    </div>

    @include('include.front._social_share')

</div>

@include('include.front._promote_section')
@include('include.front._last_seen')

@endsection