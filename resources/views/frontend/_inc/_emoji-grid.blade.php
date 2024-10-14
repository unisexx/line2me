<div class="container">
    <h2 class="mb-4">{{ $title }}</h2>

    <!-- Display for smaller screens (4 items per row, max 8 items) -->
    <div class="row row-cols-4 d-sm-flex d-md-none g-2">
        @if (isset($emojis) && count($emojis) > 0)
            @foreach ($emojis->take(8) as $item)
                <!-- Take only 8 items for mobile -->
                <div class="col">
                    <div class="card h-100 {{ new_icon($item->created_at) }}" style="padding: 5px;">
                        <div class="position-relative">
                            <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $item->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $item->title }}" class="card-img-top" style="max-height: 100px; object-fit: cover;">
                            <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}" style="top:0px; right:0px; width:10px;"></span>
                        </div>
                        <div class="card-body d-flex flex-column" style="padding: 5px;">
                            <h6 class="card-title" style="font-size: 0.7rem; margin-bottom:0px;">{{ $item->title }}</h6>
                            <div class="card-text mt-auto text-secondary" style="font-size: 0.6rem;">
                                <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท
                            </div>
                            <a href="{{ url('emoji/' . $item->emoji_code) }}" class="btn btn-primary hidden-link stretched-link" style="font-size: 0.6rem; padding: 4px 6px;">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">ไม่พบอิโมจิ</p>
        @endif
    </div>

    <!-- Normal grid for larger screens -->
    <div class="row d-none d-md-flex">
        @if (isset($emojis) && count($emojis) > 0)
            @foreach ($emojis as $item)
                <div class="col-6 col-md-4 col-lg-2 mb-4">
                    <div class="card h-100 {{ new_icon($item->created_at) }}">
                        <div class="position-relative">
                            <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $item->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $item->title }}" class="card-img-top">
                            <span class="position-absolute positionTopRight flag-icon fi fi-{{ $item->country }}"></span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text mt-auto text-secondary">
                                <span class="text-danger">{{ @convert_line_coin_2_money($item->price) }}</span> บาท
                            </p>
                            <a href="{{ url('emoji/' . $item->emoji_code) }}" class="btn btn-primary hidden-link stretched-link">View</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center">ไม่พบอิโมจิ</p>
        @endif
    </div>

    @if (!empty($seeMoreUrl))
        <div class="text-center mt-4">
            <a href="{{ $seeMoreUrl }}" class="btn btn-danger btn-more">{{ $seeMoreText }}</a>
        </div>
    @endif
</div>
