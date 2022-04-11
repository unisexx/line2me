@extends('layouts.front')

@section('content')
{{-- @include('include.front._auth_change_status', ['table' => 'stickers', 'var' => $rs]) --}}

<div class="fh5co-narrow-content border-gradient border-gradient-shopee">

    <div class="d-flex justify-content-center animate-box bg-white-faded p-3" data-animate-effect="fadeInLeft">

        <div class="sticker-image-cover">
            <img class="playAnimate"
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

        @if (!empty($rs->id))
        <div class="sticker-infomation">
            <h1>{{ $rs->title_th }} {{ getStickerResourctTypeName($rs->stickerresourcetype) }}</h1>
            @php
            $a = ['sticker'=>'S', 'theme'=>'T', 'emoji'=>'E']
            @endphp
            <ul>
                <li>
                    <h2>รหัสสินค้า : S-{{ $rs->sticker_code }}</h2>
                </li>
                <li>
                    <h2>ราคา : {{ convert_line_coin_2_money_full($rs->price) }} บาท</h2>
                </li>
            </ul>
        </div>
        @endif

    </div>

    {{-- @if ($rs->detail)
    <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
    @endif --}}

    <div class="animate-box" data-animate-effect="fadeInLeft" style="position: relative;">
        <img src="{{ asset('image/Template.png') }}"
            style="position: absolute; right: -25px; bottom: -40px; width: 600px;">

        @if ($rs->stamp_start === null)

        <img class="img-fluid"
            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
            alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

        @else

        @php
        $stamp_count = $rs->stamp_end - $rs->stamp_start;
        @endphp

        <!-- ถ้าจำนวน stamp มากกว่า 40 แสดงว่ามี stamp ซ้อนกันกับชุดอื่น ให้แสดงเป็นรูปใหญ่แทน -->
        {{-- @if ($stamp_count > 40)

        <img class="img-fluid"
            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
            alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">

        @else --}}

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

        {{-- @endif --}}

        @endif
    </div>

</div>

@endsection

@push('css')
<style>
    body #fh5co-main {
        background-image: none;
    }

    .fh5co-narrow-content:first-child {
        display: none;
    }

    #fh5co-main .fh5co-narrow-content {
        width: 98% !important;
        padding: 0px !important;
    }

    body .sticker-stamp {
        max-width: 226px;
    }

    @media only screen and (min-width: 1224px) {
        #fh5co-main {
            width: 100% !important;
        }
    }

    .sticker-infomation>h1 {
        font-size: 80px;
        margin-left: 10px;
    }

    body .animate-box:first-child {
        border-bottom: 15px solid #EE4D2D;
    }

    .border-gradient {
        border: 10px solid;
        border-image-slice: 1;
        border-width: 25px;
    }

    .border-gradient-green {
        border-image-source: linear-gradient(to left, #00C853, #B2FF59);
    }

    .border-gradient-shopee {
        border-image-source: linear-gradient(to left, #0144AD, #EE4D2D);
    }
</style>
@endpush

@push('js')
<script>
    $(function(){
        $('body #fh5co-aside').remove();
    })
</script>
@endpush