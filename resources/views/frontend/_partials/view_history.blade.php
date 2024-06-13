@php
    use Illuminate\Support\Facades\Redis;
    use Illuminate\Support\Facades\Session;
    use App\Models\Sticker;
    use App\Models\Theme;
    use App\Models\Emoji;

    $sessionId = Session::getId();

    // ดึงประวัติการเข้าชมสำหรับ sticker
    $stickerKey = "session:{$sessionId}:viewed_stickers";
    $stickerIds = Redis::lrange($stickerKey, 0, -1);
    $stickerHistory = Sticker::whereIn('sticker_code', $stickerIds)->get();

    // ดึงประวัติการเข้าชมสำหรับ theme
    $themeKey = "session:{$sessionId}:viewed_themes";
    $themeIds = Redis::lrange($themeKey, 0, -1);
    $themeHistory = Theme::whereIn('theme_code', $themeIds)->get();

    // ดึงประวัติการเข้าชมสำหรับ emoji
    $emojiKey = "session:{$sessionId}:viewed_emojis";
    $emojiIds = Redis::lrange($emojiKey, 0, -1);
    $emojiHistory = Emoji::whereIn('emoji_code', $emojiIds)->get();
@endphp

<div class="container">
    <h4 style="font-size:1.75rem;">ประวัติการเข้าชม</h4>

    @if ($stickerHistory->isNotEmpty())
        <section class="products">
            <h5 class="text-center mb-4">สติกเกอร์ไลน์</h5>
            <div class="row">
                @foreach ($stickerHistory as $item)
                    <div class="col-6 col-lg-2 col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 {{ new_icon($item->created_at) }}">
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
            </div>
        </section>
    @endif

    @if ($themeHistory->isNotEmpty())
        <section>
            <h5 class="text-center mb-4">ธีมไลน์</h5>
            <div class="row">
                @foreach ($themeHistory as $item)
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
        </section>
    @endif

    @if ($emojiHistory->isNotEmpty())
        <section>
            <h5 class="text-center mb-4">อิโมจิไลน์</h5>
            <div class="row">
                @foreach ($emojiHistory as $item)
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
        </section>
    @endif
</div>
