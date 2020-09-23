<div class="box-body">
    <div class="form-group">
<textarea class="form-control" rows="5">รวมสติ๊กเกอร์ไลน์ชุด {{ @$rs->title }}

สามารถดูทั้งหมดได้ที่
https://line2me.in.th/series/{{ @$rs->id }}

หากเพื่อนๆสนใจสามารถติดต่อได้ที่ไอดี @line2me.in.th หรือจิ้มลิ้งค์ด้านล่างนี้เพื่อแอดไอดีร้าน
https://line.me/ti/p/~@line2me.in.th

สนใจชุดไหนสอบถามได้เลยนะครับ ^^
ขอบคุณมากครับผม

ร้านค้าที่ได้รับอนุญาตจาก LINE STICKERS
#line2me #ของแท้ไม่มีหาย #LVS0157</textarea>
    </div>
</div>

<div class="box-body">
    <div class="form-group">
        <label for="title">ชื่อ Series</label>
        <div><input name="title" type="text" class="form-control" value="{{ @$rs->title }}" placeholder="หัวข้อหลัก"></div>
        <div><input name="sub_title" type="text" class="form-control" value="{{ @$rs->sub_title }}" placeholder="หัวข้อรอง"></div>
        <div><input name="image" type="text" class="form-control" value="{{ @$rs->image }}" placeholder="ลิ้งค์รูป"></div>
        <div class="checkbox">
            <label>
                <input name="hilight" type="hidden" value="0" checked>
                <input name="hilight" type="checkbox" value="1" @if(@$rs->hilight == 1) checked @endif> ไฮไลท์
            </label>
        </div>
    </div>
    <input class="btn btn-warning addRow" type="button" value="เพิ่มรายการ">

    <div id="rowHere">
        <table id="simpleList" class="table table-bordered">
            <tbody>
                @if(@$rs->seriesItem)
                @foreach(@$rs->seriesItem as $row)
                <tr>
                    <td>
                        @if($row->product_type == 'sticker')
                            <a href="{{ url('sticker/'.@$row->sticker->id) }}" target="_blank"><img src="https://sdl-stickershop.line.naver.jp/products/0/0/1/{{ $row->product_code }}/android/main.png" height="45"></a> {{ @$row->sticker->id }}
                            @if(@$row->sticker->id == '')
                                <a href="{{ url('admin/getsticker/'.$row->product_code) }}" class="btn btn-sm btn-warning" target="_blank">อัพเดท</a>
                            @endif
                        @elseif($row->product_type == 'emoji')
                            <a href="{{ url('emoji/'.@$row->emoji->id) }}" target="_blank"><img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->product_code }}/iphone/main.png" height="45"></a> {{ @$row->emoji->id }}
                            @if(@$row->emoji->id == '')
                                <a href="{{ url('admin/getemoji/'.$row->product_code) }}" class="btn btn-sm btn-warning" target="_blank">อัพเดท</a>
                            @endif
                        @elseif($row->product_type == 'theme')
                            <a href="{{ url('theme/'.@$row->theme->id) }}" target="_blank"><img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->product_code }}/1/WEBSTORE/icon_198x278.png" height="60"></a> {{ @$row->theme->id }}
                            @if(@$row->theme->id == '')
                                <a href="{{ url('admin/gettheme/'.$row->product_code) }}" class="btn btn-sm btn-warning" target="_blank">อัพเดท</a>
                            @endif
                        @endif
                    </td>
                    {{-- <td>
                        <select class='form-control' name='product_type[]'>
                            <option value='sticker' @if($row->product_type == 'sticker') selected @endif>sticker</option>
                            <option value='theme' @if($row->product_type == 'theme') selected @endif>theme</option>
                            <option value='emoji' @if($row->product_type == 'emoji') selected @endif>emoji</option>
                        </select>
                    </td> --}}
                    <td><input class='form-control' type='text' name='product_code[]' value="{{ $row->product_code }}"></td>
                    <td>
                        <input class='form-control' type='hidden' name='product_item_id[]' value="{{ $row->id }}">
                        <input class='btn btn-sm btn-danger btnDelete' value='ลบ'>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <input class="btn btn-warning addRow" type="button" value="เพิ่มรายการ">
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

@push('css')
<link href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" rel="stylesheet">
@endpush

@push('js')
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
$(document).ready(function(){
    $( "tbody" ).sortable({
        helper: fixWidthHelper,
        // update: function( ) {
        //     alert('drop');
        // }
    }).disableSelection();

    $('.addRow').click(function(){
        var html = "";
        html += "<tr>";
        html += "<td></td>";
        // html += "<td><select class='form-control' name='product_type[]'><option value='sticker'>sticker</option><option value='theme'>theme</option><option value='emoji'>emoji</option></select></td>";
        html += "<td><input class='form-control' type='text' name='product_code[]'></td>";
        html += "<td><input class='form-control' type='hidden' name='product_item_id[]'><input class='btn btn-sm btn-danger btnDelete' value='ลบ'></td>";
        html += "</tr>";
        $('#rowHere table tbody').append(html);
    });

    $('body').on('click', '.btnDelete', function(){
        $(this).closest('tr').remove();
    });
});

function fixWidthHelper(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
}
</script>
@endpush