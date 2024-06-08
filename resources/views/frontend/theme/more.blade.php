@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/themes') }}">ธีมไลน์</a></li>
                @if ($category == 'official')
                    <li class="breadcrumb-item active" aria-current="page">ธีมไลน์ทางการ</li>
                @elseif($category == 'creator')
                    <li class="breadcrumb-item active" aria-current="page">ธีมไลน์ครีเอเตอร์</li>
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
        <h2 class="text-center mb-4">ธีมไลน์</h2>
        <div class="row">
            <form>
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="exampleSelect1" class="form-label">หมวดหมู่</label>
                        <select class="form-select" id="exampleSelect1" onchange="redirectToSelectedURL()">
                            <option value="{{ url('themes') }}" {{ request()->segment(2) == null ? 'selected' : '' }}>ทั้งหมด</option>
                            <option value="{{ url('themes/official/th') }}" {{ request()->segment(2) == 'official' && request()->segment(3) == 'th' ? 'selected' : '' }}>ธีมไลน์ทางการไทย</option>
                            <option value="{{ url('themes/official/oversea') }}" {{ request()->segment(2) == 'official' && request()->segment(3) == 'oversea' ? 'selected' : '' }}>ธีมไลน์ทางการต่างประเทศ</option>
                            <option value="{{ url('themes/creator/th') }}" {{ request()->segment(2) == 'creator' && request()->segment(3) == 'th' ? 'selected' : '' }}>ธีมไลน์ครีเอเตอร์ไทย</option>
                            <option value="{{ url('themes/creator/oversea') }}" {{ request()->segment(2) == 'creator' && request()->segment(3) == 'oversea' ? 'selected' : '' }}>ธีมไลน์ครีเอเตอร์ต่างประเทศ</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="exampleSelect2" class="form-label">เรียงลำดับ</label>
                        <select class="form-select" id="exampleSelect2" onchange="redirectToSelectedURL()">
                            <option value="new" {{ request()->segment(4) == 'new' || request()->segment(2) == 'new' ? 'selected' : '' }}>มาใหม่</option>
                            <option value="top" {{ request()->segment(4) == 'top' || request()->segment(2) == 'top' ? 'selected' : '' }}>สุดฮิต</option>
                        </select>
                    </div>
                </div>
            </form>

            @push('js')
                <script>
                    function redirectToSelectedURL() {
                        const categorySelect = document.getElementById('exampleSelect1');
                        const orderSelect = document.getElementById('exampleSelect2');
                        const selectedCategoryURL = categorySelect.value;
                        const selectedOrder = orderSelect.value;

                        // เช็คว่ามีหมวดหมู่หรือไม่
                        let finalURL;
                        if (selectedCategoryURL === '{{ url('themes') }}') {
                            finalURL = `{{ url('themes') }}/${selectedOrder}`;
                        } else {
                            finalURL = `${selectedCategoryURL}/${selectedOrder}`;
                        }
                        window.location.href = finalURL;
                    }
                </script>
            @endpush

            @foreach ($rs as $item)
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

        <!-- แสดงลิงก์การแบ่งหน้า -->
        <div class="d-flex justify-content-center">
            {{ $rs->appends(['query' => request()->input('query')])->links() }}
        </div>
    </div>

    {{-- <section class="categories  wow animate__animated animate__bounceIn" id="categories">
        <div class="container">
            <h2 class="text-center mb-4">หมวดหมู่</h2>
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/themes/official/th/top') }}" class="btn btn-category btn-primary">
                        ธีมไลน์ไทย
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/themes/official/oversea/top') }}" class="btn btn-category btn-primary">
                        ธีมไลน์ต่างประเทศ
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/themes/creator/all/top') }}" class="btn btn-category btn-primary">
                        ธีมไลน์ครีเอเตอร์
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/themes/all/jp/top') }}" class="btn btn-category btn-primary">
                        ธีมไลน์ญี่ปุ่น
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/themes/all/tw/top') }}" class="btn btn-category btn-primary">
                        ธีมไลน์ไต้หวัน
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
