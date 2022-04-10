@php
if (in_array($rs->stickerresourcetype, ['SOUND','STATIC','NAME_TEXT','PER_STICKER_TEXT'])) {
$data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item .
'/android/sticker.png;compress=true';
} elseif (in_array($rs->stickerresourcetype, ['POPUP','POPUP_SOUND'])) {
$data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item .
'/IOS/sticker_popup.png;compress=true';
} else {
$data_animation = 'https://stickershop.line-scdn.net/stickershop/v1/sticker/' . $item .
'/IOS/sticker_animation@2x.png;compress=true';
}
@endphp

<li class="sticker-stamp-list">
    <img class="sticker-stamp playAnimate"
        src="https://stickershop.line-scdn.net/stickershop/v1/sticker/{{ $item }}/android/sticker.png;compress=true"
        data-animation="{{ $data_animation }}">

    @if(in_array($rs->stickerresourcetype, ['SOUND','POPUP_SOUND','ANIMATION_SOUND']))
    <audio preload="metadata">
        <source
            src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $rs->version }}/{{ $rs->sticker_code }}/android/sound/{{ $item }}.m4a"
            type="audio/mpeg">
    </audio>
    @endif
</li>