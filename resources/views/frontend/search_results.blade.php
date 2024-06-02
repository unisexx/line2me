@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/search') }}">ค้นหา</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ @$_GET['query'] }}</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <!-- Categories Section -->
    <section class="categories" id="categories">
        <div class="container">
            <h2 class="text-center mb-4">ค้นหา</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="{{ url('/search') }}" method="GET" class="d-flex">
                        <input type="text" name="query" class="form-control form-control-lg me-2" placeholder="ค้นหาสติ๊กเกอร์..." value="{{ @$_GET['query'] }}">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <h2 class="text-center mb-4">ผลลัพธ์การค้นหา</h2>
        @if ($results->isEmpty())
            <p class="text-center">ไม่พบผลลัพธ์การค้นหาสำหรับคำว่า "{{ request()->input('query') }}"</p>
        @else
            <div class="row">
                @foreach ($results as $sticker)
                    <div class="col-md-2 mb-4">
                        <div class="card p-1 h-100">
                            <div class="position-relative">
                                <img src="{{ get_sticker_img_url($sticker->stickerresourcetype, $sticker->version, $sticker->sticker_code) }}" class="card-img-top" alt="{{ $sticker->title_th }}">
                                {!! getStickerResourctTypeIcon($sticker->stickerresourcetype) !!}
                                <span class="position-absolute positionTopRight flag-icon fi fi-{{ $sticker->country }}"></span>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $sticker->title_th }}</h5>
                                <a href="{{ url('sticker/' . $sticker->sticker_code) }}" class="btn btn-primary hidden-link">View</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- แสดงลิงก์การแบ่งหน้า -->
            <div class="d-flex justify-content-center">
                {{ $results->appends(['query' => request()->input('query')])->links() }}
            </div>
        @endif
    </div>
@endsection
