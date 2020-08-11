@extends('adminlte::page')

@section('content_header')
    <h1>Post</h1>
@stop

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ข้อความโปรโมท</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="form-group">
            <textarea class="form-control" rows="20">สติ๊กเกอร์, ธีม และอีโมจิไลน์อัพเดทวันนี้มาแล้วครับ ({{ ThaiDate($new_arrival->start_date) }})
@if(count($sticker) != 0)

===== สติ๊กเกอร์ไลน์ =====
<?foreach($sticker as $row):?>
- [<?php echo countryName($row->country)?>] <?php echo $row->title_th?> <?=getStickerResourctTypeName($row->stickerresourcetype)?>

https://www.line2me.in.th/sticker/<?=$row->sticker_code?>


<?endforeach;?>
@endif
@if(count($emoji) != 0)
===== อีโมจิไลน์ =====
<?foreach($emoji as $row):?>
- [<?php echo countryName($row->country)?>] <?php echo $row->title?>

https://www.line2me.in.th/emoji/<?=$row->id?>


<?endforeach;?>
@endif
@if(count($theme) != 0)
===== ธีมไลน์ =====
<?foreach($theme as $row):?>
- [<?php echo countryName($row->country)?>] <?php echo $row->title?>

https://www.line2me.in.th/theme/<?=$row->id?>


<?endforeach;?>
@endif

สามารถดูลายสติกเกอร์อัพเดททั้งหมดได้ที่
https://line2me.in.th/new_arrival/<?=$new_arrival->id?>


หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
https://line.me/ti/p/~ratasak1234

สนใจชุดไหนสอบถามได้เลยนะครับ ^^
ขอบคุณมากครับผม

===== สติ๊กเกอร์ไลน์ขายดีแนะนำ =====
https://line2me.in.th/series/24

===== โปรโมชั่นสำหรับครีเอเตอร์ =====
สนใจโปรโมทสติ๊กเกอร์ไลน์ของท่านเพื่อเพิ่มยอดขาย (เฉลี่ยวันละ 2.7 บาท)
https://line2me.in.th/page/view/8

ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS แบบพรีเมี่ยม
#line2me #ของแท้ไม่มีหาย #LVS0157</textarea>
            </div>




            <div class="form-group">
            <textarea class="form-control" rows="20">
สติ๊กเกอร์ไลน์แนะนำยอดนิยมมาแล้วจ้า

@if(count($sticker_promote) != 0)
<?foreach($sticker_promote as $row):?>
- <?php echo $row->sticker->title_th?> <?=getStickerResourctTypeName($row->sticker->stickerresourcetype)?>

https://www.line2me.in.th/sticker/<?=$row->sticker->sticker_code?>


<?endforeach;?>
@endif

@if(count($emoji_promote) != 0)
===== อิโมจิไลน์ =====

<?foreach($emoji_promote as $row):?>
- <?php echo $row->emoji->title?>

https://www.line2me.in.th/theme/<?=$row->emoji->id?>

<?endforeach;?>
@endif

@if(count($theme_promote) != 0)
===== ธีมไลน์ =====

<?foreach($theme_promote as $row):?>
- <?php echo $row->theme->title?>

https://www.line2me.in.th/theme/<?=$row->theme->id?>

<?endforeach;?>
@endif
สามารถดูลายสติกเกอร์อัพเดททั้งหมดได้ที่
https://linesticker.in.th

หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
https://line.me/ti/p/~ratasak1234

สนใจชุดไหนสอบถามได้เลยนะครับ ^^
ขอบคุณมากครับผม

===== โปรโมชั่นสำหรับครีเอเตอร์ =====
สนใจโปรโมทสติ๊กเกอร์ไลน์ของท่านเพื่อเพิ่มยอดขาย (เฉลี่ยวันละ 2.7 บาท)
https://line2me.in.th/page/view/8

https://www.line2me.in.th

ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS แบบพรีเมี่ยม
#line2me #ของแท้ไม่มีหาย #LVS0157</textarea>
            </div>


        </div>
    </div>

@stop
