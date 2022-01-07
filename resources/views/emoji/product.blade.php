@extends('layouts.front')

@section('content')
{{-- @include('include.front._auth_change_status', ['table' => 'emojis', 'var' => $rs]) --}}

<div class="fh5co-narrow-content">
    @include('include.front._breadcrumb')

    <div class="d-flex animate-box bg-white-faded p-3 rounded" data-animate-effect="fadeInLeft">

        <div class="sticker-image-cover">
            <img class="img-fluid"
                src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $rs->emoji_code }}/iphone/main.png"
                alt="อิโมจิไลน์ {{ $rs->title }}">
        </div>

        @include('include.front._sticker_infomation', ['type' => 'emoji', 'rs' => $rs])

    </div>

    <!-- ปุ่มสั่งซื้อ -->
    @include('include.front._add_line_btn')
    <!-- ปุ่มสั่งซื้อ -->

    @if ($rs->detail) <p class="sticker-detail animate-box" data-animate-effect="fadeInLeft">{{ $rs->detail }}</p>
    @endif
    <p><small><a href="https://line.me/S/emoji/?id={{ $rs->emoji_code }}&ref=gnsh_sticonDetail" target="_blank">E-{{
                $rs->id }}
            </a></small></p>

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