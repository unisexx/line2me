<h5 class="d-none d-md-block">สติ๊กเกอร์ไลน์แนะนำ</h5>

@if (isset($sticker_promote))
    @foreach ($sticker_promote as $item)
        <!-- Card สำหรับหน้าจอขนาดปกติ -->
        <div class="col-12 d-none d-md-block product-card">
            <div class="card h-100 border border-0">
                <div class="row g-0">
                    <div class="col-md-3 p-2">
                        <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="img-fluid product-img animated-sticker">
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title_th }}</h5>
                            <p class="card-text mt-auto"><strong>Price:</strong> {{ @convert_line_coin_2_money($item->price) }} บาท</p>
                            <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card สำหรับหน้าจอขนาดเล็ก -->
        {{-- <div class="row">
            <div class="col-4 col-sm-6 col-md-4 col-lg-2 mb-4 d-md-none">
                <div class="card h-100 border border-0">
                    <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="card-img-top product-img animated-sticker img-fluid">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title_th }}</h5>
                        <p class="card-text"><strong>Price:</strong> {{ @convert_line_coin_2_money($item->price) }} บาท</p>
                        <a href="{{ url('sticker/' . $item->product_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                    </div>
                </div>
            </div>
        </div> --}}
    @endforeach

    <div class="col-12 d-none d-md-block product-card">
        <div class="card h-100 border border-0">
            <div class="row g-0">
                <div class="col-md-3 p-2">
                    <img src="https://i.imgur.com/bvblNHf.png" alt="Promote Your Sticker" class="img-fluid product-img animated-sticker rainbow-border">
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-title text-primary">โปรโมทสติกเกอร์ไลน์ของคุณตำแหน่งนี้</h5>
                        <p class="card-text mt-auto"><strong>Price:</strong> <span class="text-danger">100</span> บาท/เดือน</p>
                        <a href="{{ url('/page/view/8') }}" target="_blank" class="btn btn-primary hidden-link stretched-link">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
