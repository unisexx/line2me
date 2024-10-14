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
    <section>
        <div class="container">
            <h2 class="text-center mb-4">สติกเกอร์ไลน์</h2>
            <div class="row">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="exampleSelect1" class="form-label">หมวดหมู่</label>
                            <select class="form-select" id="exampleSelect1" onchange="redirectToSelectedURL()">
                                <option value="{{ url('stickers') }}" {{ request()->segment(2) == null ? 'selected' : '' }}>ทั้งหมด</option>
                                {{-- <option value="{{ url('stickers/all/th') }}" {{ request()->segment(2) == 'all' && request()->segment(3) == 'th' ? 'selected' : '' }}>สติกเกอร์ไลน์ไทย</option>
                                <option value="{{ url('stickers/all/oversea') }}" {{ request()->segment(2) == 'all' && request()->segment(3) == 'oversea' ? 'selected' : '' }}>สติกเกอร์ไลน์ต่างประเทศ</option> --}}
                                <option value="{{ url('stickers/official/th') }}" {{ request()->segment(2) == 'official' && request()->segment(3) == 'th' ? 'selected' : '' }}>สติกเกอร์ไลน์ทางการไทย</option>
                                <option value="{{ url('stickers/official/oversea') }}" {{ request()->segment(2) == 'official' && request()->segment(3) == 'oversea' ? 'selected' : '' }}>สติกเกอร์ไลน์ทางการต่างประเทศ</option>
                                <option value="{{ url('stickers/creator/th') }}" {{ request()->segment(2) == 'creator' && request()->segment(3) == 'th' ? 'selected' : '' }}>สติกเกอร์ไลน์ครีเอเตอร์ไทย</option>
                                <option value="{{ url('stickers/creator/oversea') }}" {{ request()->segment(2) == 'creator' && request()->segment(3) == 'oversea' ? 'selected' : '' }}>สติกเกอร์ไลน์ครีเอเตอร์ต่างประเทศ</option>
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
                            if (selectedCategoryURL === '{{ url('stickers') }}') {
                                finalURL = `{{ url('stickers') }}/${selectedOrder}`;
                            } else {
                                finalURL = `${selectedCategoryURL}/${selectedOrder}`;
                            }
                            window.location.href = finalURL;
                        }
                    </script>
                @endpush

                <div class="container">
                    <div class="row px-2 px-md-0"> <!-- ใช้ px-2 เพื่อเพิ่มช่องว่างซ้าย-ขวาใน row เฉพาะบนมือถือ -->
                        @foreach ($rs as $item)
                            <div class="col-3 col-lg-2 col-md-4 col-sm-6 mb-4 g-1 g-md-3"> <!-- col-3 สำหรับมือถือ -->
                                <div class="card h-100 d-flex flex-column {{ new_icon($item->created_at) }} border-md"> <!-- ใช้ border-md เพื่อแสดง border เฉพาะบน PC -->
                                    <div class="position-relative" style="padding:5px;">
                                        <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" class="card-img-top animated-sticker img-fluid" alt="{{ $item->title_th }}">
                                        {!! getStickerResourctTypeIcon($item->stickerresourcetype) !!}

                                        <!-- สำหรับมือถือ -->
                                        <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }} d-md-none" style="top: 0px; right: 1px; width: 10px;"></span>

                                        <!-- สำหรับหน้าจอขนาดใหญ่ -->
                                        <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }} d-none d-md-block"></span>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-between" style="padding: 10px;"> <!-- flexbox สำหรับจัดให้เนื้อหาทั้งหมดอยู่ตรงกัน -->
                                        <div class="flex-grow-1">
                                            <h5 class="card-title d-none d-md-block">{{ $item->title_th }}</h5> <!-- ฟอนต์ปกติสำหรับเดสก์ท็อป -->
                                            <h6 class="card-title d-md-none" style="font-size: 0.8rem; margin-bottom:0px;">{{ $item->title_th }}</h6> <!-- ลดขนาดฟอนต์บนมือถือ -->
                                        </div>
                                        <div>
                                            <div class="d-md-none text-secondary" style="font-size: 0.6rem;"> <!-- ลดขนาดฟอนต์สำหรับราคาเฉพาะบนมือถือ -->
                                                <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท
                                            </div>
                                            <div class="d-none d-md-block text-secondary"> <!-- ฟอนต์ปกติสำหรับราคาในเดสก์ท็อป -->
                                                <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท
                                            </div>
                                        </div>
                                        <div class="mt-auto"> <!-- ปุ่ม View อยู่ที่ด้านล่างสุด -->
                                            <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link stretched-link" style="font-size: 0.75rem;">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>

            <!-- แสดงลิงก์การแบ่งหน้า -->
            <div class="d-flex justify-content-center">
                {{ $rs->appends(['query' => request()->input('query')])->links() }}
            </div>
        </div>
    </section>
@endsection
