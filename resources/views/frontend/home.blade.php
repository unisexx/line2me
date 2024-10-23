@extends('layouts.front2024')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <img src="{{ asset('image/hero.png') }}" alt="Hero Image">
            <h1 class="display-4">Welcome to line2me Stickers Shop</h1>
            <p class="lead">ขายสติกเกอร์ไลน์ของแท้ ไม่หมดอายุ มีเครดิตเชื่อถือได้100% เป็นร้านค้าที่ได้รับอนุญาตอย่างเป็นทางการจากทางไลน์ (Verified Resellers) เปิดร้านขายมากว่า 12 ปีแล้วจ้า~ <img class="animated-sticker" src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/64817945b74fae74142e71c2/iPhone/031_animation.png?1717424106504" width="50px"><img class="animated-sticker"
                    src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/64817945b74fae74142e71c2/iPhone/036_animation.png?1717424106504" width="50px"></p>
            {{-- <a href="https://line.me/ti/p/~ratasak1234" class="btn btn-primary btn-lg">แอดไลน์ไอดี ratasak1234</a> --}}
            <a href="https://line.me/ti/p/~ratasak1234" class="btn custom-btn-blue btn-lg btn-primary" target="_blank">แอดไลน์ไอดี ratasak1234</a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories wow animate__animated animate__flipInX" id="search">
        <div class="container">
            <h2 class="text-center mb-4">ค้นหา</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ url('/search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control form-control-lg me-2" placeholder="ค้นหาสติกเกอร์...">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

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

    <!-- สติ๊กเกอร์ไลน์อัพเดทประจำสัปดาห์ Section -->
    @if (!empty($sticker_update) && count($sticker_update) > 0)
        <section class="categories">
            @include('frontend._inc._sticker-grid', [
                'title' => 'สติ๊กเกอร์ไลน์อัพเดทประจำสัปดาห์',
                'stickers' => $sticker_update,
                'seeMoreUrl' => url('/stickers/official/th/new'),
                'seeMoreText' => 'ดูเพิ่มเติม',
            ])
        </section>
        <hr>
    @endif

    <!-- ธีมไลน์อัพเดทประจำสัปดาห์ Section -->
    @if (!empty($theme_update) && count($theme_update) > 0)
        <section class="categories">
            @include('frontend._inc._theme-grid', [
                'title' => 'ธีมไลน์อัพเดทประจำสัปดาห์',
                'themes' => $theme_update,
                'seeMoreUrl' => url('themes/new'),
                'seeMoreText' => 'ดูเพิ่มเติม',
            ])
        </section>
        <hr>
    @endif


    <!-- อิโมจิไลน์อัพเดทประจำสัปดาห์ Section -->
    @if (!empty($emoji_update) && count($emoji_update) > 0)
        <section class="categories">
            @include('frontend._inc._emoji-grid', [
                'title' => 'อิโมจิไลน์อัพเดทประจำสัปดาห์',
                'emojis' => $emoji_update,
                'seeMoreUrl' => url('emojis/new'),
                'seeMoreText' => 'ดูเพิ่มเติม',
            ])
        </section>
        <hr>
    @endif


    <!-- สติกเกอร์ทางการไทย Section -->
    <section class="categories">
        @include('frontend._inc._sticker-grid', [
            'title' => 'สติกเกอร์ไลน์ทางการไทย',
            'stickers' => $sticker_official_thai,
            'seeMoreUrl' => url('/stickers/official/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- สติกเกอร์ทางการต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._sticker-grid', [
            'title' => 'สติกเกอร์ไลน์ทางการต่างประเทศ',
            'stickers' => $sticker_official_oversea,
            'seeMoreUrl' => url('/stickers/official/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- สติกเกอร์ครีเอเตอร์ไทย Section -->
    <section class="categories">
        @include('frontend._inc._sticker-grid', [
            'title' => 'สติกเกอร์ไลน์ครีเอเตอร์ไทย',
            'stickers' => $sticker_creator,
            'seeMoreUrl' => url('/stickers/creator/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- สติกเกอร์ครีเอเตอร์ต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._sticker-grid', [
            'title' => 'สติกเกอร์ไลน์ครีเอเตอร์ต่างประเทศ',
            'stickers' => $sticker_creator_oversea,
            'seeMoreUrl' => url('/stickers/creator/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- อิโมจิทางการไทย Section -->
    <section class="categories">
        @include('frontend._inc._emoji-grid', [
            'title' => 'อิโมจิไลน์ทางการไทย',
            'emojis' => $emoji_official_thai,
            'seeMoreUrl' => url('/emojis/official/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- อิโมจิทางการต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._emoji-grid', [
            'title' => 'อิโมจิไลน์ทางการต่างประเทศ',
            'emojis' => $emoji_official_oversea,
            'seeMoreUrl' => url('/emojis/official/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- อิโมจิครีเอเตอร์ไทย Section -->
    <section class="categories">
        @include('frontend._inc._emoji-grid', [
            'title' => 'อิโมจิไลน์ครีเอเตอร์ไทย',
            'emojis' => $emoji_creator,
            'seeMoreUrl' => url('/emojis/creator/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- อิโมจิครีเอเตอร์ต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._emoji-grid', [
            'title' => 'อิโมจิไลน์ครีเอเตอร์ต่างประเทศ',
            'emojis' => $emoji_creator_oversea,
            'seeMoreUrl' => url('/emojis/creator/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- ธีมทางการไทย Section -->
    <section class="categories">
        @include('frontend._inc._theme-grid', [
            'title' => 'ธีมไลน์ทางการไทย',
            'themes' => $theme_official_thai,
            'seeMoreUrl' => url('/themes/official/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- ธีมทางการต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._theme-grid', [
            'title' => 'ธีมไลน์ทางการต่างประเทศ',
            'themes' => $theme_official_oversea,
            'seeMoreUrl' => url('/themes/official/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- ธีมครีเอเตอร์ไทย Section -->
    <section class="categories">
        @include('frontend._inc._theme-grid', [
            'title' => 'ธีมไลน์ครีเอเตอร์ไทย',
            'themes' => $theme_creator,
            'seeMoreUrl' => url('/themes/creator/th/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- ธีมครีเอเตอร์ต่างประเทศ Section -->
    <section class="categories">
        @include('frontend._inc._theme-grid', [
            'title' => 'ธีมไลน์ครีเอเตอร์ต่างประเทศ',
            'themes' => $theme_creator_oversea,
            'seeMoreUrl' => url('/themes/creator/oversea/new'),
            'seeMoreText' => 'ดูเพิ่มเติม',
        ])
    </section>
    <hr>

    <!-- Popular Products Section -->
    <section class="categories" id="series">
        <div class="container">
            <h2 class="mb-4">แนะนำจากทางร้าน</h2>
            <div class="row g-1 g-md-3">
                @foreach ($series as $row)
                    <!-- ใช้ col-6 สำหรับมือถือเพื่อแสดง 2 items ต่อแถว, col-md-4 สำหรับหน้าจอขนาดใหญ่ -->
                    <div class="col-6 col-md-4 col-lg-4">
                        <div class="col pl-2 pr-2">
                            <a href="{{ url('series/' . $row->id) }}">
                                <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Add "ดูเพิ่มเติม" button -->
            <div class="text-center mt-4">
                <a href="{{ url('/series') }}" class="btn btn-danger btn-more">ดูเพิ่มเติม</a>
            </div>
        </div>
    </section>
    <hr>

    <!-- Customer Reviews Section -->
    @php
        // Step 1: Define an array of reviews
        $reviews = [
            ['text' => 'ซื้อเป็นประจำ ของแท้ ไม่มีหมดอายุ', 'author' => 'คุณนัทจัง'],
            ['text' => 'บริการดีมากค่ะ ส่งสติกเกอร์ไวมากๆ ไม่ต้องรอนานเลย มีสติกเกอร์ให้เลือกเยอะมาก ทั้งไทยและต่างประเทศ ราคาก็ไม่แพงด้วยค่ะ', 'author' => 'คุณกิ๊ฟ'],
            ['text' => 'ร้านนี้มีสติกเกอร์ที่สวยและน่ารักมากค่ะ ใช้ส่งให้เพื่อนๆ ทุกวันเลย มีสติกเกอร์ใหม่ๆ มาให้เลือกตลอด ประทับใจมากค่ะ', 'author' => 'คุณกัญญา'],
            ['text' => 'เป็นลูกค้าประจำของร้านนี้เลยค่ะ สติกเกอร์น่ารักทุกลาย', 'author' => 'คุณ Toto'],
            ['text' => 'ถูกใจมากค่ะ ร้านนี้มีสติกเกอร์หลายแบบที่หายากมาก', 'author' => 'คุณ Yayee'],
            ['text' => 'สั่งง่าย ส่งเร็ว สติกเกอร์น่ารักทุกลาย ราคาก็ไม่แพงด้วย', 'author' => 'คุณ Haikyu2233'],
            ['text' => 'บริการดีมากค่ะ ส่งสติกเกอร์ไวมากๆ ไม่ต้องรอนานเลย มีสติกเกอร์ให้เลือกเยอะมาก ทั้งไทยและต่างประเทศ ราคาก็ไม่แพงด้วยค่ะ', 'author' => 'คุณกิ๊ฟ'],
            ['text' => 'ชอบมากค่ะ สติกเกอร์น่ารักทุกแบบเลย ส่งเร็วทันใจ ราคาก็โอเคค่ะ', 'author' => 'คุณหนิง'],
            ['text' => 'ร้านนี้ดีมากค่ะ สติกเกอร์มีให้เลือกเยอะ บริการรวดเร็วทันใจค่ะ', 'author' => 'คุณแอน'],
            ['text' => 'สั่งซื้อง่าย ส่งไว สติกเกอร์น่ารักมากๆ ค่ะ', 'author' => 'คุณเบนซ์'],
            ['text' => 'บริการเป็นกันเอง สติกเกอร์หลากหลาย มีให้เลือกมากมายค่ะ', 'author' => 'คุณปุ๋ย'],
            ['text' => 'ประทับใจมากค่ะ ร้านนี้มีสติกเกอร์หลากหลาย ส่งไวมากค่ะ', 'author' => 'คุณโม'],
            ['text' => 'สติกเกอร์น่ารักมากๆ เลยค่ะ บริการดี ส่งเร็ว ราคาก็สมเหตุสมผลค่ะ', 'author' => 'คุณมิ้น'],
            ['text' => 'ร้านนี้สติกเกอร์เยอะจริงๆ ส่งไวมากค่ะ ชอบมากๆ', 'author' => 'คุณก้อย'],
            ['text' => 'สติกเกอร์น่ารักมากๆ บริการเป็นกันเอง ส่งเร็วทันใจค่ะ', 'author' => 'คุณน้ำ'],
            ['text' => 'บริการดีมาก สติกเกอร์น่ารัก ส่งไว ประทับใจค่ะ', 'author' => 'คุณจอย'],
            ['text' => 'ร้านนี้บริการดีมาก สติกเกอร์สวย ส่งไวมากค่ะ', 'author' => 'คุณแนน'],
            ['text' => 'ประทับใจมากค่ะ สติกเกอร์สวย ส่งไว บริการดีมากๆ', 'author' => 'คุณดา'],
            ['text' => 'สติกเกอร์น่ารักมากๆ เลยค่ะ ชอบมากๆ ร้านนี้ส่งไวจริงๆ', 'author' => 'คุณน้ำฝน'],
            ['text' => 'บริการดีมากค่ะ สติกเกอร์เยอะ ส่งไวมากๆ ประทับใจมากค่ะ', 'author' => 'คุณมินนี่'],
            ['text' => 'สั่งซื้อสติกเกอร์ที่นี่ทุกครั้ง บริการดีเยี่ยมค่ะ', 'author' => 'คุณพิมพ์'],
            ['text' => 'สติกเกอร์สวยมากๆ เลยค่ะ ส่งเร็วทันใจจริงๆ', 'author' => 'คุณลูกตาล'],
            ['text' => 'ร้านนี้มีสติกเกอร์ให้เลือกเยอะมาก ส่งไวด้วยค่ะ', 'author' => 'คุณฟ้า'],
            ['text' => 'บริการเป็นกันเอง สติกเกอร์หลากหลาย น่ารักมากค่ะ', 'author' => 'คุณกานต์'],
            ['text' => 'สติกเกอร์น่ารักทุกลาย บริการดีมากค่ะ', 'author' => 'คุณบี'],
            ['text' => 'ส่งไว ราคาดี สติกเกอร์น่ารักทุกแบบค่ะ', 'author' => 'คุณปาล์ม'],
            ['text' => 'บริการดี สติกเกอร์มีให้เลือกเยอะ ส่งเร็วมากๆ ค่ะ', 'author' => 'คุณแคท'],
            ['text' => 'ชอบมากค่ะ ร้านนี้บริการดี ส่งไว สติกเกอร์น่ารัก', 'author' => 'คุณจูน'],
            ['text' => 'ร้านนี้มีสติกเกอร์เยอะมาก ส่งไว บริการดี ราคาดีค่ะ', 'author' => 'คุณเอิร์น'],
            ['text' => 'สติกเกอร์มีให้เลือกเยอะ บริการดี ส่งเร็ว ประทับใจค่ะ', 'author' => 'คุณเล็ก'],
            ['text' => 'สติกเกอร์น่ารักทุกลาย บริการดี ส่งไวมากค่ะ', 'author' => 'คุณแพร'],
            ['text' => 'ร้านนี้บริการดีมาก สติกเกอร์สวย ส่งไวมากค่ะ', 'author' => 'คุณน้ำตาล'],
        ];

        // Step 2: Shuffle the reviews array
        shuffle($reviews);

        // Step 3: Select the first 3 reviews
        $selected_reviews = array_slice($reviews, 0, 3);
    @endphp
    <section id="reviews">
        <div class="container">
            <h2 class="mb-4">รีวิวลูกค้า</h2>
            <div class="row">
                @foreach ($selected_reviews as $review)
                    <div class="col-md-4 mb-4 reviews-item">
                        <div class="testimonial-card">
                            <img src="https://stickershop.line-scdn.net/sticonshop/v1/sticon/64817945b74fae74142e71c2/iPhone/022_animation.png" alt="Cat Icon" class="cat-icon animated-sticker">
                            <p>"{{ $review['text'] }}" - {{ $review['author'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ประวัติการเข้าชม --}}
    @include('frontend._partials.view_history')
@endsection

@push('css')
    <style>
        /* หมวดอัพเดท */
        .update-category {
            background-color: #f39c12;
        }

        /* หมวดสติกเกอร์ */
        .sticker-category {
            background-color: #e74c3c;
        }

        /* หมวดธีม */
        .theme-category {
            background-color: #3498db;
        }

        /* หมวดอิโมจิ */
        .emoji-category {
            background-color: #2ecc71;
        }
    </style>
@endpush
