<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Free Stickers LINE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>

</head>

<body class="bg-white overflow-hidden min-h-screen flex items-center justify-center">


    <div class="relative w-full max-w-[900px] mx-auto grid grid-cols-1 lg:grid-cols-4 gap-6 p-4 shadow-xl rounded-xl border-4 border-emerald-500 overflow-hidden bg-gradient-to-br from-emerald-50 via-white to-lime-100">

        {{-- 🌿 SVG ลาย background ตกแต่ง --}}
        <svg class="absolute opacity-10 inset-0 w-full h-full" preserveAspectRatio="xMidYMid slice" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <pattern id="gridPattern" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="1" cy="1" r="1" fill="#10b981" />
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#gridPattern)" />
        </svg>

        {{-- ✅ คอนเทนต์ทั้งหมดให้ซ้อนเหนือพื้นหลัง SVG --}}
        <div class="relative z-10 col-span-full">
            {{-- ด้านในใส่เนื้อหาปกติของคุณ --}}
            {{-- เช่น ฝั่งแสดงสินค้า และกล่องรายละเอียดฝั่งขวา --}}
        </div>



        {{-- ✅ ฝั่งซ้าย: แสดงสินค้า --}}
        <div class="lg:col-span-3">
            <h2 class="text-xl text-green-600 font-bold mb-4 text-center">📦 Stickers LINE อัพเดทวันที่ 10/04/2025</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4">
                @foreach ($products as $item)
                    @php
                        switch ($item->type) {
                            case 'sticker':
                                $image = get_sticker_img_url($item->stickerresourcetype, $item->version, $item->sticker_code);
                                $title = $item->title_th;
                                $badgeClass = 'bg-green-500 text-white';
                                break;
                            case 'theme':
                                $image = generateThemeUrl($item->theme_code, @$item->section);
                                $title = $item->title;
                                $badgeClass = 'bg-blue-600 text-white';
                                break;
                            case 'emoji':
                                $image = 'https://stickershop.line-scdn.net/sticonshop/v1/product/' . $item->emoji_code . '/iphone/main.png';
                                $title = $item->title;
                                $badgeClass = 'bg-yellow-400 text-black';
                                break;
                            default:
                                $image = asset('images/default.png');
                                $title = '-';
                                $badgeClass = 'bg-gray-400 text-white';
                        }
                        $countryCode = strtolower($item->country ?? 'xx');
                        $flagUrl = "https://flagcdn.com/w40/{$countryCode}.png";
                    @endphp

                    <div class="bg-gradient-to-b from-white via-emerald-50 to-white border-2 border-emerald-200 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">

                        <div class="aspect-square w-full">
                            <img src="{{ $image }}" class="w-full h-full object-cover" alt="{{ $title }}">
                        </div>
                        <div class="p-2 text-center">
                            <h6 class="text-sm font-medium mb-1 truncate">{{ $title }}</h6>

                            @if (!empty($item->price))
                                <div class="text-pink-600 text-sm font-semibold">
                                    {{ @convert_line_coin_2_money($item->price) }} บาท
                                </div>
                            @endif

                            <div class="flex items-center justify-center gap-1 text-xs text-gray-500 my-1">
                                <img src="{{ $flagUrl }}" class="w-5 h-3 object-cover rounded border" alt="{{ $item->country }}">
                                <span>{{ strtoupper($item->country) }}</span>
                            </div>

                            <span class="text-xs px-2 py-0.5 rounded {{ $badgeClass }}">
                                {{ strtoupper($item->type) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ✅ ฝั่งขวา: กล่องรายละเอียด พร้อม Wave + QR --}}
        <div class="relative rounded-xl overflow-hidden shadow-md text-white text-center flex flex-col items-center justify-center bg-gradient-to-br from-green-100 via-white to-lime-100">


            {{-- ✅ Wave ด้านบน --}}
            <svg class="absolute top-0 left-0 w-full h-24 z-0" viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M0,40 C150,100 350,0 500,60 L500,00 L0,0 Z" style="stroke: none; fill: #a7f3d0;"></path>
                <path d="M0,60 C200,120 300,20 500,80 L500,00 L0,0 Z" style="stroke: none; fill: #d1fae5; opacity: 0.6;"></path>
            </svg>

            {{-- ✅ Wave ด้านล่าง --}}
            <svg class="absolute bottom-0 left-0 w-full h-24 z-0" viewBox="0 0 500 150" preserveAspectRatio="none">
                <path d="M0,100 C150,40 350,150 500,80 L500,150 L0,150 Z" style="stroke: none; fill: #a7f3d0;"></path>
                <path d="M0,80 C200,20 300,130 500,60 L500,150 L0,150 Z" style="stroke: none; fill: #d1fae5; opacity: 0.6;"></path>
            </svg>

            {{-- ✅ เนื้อหาทับด้านหน้า --}}
            <div class="relative z-10 p-6 w-full">
                <div class="bg-white bg-opacity-80 rounded-lg px-4 py-6 shadow-inner">
                    {{-- โลโก้ LINE --}}
                    <div class="rounded-full shadow mx-auto w-14 h-14 overflow-hidden mb-3">
                        <img src="{{ asset('image/profile.png') }}" class="w-full h-full object-cover rounded-full" alt="LINE Logo">
                    </div>


                    {{-- ชื่อร้าน --}}
                    <h3 class="text-xl font-bold text-green-800 mb-1">@line2me</h3>

                    {{-- คำอธิบาย --}}
                    <p class="text-sm text-gray-700 leading-relaxed">
                        ขายสติกเกอร์ไลน์ลิขสิทธิ์แท้ 100% <br>
                        จากร้านที่ได้รับอนุญาต (Verified Reseller)
                    </p>

                    {{-- ประสบการณ์ --}}
                    <div class="text-green-900 text-sm font-semibold mt-3">
                        🏆 ให้บริการมากว่า <span class="underline decoration-green-500">10 ปี</span>
                    </div>

                    {{-- ✅ QR Code --}}
                    <div class="mt-4 flex flex-col items-center">
                        <img src="{{ asset('image/qr_poster.png') }}" class="w-24 h-24 rounded-md shadow" alt="QR Code แอดไลน์">
                        <p class="text-xs text-gray-700 mt-1">สแกนเพื่อเพิ่มเพื่อนบน LINE</p>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="mt-8 w-full max-w-[900px] mx-auto">
        <h2 class="text-xl text-emerald-600 font-bold mb-4 text-center">📋 ข้อความแนะนำสำหรับโพสต์</h2>

        <textarea id="postText" rows="30" readonly class="w-full p-4 text-sm border border-green-500 rounded-md bg-gray-50 font-mono leading-relaxed">
            ✨ สติ๊กเกอร์, ธีม และอีโมจิไลน์ อัปเดตใหม่ล่าสุด! ({{ \Carbon\Carbon::now()->format('j M Y') }}) ✨

            ■■■■■■■■■■■■■■■■■■■■■■
            ■ 🟩 สติ๊กเกอร์ไลน์
            ■■■■■■■■■■■■■■■■■■■■■■
            @foreach ($products->where('type', 'sticker') as $item)
- [{{ strtoupper($item->country) }}] {{ $item->title_th }}
              https://line2me.in.th/sticker/{{ $item->sticker_code }}
@endforeach

            ■■■■■■■■■■■■■■■■■■■■■■
            ■ 🎨 ธีมไลน์
            ■■■■■■■■■■■■■■■■■■■■■■
            @foreach ($products->where('type', 'theme') as $item)
- [{{ strtoupper($item->country) }}] {{ $item->title }}
              https://line2me.in.th/theme/{{ $item->id }}
@endforeach

            ■■■■■■■■■■■■■■■■■■■■■■
            ■ 😄 อิโมจิไลน์
            ■■■■■■■■■■■■■■■■■■■■■■
            @foreach ($products->where('type', 'emoji') as $item)
- [{{ strtoupper($item->country) }}] {{ $item->title }}
              https://line2me.in.th/emoji/{{ $item->id }}
@endforeach

            ━━━━━━━━━━━━━━━━━━━━━━━

            📲 เพิ่มเพื่อน LINE ร้านค้า: https://line.me/ti/p/~@line2me
            💬 สนใจชุดไหนเพิ่มเติมสอบถามได้เลยครับ

            🔥 แนะนำ! สติ๊กเกอร์ขายดี → https://line2me.in.th/featured/stickers
            📢 โปรโมทสติกเกอร์ของคุณเริ่มต้นวันละ 2.7 บาท → https://line2me.in.th/page/promote

            ✅ ร้านได้รับอนุญาตจาก LINE STICKERS (LVS0157)
            #line2me #สติ๊กเกอร์แท้ #ไลน์สติกเกอร์อัปเดต
            </textarea>






        <button onclick="copyText()" class="mt-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm rounded shadow">
            📋 คัดลอกข้อความ
        </button>
    </div>

    <script>
        function copyText() {
            const textArea = document.getElementById("postText");

            // เลือกข้อความ
            textArea.select();
            textArea.setSelectionRange(0, 99999); // รองรับมือถือ

            // คัดลอก
            document.execCommand("copy");

            // แจ้งผล
            alert("คัดลอกข้อความเรียบร้อยแล้ว!");
        }
    </script>


</body>

</html>
