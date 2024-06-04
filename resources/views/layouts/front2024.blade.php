<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="line2me.in.th ร้านขายสติกเกอร์ไลน์ สติกเกอร์น่ารัก สติกเกอร์ไลน์ใหม่ สติกเกอร์ไลน์ไทย สติกเกอร์ไลน์สวยๆ และอีกมากมาย">
    <meta name="keywords"
        content="สติกเกอร์ไลน์, Line Sticker, สติกเกอร์น่ารัก, สติกเกอร์ใหม่, สติกเกอร์ไลน์ไทย, สติกเกอร์ไลน์สวยๆ, โหลดสติกเกอร์ไลน์, สติกเกอร์ไลน์ฟรี, สติกเกอร์ไลน์ยอดนิยม, สติกเกอร์ไลน์ครีเอเตอร์, ซื้อสติกเกอร์ไลน์, สติกเกอร์ไลน์ขำขัน, สติกเกอร์ไลน์น่ารักๆ, สติกเกอร์ไลน์ตัวการ์ตูน, สติกเกอร์ไลน์สัตว์, สติกเกอร์ไลน์เด็กๆ, สติกเกอร์ไลน์โปรโมชั่น, สติกเกอร์ไลน์ลดราคา, สติกเกอร์ไลน์ใหม่ล่าสุด, สติกเกอร์ไลน์แฟชั่น, ธีมไลน์, Line Theme, ธีมน่ารัก, ธีมใหม่, ธีมไลน์ไทย, ธีมไลน์สวยๆ, โหลดธีมไลน์, ธีมไลน์ฟรี, ธีมไลน์ยอดนิยม, ธีมไลน์ครีเอเตอร์, ซื้อธีมไลน์, ธีมไลน์ขำขัน, ธีมไลน์น่ารักๆ, ธีมไลน์ตัวการ์ตูน, ธีมไลน์สัตว์, ธีมไลน์เด็กๆ, ธีมไลน์โปรโมชั่น, ธีมไลน์ลดราคา, ธีมไลน์ใหม่ล่าสุด, ธีมไลน์แฟชั่น,  อิโมจิไลน์, Line Emoji, อิโมจิน่ารัก, อิโมจิใหม่, อิโมจิไลน์ไทย, อิโมจิไลน์สวยๆ, โหลดอิโมจิไลน์, อิโมจิไลน์ฟรี, อิโมจิไลน์ยอดนิยม, อิโมจิไลน์ครีเอเตอร์, ซื้ออิโมจิไลน์, อิโมจิไลน์ขำขัน, อิโมจิไลน์น่ารักๆ, อิโมจิไลน์ตัวการ์ตูน, อิโมจิไลน์สัตว์, อิโมจิไลน์เด็กๆ, อิโมจิไลน์โปรโมชั่น, อิโมจิไลน์ลดราคา, อิโมจิไลน์ใหม่ล่าสุด, อิโมจิไลน์แฟชั่น">
    <meta name="author" content="line2me.in.th">
    <title>{{ @$ogTags['og:title'] }}</title>
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph meta tags for social media sharing -->
    <meta property="og:title" content="{{ @$ogTags['og:title'] }}">
    <meta property="og:description" content="{{ @$ogTags['og:description'] }}">
    <meta property="og:image" content="{{ @$ogTags['og:image'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card meta tags for social media sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ @$ogTags['og:title'] }}">
    <meta name="twitter:description" content="{{ @$ogTags['og:description'] }}">
    <meta name="twitter:image" content="{{ @$ogTags['og:image'] }}">

    @include('frontend._inc._css')
    @stack('css')
</head>

<body>
    @include('frontend._inc.header')
    @yield('breadcrumb')
    @yield('content')
    @include('frontend._inc.footer')
    @include('frontend._inc._script')
    @stack('js')
</body>

</html>
