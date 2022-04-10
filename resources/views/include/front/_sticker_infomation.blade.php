@if (!empty($rs->id))
<div class="sticker-infomation">
    <h3>{{ $type == 'sticker' ? $rs->title_th : $rs->title }} {{ $type == 'sticker' ?
        getStickerResourctTypeName($rs->stickerresourcetype) : '' }}
    </h3>
    @php
    $a = ['sticker'=>'S', 'theme'=>'T', 'emoji'=>'E']
    @endphp
    <ul>
        <li>รหัสสินค้า : {{ $a[$type] }}-{{ $type == 'sticker' ? $rs->sticker_code : $rs->id }}</li>
        <li>
            ราคา :
            @if($rs->price == 50)
            <span class="pl-2 text-danger">฿{{ convert_line_coin_2_money_full($rs->price) }} <b>(พิเศษซื้อชุด 35 บาท
                    ชุดใดก็ได้ 2 ชุดลดทันที 5
                    บาท)</b></span>
            @else
            <small class="text-muted"><del>฿{{ convert_line_coin_2_money_full($rs->price) }}</del></small>
            <span class="pl-2 text-danger"><b>฿{{ convert_line_coin_2_money($rs->price) }} มีเวลาจำกัด</b></span>
            @endif
        </li>
        <li>ประเภท : {{ $rs->category }}</li>
        <li>ประเทศ : {{ @countryName($rs->country) }}</li>
        @if ($rs->status == 0)
        <li>สถานะ : <span class="badge badge-danger">เลิกจำหน่าย</span></li>
        @endif
    </ul>
</div>
@endif