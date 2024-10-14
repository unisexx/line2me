<div class="container">
    <h2 class="mb-4">{{ $title }}</h2>

    <!-- Display for smaller screens (4 items per row) -->
    <div class="row row-cols-4 d-sm-flex d-md-none g-2">
        @if (isset($stickers))
            @foreach ($stickers as $item)
                <div class="col">
                    <div class="card h-100 {{ new_icon($item->created_at) }}" style="padding: 5px;">
                        <div class="position-relative">
                            <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="card-img-top" style="max-height: 100px; object-fit: cover;">
                            <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}" style="top:0px; right:0px; width:10px;"></span>
                            {!! getStickerResourctTypeIcon($item->stickerresourcetype) !!}
                        </div>
                        <div class="card-body d-flex flex-column" style="padding: 5px;">
                            <h6 class="card-title" style="font-size: 0.7rem;">{{ $item->title_th }}</h6>
                            <p class="card-text mt-auto text-secondary" style="font-size: 0.6rem;"><span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                            <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link stretched-link" style="font-size: 0.6rem; padding: 4px 6px;">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Add promotion card for mobile -->
        <div class="col">
            <div class="card h-100 rainbow-border" style="padding: 5px;">
                <div class="position-relative">
                    <img src="https://i.imgur.com/bvblNHf.png" alt="Promote Your Sticker" class="card-img-top" style="max-height: 100px; object-fit: cover;">
                    <span class="position-absolute translate-middle badge rounded-pill bg-danger" style="top: 14px; right: -54px;">
                        สนใจโปรโมทคลิก
                    </span>
                </div>
                <div class="card-body d-flex flex-column" style="padding: 5px;">
                    <h6 class="card-title text-primary" style="font-size: 0.7rem;">โปรโมทสติกเกอร์ไลน์ของคุณตำแหน่งนี้!</h6>
                    <p class="card-text mt-auto" style="font-size: 0.65rem;"><strong>Price: </strong> <span class="text-danger">100</span> บาท/เดือน</p>
                    <a href="{{ url('/page/view/8') }}" target="_blank" class="btn btn-primary hidden-link stretched-link" style="font-size: 0.6rem; padding: 4px 6px;">สนใจคลิกที่นี่</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Normal grid for larger screens -->
    <div class="row d-none d-md-flex">
        @if (isset($stickers))
            @foreach ($stickers as $item)
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                    <div class="card h-100 {{ new_icon($item->created_at) }}">
                        <div class="position-relative">
                            <img src="{{ get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code) }}" alt="{{ $item->title_th }}" class="card-img-top">
                            <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->title_th }}</h5>
                            <p class="card-text mt-auto"><strong>Price: </strong> <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท</p>
                            <a href="{{ url('sticker/' . $item->sticker_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        <!-- Add promotion card for larger screens -->
        <div class="col-6 col-md-4 col-lg-2 mb-4">
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
                    <a href="{{ url('/page/view/8') }}" target="_blank" class="btn btn-primary hidden-link stretched-link">สนใจคลิกที่นี่</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add "ดูเพิ่มเติม" button -->
    @if (!empty($seeMoreUrl))
        <div class="text-center mt-4">
            <a href="{{ $seeMoreUrl }}" class="btn btn-danger btn-more">{{ $seeMoreText }}</a>
        </div>
    @endif
</div>
