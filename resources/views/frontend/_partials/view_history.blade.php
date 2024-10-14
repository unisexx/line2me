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

{{-- <section class="categories"> --}}
{{-- <div class="container"> --}}
{{-- <h4 style="font-size:1.75rem;">ประวัติการเข้าชม</h4> --}}

@if ($stickerHistory->isNotEmpty())
    <!-- Include Sticker Grid -->
    @include('frontend._inc._sticker-grid', [
        'title' => 'ประวัติเข้าชมสติกเกอร์ไลน์',
        'stickers' => $stickerHistory,
        'seeMoreUrl' => '', // หรือกำหนด URL ถ้าต้องการ
        'seeMoreText' => '', // หรือกำหนดข้อความเพิ่มเติมถ้าต้องการ
    ])
@endif

<hr>

@if ($themeHistory->isNotEmpty())
    <!-- Include Theme Grid -->
    @include('frontend._inc._theme-grid', [
        'title' => 'ประวัติเข้าชมธีมไลน์',
        'themes' => $themeHistory,
        'seeMoreUrl' => '', // หรือกำหนด URL ถ้าต้องการ
        'seeMoreText' => '', // หรือกำหนดข้อความเพิ่มเติมถ้าต้องการ
    ])
@endif

<hr>

@if ($emojiHistory->isNotEmpty())
    <!-- Include Emoji Grid -->
    @include('frontend._inc._emoji-grid', [
        'title' => 'ประวัติเข้าชมอิโมจิไลน์',
        'emojis' => $emojiHistory,
        'seeMoreUrl' => '', // หรือกำหนด URL ถ้าต้องการ
        'seeMoreText' => '', // หรือกำหนดข้อความเพิ่มเติมถ้าต้องการ
    ])
@endif
{{-- </div> --}}
{{-- </section> --}}
