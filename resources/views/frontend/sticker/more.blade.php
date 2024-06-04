@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/stickers') }}">สติกเกอร์ไลน์</a></li>
                @if ($category == 'official')
                    <li class="breadcrumb-item active" aria-current="page">สติกเกอร์ทางการ</li>
                @elseif($category == 'creator')
                    <li class="breadcrumb-item active" aria-current="page">สติกเกอร์ครีเอเตอร์</li>
                @endif

                @if ($country == 'th')
                    <li class="breadcrumb-item active" aria-current="page">ไทย</li>
                @elseif($country == 'oversea')
                    <li class="breadcrumb-item active" aria-current="page">ต่างประเทศ</li>
                @elseif($country == 'jp')
                    <li class="breadcrumb-item active" aria-current="page">ญี่ปุ่น</li>
                @elseif($country == 'tw')
                    <li class="breadcrumb-item active" aria-current="page">ไต้หวัน</li>
                @elseif($country == 'id')
                    <li class="breadcrumb-item active" aria-current="page">อินโดนีเซีย</li>
                @endif
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">สติกเกอร์ไลน์</h2>
        <div class="row">
            @foreach ($rs as $item)
                <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <div class="position-relative">
                            <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" class="card-img-top animated-sticker img-fluid" alt="{{ $item->title_th }}">
                            {!! getStickerResourctTypeIcon($item->stickerresourcetype) !!}
                            <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title_th }}</h5>
                            <div><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</div>
                            <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- แสดงลิงก์การแบ่งหน้า -->
        <div class="d-flex justify-content-center">
            {{ $rs->appends(['query' => request()->input('query')])->links() }}
        </div>
    </div>

    <section class="categories" id="categories">
        <div class="container">
            <h2 class="text-center mb-4">หมวดหมู่</h2>
            <div class="category-list">
                <a href="{{ url('/stickers/official/th/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์ไทย
                </a>
                <a href="{{ url('/stickers/official/oversea/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์ต่างประเทศ
                </a>
                <a href="{{ url('/stickers/creator/all/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์ครีเอเตอร์
                </a>
                <a href="{{ url('/stickers/all/jp/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์ญี่ปุ่น
                </a>
                <a href="{{ url('/stickers/all/tw/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์ไต้หวัน
                </a>
                <a href="{{ url('/stickers/all/id/top') }}" class="btn btn-primary btn-lg">
                    สติกเกอร์ไลน์อินโดนีเซีย
                </a>
            </div>
        </div>
    </section>
@endsection

@push('css')
    <style>
        .category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
        }

        .btn-primary {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush
