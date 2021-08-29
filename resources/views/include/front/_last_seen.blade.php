@if (Session::get('stickerArray'))
    @php
        $lastSeenStickers = Session::get('stickerArray');
        unset($lastSeenStickers[0]);
        krsort($lastSeenStickers);
        // dump($lastSeenStickers);
    @endphp
    @if ($lastSeenStickers)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box"
                data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ที่ดูล่าสุด</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($lastSeenStickers as $sticker_code)
                    <div class="work-item text-center">
                        <a href="{{ url('sticker/' . @$sticker_code) }}">
                            <div class="sticker-image-cover">
                                <img src="https://sdl-stickershop.line.naver.jp/products/0/0/1/{{ @$sticker_code }}/android/main.png"
                                    class="img-fluid">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
