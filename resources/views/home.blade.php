@extends('layouts.front') @section('content')
    <div class="fh5co-narrow-content single-item mb-4 {{-- owl-carousel owl-theme --}}">
        <div><a href="https://line.me/R/ti/p/HuNn5V9sfP"><img class="img-fluid" src="{{ url('image/banner.jpg') }}" alt="line2me.in.th" style="width:100%;"></a></div>
        {{-- <div><a href="https://line2me.in.th/page/view/22" target="_blank"><img class="img-fluid"
				src="{{ url('image/free_promote.png') }}" alt="โปรโมทสติ๊กเกอร์ไลน์"></a></div> --}}
    </div>


    @if (count($sticker_promote) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ขายดีแนะนำ</h2>
            </div>
            <div><a href="{{ url('page/view/8') }}"><span class="hilight_yellow text-dark"><i class="fas fa-star fa-spin" style="color:#dc3545; margin-right:5px;"></i> <u>สนใจโปรโมทสติ๊กเกอร์ไลน์ ธีม
                            อิโมจิคลิ๊ก...</u></span></a>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($sticker_promote as $row)
                    @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row->sticker])
                @endforeach
            </div>
        </div>
    @endif


    @if (count($emoji_promote) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">อิโมจิไลน์แนะนำ</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($emoji_promote as $row)
                    @include('include.front.__product_item', ['type' => 'emoji', 'row' => $row->emoji])
                @endforeach
            </div>
        </div>
    @endif


    @if (count($theme_promote) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">ธีมไลน์แนะนำ</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($theme_promote as $row)
                    @include('include.front.__product_item', ['type' => 'theme', 'row' => $row->theme])
                @endforeach
            </div>
        </div>
    @endif


    @php
        $th = $sticker_update->filter(function ($value, $key) {
            if ($value['country'] == 'th') {
                return $value;
            }
        });

        $jp = $sticker_update->filter(function ($value, $key) {
            if ($value['country'] == 'jp') {
                return $value;
            }
        });

        $tw = $sticker_update->filter(function ($value, $key) {
            if ($value['country'] == 'tw') {
                return $value;
            }
        });

        $id = $sticker_update->filter(function ($value, $key) {
            if ($value['country'] == 'id') {
                return $value;
            }
        });
    @endphp
    @if (count($th) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่ (ไทย)</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($th->take(12) as $row)
                    @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif

    @if (count($jp) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่ (ญี่ปุ่น)</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($jp->take(12) as $row)
                    @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif

    @if (count($tw) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่ (ไต้หวัน)</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($tw->take(12) as $row)
                    @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif

    @if (count($id) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการมาใหม่ (อินโดนีเซีย)</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($id->take(18) as $row)
                    @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif


    @if (count($emoji_update) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">อิโมจิไลน์ทางการมาใหม่</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($emoji_update as $row)
                    @include('include.front.__product_item', ['type' => 'emoji', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif


    @if (count($theme_update) != 0)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">ธีมไลน์ทางการมาใหม่</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($theme_update as $row)
                    @include('include.front.__product_item', ['type' => 'theme', 'row' => $row])
                @endforeach
            </div>
        </div>
    @endif

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">แนะนำจากทางร้าน</h2>
            <p class="text-right read-more-text"><a href="{{ url('series') }}">ดูทั้งหมด ></a></p>
        </div>
        @foreach ($series->chunk(3) as $chunk)
            <div class="row mb-2">
                @foreach ($chunk as $row)
                    <div class="col pl-2 pr-2">
                        <a href="{{ url('series/' . $row->id) }}">
                            <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการไทย</h2>
            <p class="text-right read-more-text"><a href="{{ url('sticker/official/th/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($sticker_official_thai as $row)
                @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
            @endforeach
        </div>
    </div>


    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ทางการต่างประเทศ</h2>
            <p class="text-right read-more-text"><a href="{{ url('sticker/official/oversea/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($sticker_official_oversea as $row)
                @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">สติ๊กเกอร์ไลน์ครีเอเตอร์</h2>
            <p class="text-right read-more-text"><a href="{{ url('sticker/creator/all/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($sticker_creator as $row)
                @include('include.front.__product_item', ['type' => 'sticker', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">อิโมจิไลน์ทางการไทย</h2>
            <p class="text-right read-more-text"><a href="{{ url('emoji/official/th/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($emoji_official_thai as $row)
                @include('include.front.__product_item', ['type' => 'emoji', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">อิโมจิไลน์ทางการต่างประเทศ</h2>
            <p class="text-right read-more-text"><a href="{{ url('emoji/official/oversea/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($emoji_official_oversea as $row)
                @include('include.front.__product_item', ['type' => 'emoji', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">อิโมจิไลน์ครีเอเตอร์</h2>
            <p class="text-right read-more-text"><a href="{{ url('emoji/creator/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($emoji_creator as $row)
                @include('include.front.__product_item', ['type' => 'emoji', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">ธีมไลน์ทางการไทย</h2>
            <p class="text-right read-more-text"><a href="{{ url('theme/official/th/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($theme_official_thai as $row)
                @include('include.front.__product_item', ['type' => 'theme', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">ธีมไลน์ทางการต่างประเทศ</h2>
            <p class="text-right read-more-text"><a href="{{ url('theme/official/oversea/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($theme_official_oversea as $row)
                @include('include.front.__product_item', ['type' => 'theme', 'row' => $row])
            @endforeach
        </div>
    </div>

    <div class="fh5co-narrow-content">
        <div class="d-flex justify-content-between align-items-baseline animate-box" data-animate-effect="fadeInLeft">
            <h2 class="fh5co-heading">ธีมไลน์ครีเอเตอร์</h2>
            <p class="text-right read-more-text"><a href="{{ url('theme/creator/top') }}">ดูทั้งหมด ></a></p>
        </div>
        <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
            @foreach ($theme_creator as $row)
                @include('include.front.__product_item', ['type' => 'theme', 'row' => $row])
            @endforeach
        </div>
    </div>
@endsection

@push('css')
    <style>
        .owl-prev,
        .owl-next {
            color: #869791 !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    }
                },
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                animateOut: 'fadeOut',
                navText: ["<i class='fas fa-chevron-left'></i>", "<i class='fas fa-chevron-right'></i>"],
            })
        })
    </script>
@endpush
