@php
    if($row->country == "th"){
        $color = '#eee';
    }elseif($row->country == "jp"){
        $color = '#f788a35e';
    }elseif($row->country == "tw"){
        $color = '#5c9ed55e';
    }elseif($row->country == "id"){
        $color = '#d7ad725e';
    }
@endphp


@if($type == 'sticker' && !empty($row->id))
<div class="text-center">
    {{-- {!! @new_icon($row->created_at) !!} --}}
    <a href="{{ url('sticker/'.$row->sticker_code) }}">
        <div class="sticker-image-cover productImg" style="background-color: {{ @$color }};">
            <img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/main.png" alt="สติ๊กเกอร์ไลน์ {{ $row->title_th }}" class="img-fluid">
            {!! getStickerResourctTypeIcon($row->stickerresourcetype) !!}
        </div>
        <p class="fh5co-work-title">
            {!! @countryFlag($row->country) !!} 
            {{ $row->title_th }}
            {{-- <br><span class="text-black-50">{{ convert_line_coin_2_money($row->price) }} บาท<span> --}}
        </p>
    </a>
</div>
@endif

@if($type == 'emoji' && !empty($row->id))
<div class="text-center">
    {{-- {!! @new_icon($row->created_at) !!} --}}
    <a href="{{ url('emoji/'.$row->id) }}">
        <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->emoji_code }}/iphone/main.png" alt="อิโมจิไลน์ {{ $row->title }}" class="img-fluid">
        <p class="fh5co-work-title">
            {!! @countryFlag($row->country) !!} {{ $row->title }}
            {{-- <br><span class="text-black-50">{{ $row->price }} บาท<span> --}}
        </p>
    </a>
</div>
@endif

@if($type == 'theme' && !empty($row->id))
<div class="text-center">
    {{-- {!! @new_icon($row->created_at) !!} --}}
    <a href="{{ url('theme/'.$row->id) }}">
        <img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->theme_code }}/1/WEBSTORE/icon_198x278.png" alt="ธีมไลน์ {{ $row->title }}" class="img-fluid">
        <p class="fh5co-work-title">
            {!! @countryFlag($row->country) !!} {{ $row->title }}
            {{-- <br><span class="text-black-50">{{ $row->price }} บาท<span> --}}
        </p>
    </a>
</div>
@endif