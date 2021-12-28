@extends('layouts.front')

@section('content')
{{-- @include('include.front._auth_change_status', ['table' => 'emojis', 'var' => $rs]) --}}

<div class="fh5co-narrow-content">
    @include('include.front._breadcrumb')

    <div class="d-flex animate-box" data-animate-effect="fadeInLeft">

        <div class="sticker-image-cover">
            <img class="img-fluid"
                src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png"
                alt="อิโมจิไลน์ {{ $rs->title }}">
        </div>

        <div class="sticker-infomation">
            <h3>{{ $rs->title }}</h3>
            <ul>
                <li>รหัสสินค้า : E-{{ $rs->id }}</li>
                <li>ราคา : {{ convert_line_coin_2_money($rs->price) }} บาท</li>
                <li>ประเภท : {{ $rs->category }}</li>
                <li>ประเทศ : {{ @countryName($rs->country) }}</li>
                @if ($rs->status == 0)
                <li>สถานะ : <span class="badge badge-danger">ไม่สามารถซื้อได้เนื่องจากหมดเวลาจำหน่าย</span></li>
                @endif
            </ul>
        </div>

    </div>

    <!-- ปุ่มสั่งซื้อ -->
    @include('include.front._add_line_btn')
    <!-- ปุ่มสั่งซื้อ -->

    @if ($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
    @endif
    <p><small><a href="https://line.me/S/emoji/?id={{ $rs->emoji_code }}&ref=gnsh_sticonDetail" target="_blank">***
            </a> รหัสสินค้า : E-{{ $rs->id }}</small></p>

    <div class="animate-box" data-animate-effect="fadeInLeft">

        @for ($x = 1; $x
        <= 50; $x++) <img class="img-emoji"
            src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/{{ $rs->emoji_code }}/iphone/{{ sprintf('%03d', $x) }}.png"
            alt="อิโมจิไลน์ {{ $rs->title }}" onerror="this.style.display='none'" />
        @endfor

    </div>

    @include('include.front._social_share')

</div>

@include('include.front._promote_section')
@include('include.front._last_seen')
@endsection