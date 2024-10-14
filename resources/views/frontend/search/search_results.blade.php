@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/search') }}">ค้นหา</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ request()->input('query') }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <div class="text-center mb-4">ค้นหา</div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ url('/search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control form-control-lg me-2" placeholder="ค้นหาสติ๊กเกอร์..." value="{{ request()->input('query') }}">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 class="text-center mb-4">ผลลัพธ์การค้นหา: {{ request()->input('query') }}</h2>
        @if ($rs_sticker->isEmpty() && $rs_emoji->isEmpty() && $rs_theme->isEmpty())
            <p class="text-center">ไม่พบผลลัพธ์การค้นหาสำหรับคำว่า "{{ request()->input('query') }}"</p>
        @else
            @php
                $type = request()->input('type');
            @endphp

            @if (!$rs_sticker->isEmpty() && ($type === 'sticker' || is_null($type)))
                <section class="categories">
                    @include('frontend._inc._sticker-grid', [
                        'title' => 'สติกเกอร์ไลน์',
                        'stickers' => $rs_sticker,
                        'seeMoreUrl' => request()->fullUrlWithQuery(['type' => 'sticker']),
                        'seeMoreText' => 'ดูเพิ่มเติม',
                    ])
                </section>
            @endif

            @if (!$rs_emoji->isEmpty() && ($type === 'emoji' || is_null($type)))
                <!-- อิโมจิทางการไทย Section -->
                <section class="categories">
                    @include('frontend._inc._emoji-grid', [
                        'title' => 'อิโมจิไลน์',
                        'emojis' => $rs_emoji,
                        'seeMoreUrl' => request()->fullUrlWithQuery(['type' => 'emoji']),
                        'seeMoreText' => 'ดูเพิ่มเติม',
                    ])
                </section>
            @endif

            @if (!$rs_theme->isEmpty() && ($type === 'theme' || is_null($type)))
                <section class="categories">
                    @include('frontend._inc._theme-grid', [
                        'title' => 'ธีมไลน์',
                        'themes' => $rs_theme,
                        'seeMoreUrl' => request()->fullUrlWithQuery(['type' => 'theme']),
                        'seeMoreText' => 'ดูเพิ่มเติม',
                    ])
                </section>
            @endif
        @endif
    </div>
@endsection
