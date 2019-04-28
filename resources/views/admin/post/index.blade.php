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
            <textarea class="form-control" rows="20">สติ๊กเกอร์, ธีม และอีโมจิไลน์อัพเดทวันนี้มาแล้วครับ
<?=DBToDate($new_arrival->created_at)?>


===== สติ๊กเกอร์ไลน์ =====

<?foreach($sticker as $row):?>
- [<?php echo $row->country?>] <?php echo $row->title_th?> <?=getStickerResourctTypeName($row->stickerresourcetype)?>

https://www.line2me.in.th/sticker/<?=$row->sticker_code?>


<?endforeach;?>


===== ธีมไลน์ =====

<?foreach($theme as $row):?>
- [<?php echo $row->country?>] <?php echo $row->title?>

https://www.line2me.in.th/theme/<?=$row->id?>


<?endforeach;?>


===== อีโมจิไลน์ =====

<?foreach($emoji as $row):?>
- [<?php echo $row->country?>] <?php echo $row->title?>

https://www.line2me.in.th/emoji/<?=$row->id?>


<?endforeach;?>


สามารถดูลายสติกเกอร์อัพเดททั้งหมดได้ที่
https://linesticker.in.th/new_arrival

หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
https://line.me/ti/p/~ratasak1234

สนใจชุดไหนสอบถามได้เลยนะครับ ^^
ขอบคุณมากครับผม

https://www.line2me.in.th

#line2me #ของแท้ไม่มีหาย</textarea>
            </div>




            <div class="form-group">
            <textarea class="form-control" rows="20">
สติ๊กเกอร์ไลน์แนะนำยอดนิยมมาแล้วจ้า

<?foreach($sticker_promote as $row):?>
- <?php echo $row->title_th?> <?=getStickerResourctTypeName($row->stickerresourcetype)?>

https://www.line2me.in.th/sticker/<?=$row->sticker_code?>


<?endforeach;?>

<?if($theme_promote):?>
===== ธีมไลน์ =====

<?foreach($theme_promote as $row):?>
- <?php echo $row->title?>

https://www.line2me.in.th/theme/<?=$row->id?>

<?endforeach;?>
<?endif;?>


สามารถดูลายสติกเกอร์อัพเดททั้งหมดได้ที่
https://linesticker.in.th

หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
https://line.me/ti/p/~ratasak1234

สนใจชุดไหนสอบถามได้เลยนะครับ ^^
ขอบคุณมากครับผม

สนใจโปรโมทสติ๊กเกอร์ไลน์ของท่านคลิ๊ก
https://linesticker.in.th/page/view/8


https://www.line2me.in.th

#line2me #ของแท้ไม่มีหาย</textarea>
            </div>


        </div>
    </div>

@stop