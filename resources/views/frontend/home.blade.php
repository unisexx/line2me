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


    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <h2 class="text-center mb-4">หมวดหมู่</h2>
            <div class="row text-center">
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('stickers/official/th/new') }}" class="category-link">
                        <img src="{{ asset('image/1.png') }}" alt="Category 1" class="category-img">
                        <h5>สติกเกอร์ไลน์ไทย</h5>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('stickers/official/oversea/new') }}" class="category-link">
                        <img src="{{ asset('image/2.png') }}" alt="Category 2" class="category-img">
                        <h5>สติกเกอร์ไลน์ต่างประเทศ</h5>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('themes/official/th/new') }}" class="category-link">
                        <img src="{{ asset('image/3.png') }}" alt="Category 3" class="category-img">
                        <h5>ธีมไลน์ไทย</h5>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('themes/official/oversea/new') }}" class="category-link">
                        <img src="{{ asset('image/4.png') }}" alt="Category 4" class="category-img">
                        <h5>ธีมไลน์ต่างประเทศ</h5>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('emojis/official/th/new') }}" class="category-link">
                        <img src="{{ asset('image/5.png') }}" alt="Category 5" class="category-img">
                        <h5>อิโมจิไลน์ไทย</h5>
                    </a>
                </div>
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <a href="{{ url('emojis/official/oversea/new') }}" class="category-link">
                        <img src="{{ asset('image/6.png') }}" alt="Category 6" class="category-img">
                        <h5>อิโมจิไลน์ต่างประเทศ</h5>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Popular Products Section -->
    <section class="products bg-light" id="products">
        <div class="container">
            <h2 class="text-center mb-4">สติกเกอร์ขายดี</h2>
            <div class="row">
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 rainbow-border">
                        <div class="position-relative">
                            <img src="https://i.imgur.com/bvblNHf.png" alt="Promote Your Sticker" class="card-img-top">
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="top: 14px; right: -54px;">
                                สนใจโปรโมทคลิก
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-primary">โปรโมทสติกเกอร์ไลน์ของคุณตำแหน่งนี้!</h5>
                            <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">100</span> บาท/เดือน</p>
                            <a href="{{ url('/page/view/8') }}" target="_blank" class="btn btn-primary hidden-link stretched-link mt-auto">สนใจคลิกที่นี่</a>
                        </div>
                    </div>
                </div>
                @if (isset($sticker_promote))
                    @foreach ($sticker_promote as $item)
                        <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 rainbow-border {{ new_icon($item->created_at) }}">
                                <div class="position-relative">
                                    <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="card-img-top">
                                    <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title_th }}</h5>
                                    <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                    <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


    <section class="categories">
        <div class="container">
            <h2 class="text-center mb-4">สติ๊กเกอร์ไลน์อัพเดทประจำสัปดาห์</h2>
            @php
                $counter = 0;
                $order = ['th', 'jp', 'tw', 'id'];
                $countryNames = [
                    'th' => 'ประเทศไทย',
                    'jp' => 'ญี่ปุ่น',
                    'tw' => 'ไต้หวัน',
                    'id' => 'อินโดนีเซีย',
                ];
                $grouped = $sticker_update->groupBy('country');
                $sortedStickerUpdate = collect($order)
                    ->map(function ($country) use ($grouped) {
                        return $grouped->get($country, collect())->sortByDesc('id');
                    })
                    ->collapse();
            @endphp

            @foreach ($order as $country)
                @if ($grouped->has($country))
                    <div class="country-section">
                        <h3 class="mt-4">{{ $countryNames[$country] }}</h3>
                        @foreach ($grouped[$country]->sortByDesc('id') as $item)
                            @if ($counter % 2 == 0)
                                <div class="row">
                            @endif

                            <div class="col-12 col-md-6 mt-2 product-card">
                                <div class="card h-100 {{ new_icon($item->created_at) }}">
                                    <div class="row g-0">
                                        <div class="col-5 col-md-4 p-2 position-relative">
                                            <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="img-fluid product-img animated-sticker">
                                            {!! getStickerResourctTypeIcon($item->stickerresourcetype) !!}
                                        </div>
                                        <div class="col-7 col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->title_th }}</h5>
                                                <p class="mb-1"><strong>ประเทศ: </strong> <span class="fi fi-{{ $item->country }}"></span></p>
                                                <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                                <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary stretched-link">View</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $counter++;
                            @endphp

                            @if ($counter % 2 == 0)
                    </div> <!-- Close row -->
                @endif
            @endforeach

            @if ($counter % 2 != 0)
        </div> <!-- Close last row if it's not closed -->
        @endif

        @php
            $counter = 0; // Reset counter for next country
        @endphp
        </div> <!-- Close country-section -->
        @endif
        @endforeach
        </div>
    </section>




    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center mb-4">ธีมไลน์อัพเดทประจำสัปดาห์</h2>
            <div class="row">
                @foreach ($theme_update as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 {{ new_icon($item->created_at) }}">
                            <div class="position-relative">
                                <img src="{{ generateThemeUrl($item->theme_code, @$item->section) }}" alt="ธีมไลน์ {{ $item->title }}" class="card-img-top">
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                <a href="{{ url('theme/' . $item->id) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center mb-4">อิโมจิไลน์อัพเดทประจำสัปดาห์</h2>
            <div class="row">
                @foreach ($emoji_update as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 {{ new_icon($item->created_at) }}">
                            <div class="position-relative">
                                <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $item->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $item->title }}" class="card-img-top">
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                                <a href="{{ url('emoji/' . $item->emoji_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Popular Products Section -->
    <section class="products" id="series">
        <div class="container">
            <h2 class="text-center mb-4">แนะนำจากทางร้าน</h2>
            <div class="row">
                @foreach ($series as $row)
                    <div class="col-12 col-lg-4 col-md-4 col-sm-6 mb-4">
                        <div class="col pl-2 pr-2">
                            <a href="{{ url('series/' . $row->id) }}">
                                <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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
            <h2 class="text-center mb-4">รีวิวลูกค้า</h2>
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

    <!-- Promotions and News Section -->
    {{-- <section class="promotions bg-light" id="promotions">
        <div class="container">
            <h2 class="text-center mb-4">Promotions and News</h2>
            <div class="row">
                <div class="col-md-12">
                    <p>Sign up for our newsletter to get the latest updates and promotions!</p>
                    <form>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-primary" type="submit">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
