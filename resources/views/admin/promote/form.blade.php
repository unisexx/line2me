<div class="box-body">
    <div class="form-group">
        <label for="title_th">ชื่อ (ภาษาไทย)</label>
        <input name="title_th" type="text" class="form-control" id="title_th" placeholder="title_th" value="{{ isset($rs->title_th) ? $rs->title_th : ''}}">
    </div>
    <div class="form-group">
        <label for="title_en">ชื่อ (ภาษาอังกฤษ)</label>
        <input name="title_en" type="text" class="form-control" id="title_en" placeholder="title_en" value="{{ isset($rs->title_en) ? $rs->title_en : ''}}">
    </div>
    <div class="form-group">
        <label for="author_th">ผู้สร้าง (ภาษาไทย)</label>
        <input name="author_th" type="text" class="form-control" id="author_th" placeholder="author_th" value="{{ isset($rs->author_th) ? $rs->author_th : ''}}">
    </div>
    <div class="form-group">
        <label for="author_en">ผู้สร้าง (ภาษาอังกฤษ)</label>
        <input name="author_en" type="text" class="form-control" id="author_en" placeholder="author_en" value="{{ isset($rs->author_en) ? $rs->author_en : ''}}">
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
        <label for="stamp_start">สแตมป์เริ่มต้น</label>
        <input name="stamp_start" type="text" class="form-control" id="stamp_start" placeholder="stamp_start" value="{{ isset($rs->stamp_start) ? $rs->stamp_start : '' }}">
    </div>
    <div class="form-group">
        <label for="stamp_end">สแตมป์สิ้นสุด</label>
        <input name="stamp_end" type="text" class="form-control" id="stamp_end" placeholder="stamp_end" value="{{ isset($rs->stamp_end) ? $rs->stamp_end : '' }}">
    </div>
    <tr>
        <th>เปิด / ปิดการใช้งาน</th>
        <td>
            <input name="status" type="hidden" value="draft" checked="chedked" />
            <input name="status" type="checkbox" id="status" checked value="approve" {!! (@$rs->status == 'approve' || empty($rs->id)) ? 'checked="checked"' : '' !!} />
        </td>
    </tr>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>