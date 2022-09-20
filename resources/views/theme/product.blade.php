@extends('layouts.front')

@section('content')
    @include('include.front._auth_change_status', ['table' => 'themes', 'var' => $rs])

    <div class="fh5co-narrow-content">
        @include('include.front._breadcrumb')

        <div class="d-flex animate-box bg-white-faded p-3 rounded" data-animate-effect="fadeInLeft">

            <div class="sticker-image-cover">
                <img class="img-fluid"
                    src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/WEBSTORE/icon_198x278.png"
                    alt="ธีมไลน์ {{ $rs->title }}">
            </div>

            @include('include.front._sticker_infomation', ['type' => 'theme', 'rs' => $rs])

        </div>

        <!-- ปุ่มสั่งซื้อ -->
        @include('include.front._add_line_btn')
        <!-- ปุ่มสั่งซื้อ -->

        @if ($rs->detail)
            <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
        @endif
        <p class="text-muted"><small><a href="https://line.me/S/shop/theme/detail?id={{ $rs->theme_code }}"
                    target="_blank">*** </a>บางส่วนของธีมอาจแสดงผลไม่ถูกต้องบน LINE
                เวอร์ชั่นที่คุณใช้อยู่ *** <br>T-{{ $rs->id }}</small></p>

        <div class="d-flex flex-xl-wrap flex-lg-nowrap animate-box theme-image-detail-wrap"
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

        @include('include.front._social_share')

    </div>

    @include('include.front._promote_section')
    @include('include.front._last_seen')
@endsection
