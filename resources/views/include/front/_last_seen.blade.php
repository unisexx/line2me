@if (Session::get('lastSeenStickers'))
    @php
        $lastSeenStickers = Session::get('lastSeenStickers');
        krsort($lastSeenStickers);
    @endphp
    @if ($lastSeenStickers)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box"
                data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">สติ๊กเกอร์ที่ดูล่าสุด</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($lastSeenStickers as $row)
                    <div class="work-item text-center">
                        <a href="{{ url('sticker/' . @$row[0]) }}">
                            <div class="sticker-image-cover">
                                <img src="https://sdl-stickershop.line.naver.jp/products/0/0/1/{{ @$row[0] }}/android/main.png"
                                    alt="สติ๊กเกอร์ไลน์ {{ $row[1] }}" class="img-fluid">
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif

@if (Session::get('lastSeenEmojis'))
    @php
        $lastSeenEmojis = Session::get('lastSeenEmojis');
        krsort($lastSeenEmojis);
    @endphp
    @if ($lastSeenEmojis)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box"
                data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">อิโมจิที่ดูล่าสุด</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($lastSeenEmojis as $row)
                    <div class="work-item text-center">
                        <a href="{{ url('emoji/' . $row[0]) }}">
                            <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row[1] }}/iphone/main.png"
                                alt="อิโมจิไลน์ {{ $row[2] }}" class="img-fluid">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif

@if (Session::get('lastSeenThemes'))
    @php
        $lastSeenThemes = Session::get('lastSeenThemes');
        krsort($lastSeenThemes);
    @endphp
    @if ($lastSeenThemes)
        <div class="fh5co-narrow-content">
            <div class="d-flex justify-content-between align-items-baseline animate-box"
                data-animate-effect="fadeInLeft">
                <h2 class="fh5co-heading">ธีมที่ดูล่าสุด</h2>
            </div>
            <div class="animate-box d-flex flex-md-wrap flex-sm-nowrap" data-animate-effect="fadeInLeft">
                @foreach ($lastSeenThemes as $row)
                    <div class="work-item text-center">
                        <a href="{{ url('theme/' . @$row[0]) }}">
                            <img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ @$row[1] }}/1/WEBSTORE/icon_198x278.png"
                                alt="ธีมไลน์ {{ @$row[2] }}" class="img-fluid">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endif
