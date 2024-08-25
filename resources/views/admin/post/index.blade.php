@extends('adminlte::page')

@section('content_header')
    <h1>Post</h1>
@stop

@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">เพิ่มข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- form start -->
            <form class="form-inline" method="POST" action="" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="date" class="form-control" placeholder="วันที่เริ่ม" name="start_date" value="{{ old('start_date', request('start_date', date('Y-m-d'))) }}">
                    <input type="date" class="form-control" placeholder="วันที่สิ้นสุด" name="end_date" value="{{ old('end_date', request('end_date', date('Y-m-d', strtotime('+1 day')))) }}">
                </div>
                <button type="submit" class="btn btn-default">บันทึก</button>
            </form>

        </div>
    </div>

    {{-- @dd($sticker) --}}

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ข้อความโปรโมท</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            สติ๊กเกอร์, ธีม และอีโมจิไลน์อัพเดทวันนี้มาแล้วครับ ({{ ThaiDate(old('start_date', request('start_date', date('Y-m-d')))) }})<br>
            .<br>
            @if (isset($sticker) && count($sticker) > 0)
                ============ สติ๊กเกอร์ไลน์ ============<br>
                @foreach ($sticker as $item)
                    - [<?php echo countryName($item->country); ?>] <?php echo $item->title_th; ?> <?= getStickerResourctTypeName($item->stickerresourcetype) ?>
                    <br>
                    <a href="https://www.line2me.in.th/poster/sticker/<?= $item->sticker_code ?>" target="_blank">poster</a>
                    <br>
                @endforeach
            @endif

            @if (isset($emoji) && count($emoji) > 0)
                .<br>============ สติ๊กเกอร์ไลน์ ============<br>
                @foreach ($emoji as $item)
                    - [<?php echo countryName($item->country); ?>] <?php echo $item->title; ?><br>
                    https://www.line2me.in.th/emoji/<?= $item->id ?><br>
                @endforeach
            @endif

            @if (isset($theme) && count($theme) > 0)
                .<br>============ ธีมไลน์ ============<br>
                @foreach ($theme as $item)
                    - [<?php echo countryName($item->country); ?>] <?php echo $item->title; ?><br>
                    https://www.line2me.in.th/theme/<?= $item->id ?><br>
                @endforeach
            @endif

            .<br>
            สามารถดูลายสติกเกอร์อัพเดททั้งหมดได้ที่<br>
            .<br>
            หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน<br>
            https://line.me/ti/p/~ratasak1234<br>
            .<br>
            สนใจชุดไหนสอบถามได้เลยนะครับ ^^<br>
            ขอบคุณมากครับผม<br>
            .<br>
            ===== สติ๊กเกอร์ไลน์ขายดีแนะนำ =====<br>
            https://line2me.in.th/series/24<br>
            .<br>
            ===== โปรโมชั่นสำหรับครีเอเตอร์ =====<br>
            สนใจโปรโมทสติ๊กเกอร์ไลน์ของท่านเพื่อเพิ่มยอดขาย (เฉลี่ยวันละ 2.7 บาท)<br>
            https://line2me.in.th/page/view/8<br>
            .<br>
            ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS แบบพรีเมี่ยม<br>
            #line2me #ของแท้ไม่มีหาย #LVS0157

            <div>
                <textarea rows="20" cols="100">
                    สติ๊กเกอร์, ธีม และอีโมจิไลน์อัพเดทวันนี้มาแล้วครับ ({{ ThaiDate(old('start_date', request('start_date', date('Y-m-d')))) }})
                    .
                    @if (isset($sticker) && count($sticker) > 0)
===== สติ๊กเกอร์ไลน์ =====
                        @foreach ($sticker as $item)
- [<?php echo countryName($item->country); ?>] <?php echo $item->title_th; ?> <?= getStickerResourctTypeName($item->stickerresourcetype) ?>
                            
https://www.line2me.in.th/sticker/<?= $item->sticker_code ?>
&nbsp;
@endforeach
@endif
                    
                    @if (isset($emoji) && count($emoji) > 0)
.&nbsp;
===== สติ๊กเกอร์ไลน์ =====
                        @foreach ($emoji as $item)
- [<?php echo countryName($item->country); ?>] <?php echo $item->title; ?>
                            
https://www.line2me.in.th/emoji/<?= $item->id ?>
&nbsp;
@endforeach
@endif
                    
                    @if (isset($theme) && count($theme) > 0)
.&nbsp;
===== ธีมไลน์ =====
                        @foreach ($theme as $item)
- [<?php echo countryName($item->country); ?>] <?php echo $item->title; ?>
                            
https://www.line2me.in.th/theme/<?= $item->id ?>
&nbsp;
@endforeach
@endif
                    
                    .
                    หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
                    https://line.me/ti/p/~ratasak1234
                    .
                    สนใจชุดไหนสอบถามได้เลยนะครับ ^^
                    ขอบคุณมากครับผม
                    .
                    ===== สติ๊กเกอร์ไลน์ขายดีแนะนำ =====
                    https://line2me.in.th/series/24
                    .
                    ===== โปรโมชั่นสำหรับครีเอเตอร์ =====
                    สนใจโปรโมทสติ๊กเกอร์ไลน์ของท่านเพื่อเพิ่มยอดขาย (เฉลี่ยวันละ 2.7 บาท)
                    https://line2me.in.th/page/view/8
                    .
                    ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS แบบพรีเมี่ยม
                    #line2me #ของแท้ไม่มีหาย #LVS0157
                    </textarea>
            </div>
        </div>
    </div>


@stop
