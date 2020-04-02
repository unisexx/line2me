<div class="box-body">
    <div class="form-group">
        <label for="title">ชื่อ</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="title" value="{{ isset($rs->title) ? $rs->title : ''}}">
    </div>
    <div class="form-group">
        <label for="creator_name">ผู้สร้าง</label>
        <input name="creator_name" type="text" class="form-control" id="creator_name" placeholder="creator_name" value="{{ isset($rs->creator_name) ? $rs->creator_name : ''}}">
    </div>
    <div class="form-group">
        <label for="detail">รายละเอียด</label>
        <textarea name="detail" class="form-control" rows="3" placeholder="detail">{!! isset($rs->detail) ? $rs->detail : '' !!}</textarea>
    </div>
    <div class="form-group">
        <label for="price">ราคา</label>
        <input name="price" type="text" class="form-control" id="price" placeholder="price" value="{{ isset($rs->price) ? $rs->price : '' }}">
    </div>
    <div class="form-group">
        <label for="status">เปิด / ปิดการใช้งาน</label>
        <input name="status" type="hidden" value="draft" checked="chedked" />
        <input name="status" type="checkbox" id="status" checked value="approve" {!! (@$rs->status == 'approve' || empty($rs->id)) ? 'checked="checked"' : '' !!} />
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="10">ทางผมได้นำอิโมจิ {{ $rs->title }} ขึ้นตำแหน่งโปรโมทเรียบร้อยครับผม โดยอิโมจิตำแหน่งนี้จะหมดอายุในวันที่  ขอบคุณมากครับ

ถ้ามีรูปสำหรับโปรโมทส่งให้ผมได้เลยนะครับ ผมจะได้เอาไปโพสต์ที่อื่นให้ด้วย</textarea>
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="10">แนะนำอิโมจิครีเอเทอร์ไทยยอดนิยม 

{{ $rs->title }}
{{ $rs->detail }}

สามารถดูลายสติ๊กเกอร์ได้ที่ 
http://line.me/S/sticker/{{ $rs->emoji_code }}
http://www.line2me.in.th/emoji/{{ $rs->id }}

หากเพื่อนๆคนไหนสนใจทักเข้ามาได้เลยครับที่ไลน์ไอดี @line2me.in.th หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
http://line.me/ti/p/~@line2me.in.th

ขอบคุณมากครับ ^^

ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS
#line2me #ของแท้ไม่มีหาย #LVS0157</textarea>
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>