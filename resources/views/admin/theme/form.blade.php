<div class="box-body">
    <div class="form-group">
        <label for="title">ชื่อ</label>
        <input name="title" type="text" class="form-control" id="title" placeholder="title" value="{{ isset($rs->title) ? $rs->title : ''}}">
    </div>
    <div class="form-group">
        <label for="author">ผู้สร้าง</label>
        <input name="author" type="text" class="form-control" id="author" placeholder="author" value="{{ isset($rs->author) ? $rs->author : ''}}">
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
        <img class="" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_001_720x1232.png" style="margin:10px;" width="90">
        <img class="" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_002_720x1232.png" style="margin:10px;" width="90">
        <img class="" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_003_720x1232.png" style="margin:10px;" width="90">
        <img class="" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_004_720x1232.png" style="margin:10px;" width="90">
        <img class="" src="http://sdl-shop.line.naver.jp/themeshop/v1/products/li/st/kr/{{ $rs->theme_code }}/1/ANDROID/th/preview_005_720x1232.png" style="margin:10px;" width="90">
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="10">ธีมใหม่มาแล้วจ้ากับ {{ $rs->title }}
{{ $rs->detail }}

หากเพื่อนๆคนไหนสนใจทักเข้ามาได้เลยครับที่ไลน์ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
http://line.me/ti/p/~ratasak1234

สำหรับธีมนี้ราคา {{ $rs->price }} บาทครับผม

ขอบคุณมากครับ ^^

สามารถดูลายของธีมได้ที่ 
line://shop/theme/detail?id={{ $rs->theme_code }}
http://www.line2me.in.th/theme/{{ $rs->id }}

---------------------------
โสด เหงา หาเพื่อน หาแฟน แลกไอดีไลน์
https://www.addfriend.in.th


#line2me #ของแท้ไม่มีหาย</textarea>
</div>
<div class="form-group">
<textarea class="form-control" rows="10">แนะนำธีมครีเอเทอร์ไทยยอดนิยม 

{{ $rs->title }}
{{ $rs->detail }}


สามารถดูลายของธีมได้ที่ 
line://shop/theme/detail?id={{ $rs->theme_code }}
http://www.line2me.in.th/theme/{{ $rs->id }}


หากเพื่อนๆคนไหนสนใจทักเข้ามาได้เลยครับที่ไลน์ไอดี ratasak1234 หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
http://line.me/ti/p/~ratasak1234

ขอบคุณมากครับ ^^


#line2me #ของแท้ไม่มีหาย
</textarea>

    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>