@extends('layouts.front')

@section('content')
    {{-- @include('include.front._auth_change_status', ['table' => 'themes', 'var' => $rs]) --}}

    <div class="fh5co-narrow-content border-gradient border-gradient-blue">

        <div class="infoBlock d-flex animate-box bg-white-faded pt-3 px-3 rounded" data-animate-effect="fadeInLeft">

            <div class="sticker-image-cover">
                <img class=""
                    src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png"
                    alt="ธีมไลน์ {{ $rs->title }}" height="255">
            </div>

            @include('include.front._sticker_infomation', ['type' => 'theme', 'rs' => $rs])

        </div>

        <!-- ปุ่มสั่งซื้อ -->
        {{-- @include('include.front._add_line_btn') --}}
        <!-- ปุ่มสั่งซื้อ -->

        {{-- @if ($rs->detail)
            <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
        @endif
        <p class="text-muted"><small><a href="https://line.me/S/shop/theme/detail?id={{ $rs->theme_code }}"
                    target="_blank">*** </a>บางส่วนของธีมอาจแสดงผลไม่ถูกต้องบน LINE
                เวอร์ชั่นที่คุณใช้อยู่ *** <br>T-{{ $rs->id }}</small></p> --}}

        <div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap justify-content-between"
            data-animate-effect="fadeInLeft">
            @for ($x = 2; $x <= 5; $x++)
                <a href="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png"
                    class="venobox" data-gall="themeDetail" title="ธีมไลน์ {{ $rs->title }}">
                    <img class="align-self-baseline theme-image-detail"
                        src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_00{{ $x }}_720x1232.png"
                        alt="ธีมไลน์ {{ $rs->title }}">
                </a>
            @endfor
        </div>

        {{-- @include('include.front._social_share') --}}

    </div>

    {{-- @include('include.front._promote_section')
    @include('include.front._last_seen') --}}
@endsection

@push('css')
    <style>
        body #fh5co-main {
            /* background-image: none; */
        }

        .fh5co-narrow-content:first-child {
            display: none;
        }

        #fh5co-main .fh5co-narrow-content {
            width: 100% !important;
            padding: 0px !important;
        }

        body .sticker-stamp {
            max-width: 231px;
        }

        @media only screen and (min-width: 1224px) {
            #fh5co-main {
                width: 100% !important;
            }
        }

        .sticker-infomation>h3 {
            font-size: 50px;
            margin-left: 10px;
        }

        /* .sticker-infomation li {
                                                                    font-size: 27px;
                                                                } */

        /* body .animate-box:first-child {
                                                                        border-bottom: 15px solid #48D0F2;
                                                                    } */

        .border-gradient {
            border: 10px solid;
            border-image-slice: 1;
            border-width: 25px;
        }

        .border-gradient-green {
            border-image-source: linear-gradient(to left, #00C853, #B2FF59);
        }

        .border-gradient-blue {
            border-image-source: linear-gradient(to left, #B2EDFB, #48D0F2);
        }

        .border-gradient-shopee {
            border-image-source: linear-gradient(to left, #0144AD, #EE4D2D);
        }

        body .theme-image-detail {
            width: 440px !important;
        }

        .infoBlock {
            height: 287px;
        }

        .theme-image-detail-wrap {
            height: 743px;
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
