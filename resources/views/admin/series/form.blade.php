<div class="box-body">
    <div class="form-group">
        <label for="title">ชื่อ Series</label>
        <input name="title" type="text" class="form-control" id="title" value="{{ @$rs->title }}">
    </div>
    <input class="btn btn-warning addRow" type="button" value="เพิ่มรายการ">

    <div id="rowHere">
        <table class="table table-bordered">
            <tbody>
                @if(@$rs->seriesItem)
                @foreach(@$rs->seriesItem as $row)
                <tr>
                    <td>
                        <select class='form-control' name='product_type[]'>
                            <option value='sticker' @if($row->product_type == 'sticker') selected @endif>sticker</option>
                            <option value='theme' @if($row->product_type == 'theme') selected @endif>theme</option>
                            <option value='emoji' @if($row->product_type == 'emoji') selected @endif>emoji</option>
                        </select>
                    </td>
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
    </div>
</div>
<!-- /.box-body -->

<div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

@push('js')
<script>
$(document).ready(function(){
    $('.addRow').click(function(){
        
        var html = "";
        html += "<tr>";
        html += "<td><select class='form-control' name='product_type[]'><option value='sticker'>sticker</option><option value='theme'>theme</option><option value='emoji'>emoji</option></select></td>";
        html += "<td><input class='form-control' type='text' name='product_code[]'></td>";
        html += "<td><input class='form-control' type='hidden' name='product_item_id[]'><input class='btn btn-sm btn-danger btnDelete' value='ลบ'></td>";
        html += "</tr>";
        $('#rowHere table tbody').append(html);
    });

    $('body').on('click', '.btnDelete', function(){
        $(this).closest('tr').remove();
    });
});
</script>
@endpush