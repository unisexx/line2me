@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/themes') }}">ธีมไลน์</a></li>
                @if ($rs->category == 'official')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/official') }}">ธีมไลน์ทางการ</a></li>
                @elseif($rs->category == 'creator')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/creator') }}">ธีมไลน์ครีเอเตอร์</a></li>
                @endif

                @if ($rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/' . $rs->category . '/th') }}">ธีมไลน์ไทย</a></li>
                @elseif($rs->country == 'oversea')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/' . $rs->category . '/oversea') }}">ธีมไลน์น์ต่างประเทศ</a></li>
                @elseif($rs->country == 'jp')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/' . $rs->category . '/jp') }}">ธีมไลน์ญี่ปุ่น</a></li>
                @elseif($rs->country == 'tw')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/' . $rs->category . '/tw') }}">ธีมไลน์ไต้หวัน</a></li>
                @elseif($rs->country == 'id')
                    <li class="breadcrumb-item"><a href="{{ url('/themes/' . $rs->category . '/id') }}">ธีมไลน์อินโดนีเซีย</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $rs->title }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8 mx-auto">
                <div class="d-flex align-items-start {{ new_icon($rs->created_at) }}">
                    <!-- Left Image Column -->
                    <div class="me-3 fixed-width-240">
                        <img class="product-cover-img" src="{{ generateThemeUrl($rs->theme_code, @$rs->section) }}" alt="ธีมไลน์ {{ $rs->title }}">
                    </div>
                    <!-- Right Content Column -->
                    <div class="w-100">
                        <h3>{{ @$rs->title }}</h3>
                        <p>{{ @$rs->detail }}</p>
                        <p class="mb-1"><strong><a class="no-style" rel="nofollow" href="https://line.me/S/shop/theme/detail?id={{ $rs->theme_code }}" target="_blank">รหัสสินค้า: </a></strong> t-{{ @$rs->id }}</p>
                        <p class="mb-1"><strong>ประเทศ: </strong> <span class="fi fi-{{ $rs->country }}"></span></p>
                        <h4>Price: <span class="text-danger">{{ convert_line_coin_2_money($rs->price) }}</span>THB</h4>
                        <a href="https://line.me/ti/p/~ratasak1234" target="_blank" class="btn custom-btn-blue btn-primary d-none d-md-block">สั่งซื้อชุดนี้แอดไลน์ไอดี ratasak1234</a>
                    </div>
                </div>
                <div class="w-100 mt-3 d-md-none">
                    <a href="https://line.me/ti/p/~ratasak1234" target="_blank" class="w-100 btn custom-btn-blue btn-primary">สั่งซื้อชุดนี้แอดไลน์ไอดี ratasak1234</a>
                </div>
                <hr class="custom-hr">
                <div class="row mt-4">
                    @for ($x = 2; $x <= 5; $x++)
                        <div class="col-6 col-md-6 text-center mb-3">
                            <a class="venobox" data-gall="gallery" href="{{ generateThemeUrlDetail($rs->theme_code, $x, @$rs->section) }}">
                                <img class="img-fluid imgDetail" src="{{ generateThemeUrlDetail($rs->theme_code, $x, @$rs->section) }}" alt="ธีมไลน์ {{ $rs->title }}">
                            </a>
                        </div>
                    @endfor
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-lg-4 border-start">
                @include('frontend._partials.sidebar')
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.venobox').venobox({
                infinigall: true,
                frameheight: '85vh',
                // share: ['facebook', 'twitter', 'pinterest'] // default: []
            });
        });
    </script>
@endpush
