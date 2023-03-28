@extends('layouts.front')

@section('content')
    {{-- @include('include.front._auth_change_status', ['table' => 'stickers', 'var' => $rs]) --}}

    <div class="fh5co-narrow-content border-gradient border-gradient-blue">

        <div class="infoBlock d-flex justify-content-start animate-box bg-white-faded px-3" data-animate-effect="fadeInLeft">

            <div class="sticker-image-cover">
                <img class="playAnimate"
                    src="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}"
                    alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}"
                    data-animation="{{ get_sticker_img_url($rs->stickerresourcetype, $rs->version, $rs->sticker_code) }}">

                @if (in_array($rs->stickerresourcetype, ['SOUND', 'POPUP_SOUND', 'ANIMATION_SOUND']))
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

        {{-- @if ($rs->detail)
    <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
    @endif --}}

        <div class="animate-box" data-animate-effect="fadeInLeft">
            @if (!empty($rs->stamp))
                {{-- @dd($rs->stamp) --}}
                <ul class="list-inline">
                    @foreach ($rs->stamp as $item)
                        @include('sticker._sticker_item')
                    @endforeach
                </ul>
            @elseif (!empty($rs->stamp_start))
                <?php
                $stamp_count = $rs->stamp_end - $rs->stamp_start;
                ?>
                @if ($stamp_count > 40)
                    <img class="img-fluid"
                        src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
                        alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
                @else
                    <ul class="list-inline">
                        @for ($item = $rs->stamp_start; $item <= $rs->stamp_end; $item++)
                            @include('sticker._sticker_item')
                        @endfor
                    </ul>
                @endif
            @else
                <img class="img-fluid"
                    src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/LINEStorePC/preview.png"
                    alt="สติ๊กเกอร์ไลน์ {{ $rs->title_th }}">
            @endif
        </div>

    </div>

@endsection

@push('css')
    <style>
        body {
            /* background-image: none; */
            /* border: 1px solid rgb(209, 209, 209); */
            width: 864px;
            height: 1702px;
        }

        .fh5co-narrow-content:first-child {
            display: none;
        }

        #fh5co-main .fh5co-narrow-content {
            width: 100% !important;
            padding: 0px !important;
        }

        body .sticker-stamp {
            margin: 4px 5px;
            max-width: 162px;
            max-height: 183px;
        }

        @media only screen and (min-width: 1224px) {
            #fh5co-main {
                width: 100% !important;
            }
        }

        .sticker-infomation>h1 {
            font-size: 55px;
            margin-left: 10px;
        }

        body .animate-box:first-child {
            /* border-bottom: 15px solid #48D0F2; */
        }

        .border-gradient-green {
            border-image-source: linear-gradient(to left, #00C853, #B2FF59);
        }

        .border-gradient-shopee {
            border-image-source: linear-gradient(to left, #0144AD, #EE4D2D);
        }

        body #fh5co-main {
            background: url('/image/bg/above_clouds-min.png');
            background-repeat: no-repeat;
            /* background-size: contain; */
            background-position: top center;
            width: 100% !important;
        }

        ul.list-inline {
            /* height: 727px; */
        }

        .infoBlock {
            /* height: 287px; */
        }

        h3 {
            font-size: 30px !important;
        }

        .sticker-infomation ul {
            /* display: none; */
        }
    </style>
@endpush

@push('js')
    <script>
        $(function() {
            $('body #fh5co-aside').remove();
        })
    </script>
@endpush
