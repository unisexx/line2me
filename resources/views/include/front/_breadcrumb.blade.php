@php
    $route = Route::current();
    $name = Route::currentRouteName();
    $action = Route::currentRouteAction();
    // dump($route);
    // dump($name);
    // dump($action);
    // dump(Request::segment(1));
    // dump(Request::segment(2));
    // dump(Request::segment(3));
@endphp

<nav aria-label="breadcrumb p-5">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
        
        {{-- ชั้นที่สอง --}}
        @if($action == 'App\Http\Controllers\StickerController@getProduct')
            @if(@$rs->category == 'official')
                @if(@$rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('sticker/official/thai/top') }}">สติ๊กเกอร์ไลน์ทางการไทย</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ url('sticker/official/oversea/top') }}">สติ๊กเกอร์ไลน์ทางการต่างประเทศ</a></li>
                @endif
            @else
                @if(@$rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('sticker/creator/th/top') }}">อิโมจิไลน์ครีเอเตอร์ไทย</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ url('sticker/creator/oversea/top') }}">อิโมจิไลน์ครีเอเตอร์ต่างประเทศ</a></li>
                @endif
            @endif
        @endif

        @if($action == 'App\Http\Controllers\EmojiController@getProduct')
            @if(@$rs->category == 'official')
                @if(@$rs->country == 'gb')
                    <li class="breadcrumb-item"><a href="{{ url('emoji/official/thai/top') }}">อิโมจิไลน์ทางการไทย</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ url('emoji/official/oversea/top') }}">อิโมจิไลน์ทางการต่างประเทศ</a></li>
                @endif
            @else
                <li class="breadcrumb-item"><a href="{{ url('emoji/creator/top') }}">อิโมจิไลน์ครีเอเตอร์</a></li>
            @endif
        @endif

        @if($action == 'App\Http\Controllers\ThemeController@getProduct')
            @if(@$rs->category == 'official')
                @if(@$rs->country == 'th')
                    <li class="breadcrumb-item"><a href="{{ url('theme/official/thai/top') }}">ธีมไลน์ทางการไทย</a></li>
                @else
                    <li class="breadcrumb-item"><a href="{{ url('theme/official/oversea/top') }}">ธีมไลน์ทางการต่างประเทศ</a></li>
                @endif
            @else
                <li class="breadcrumb-item"><a href="{{ url('theme/creator/top') }}">ธีมไลน์ครีเอเตอร์</a></li>
            @endif
        @endif

        {{-- ชั้นที่สาม --}}
        @if(isset($rs->title_th))
            <li class="breadcrumb-item active" aria-current="page">{{ $rs->title_th }}</li>
        @endif

        @if(isset($rs->title))
            <li class="breadcrumb-item active" aria-current="page">{{ $rs->title }}</li>
        @endif
    </ol>
</nav>