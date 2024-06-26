@if ($type == 'sticker')
    <div class="work-item text-center">
        {!! @new_icon($row->created_at) !!}
        <a href="{{ url('sticker/' . $row->sticker_code) }}">
            <div class="sticker-image-cover">
                <img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
                {!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
            </div>
            <h3 class="fh5co-work-title">{!! @countryFlag($row->country) !!} {{ $row->title_th }}</h3>
            <p>{{ @convert_line_coin_2_money($row->price) }} บาท</p>
        </a>
    </div>
@endif

@if ($type == 'emoji')
    <div class="work-item text-center">
        {!! @new_icon($row->created_at) !!}
        <a href="{{ url('emoji/' . $row->id) }}">
            <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
            <h3 class="fh5co-work-title">{!! @countryFlag($row->country) !!} {{ $row->title }}</h3>
            <p>{{ @convert_line_coin_2_money($row->price) }} บาท</p>
        </a>
    </div>
@endif

@if ($type == 'theme')
    <div class="work-item text-center">
        {!! @new_icon($row->created_at) !!}
        <a href="{{ url('theme/' . $row->id) }}">
            <img src="{{ generateThemeUrl($row->theme_code, @$row->section) }}" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
            <h3 class="fh5co-work-title">{!! @countryFlag($row->country) !!} {{ $row->title }}</h3>
            <p>{{ @convert_line_coin_2_money($row->price) }} บาท</p>
        </a>
    </div>
@endif
