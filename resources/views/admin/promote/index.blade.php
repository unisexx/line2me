@extends('adminlte::page')

@section('content_header')
    <h1>Sticker</h1>
@stop

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">เพิ่มข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- form start -->
            <form class="form-inline" method="GET" action="{{ url('/admin/sticker') }}" accept-charset="UTF-8">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="รหัส" name="product_code" value="">
                    <input type="text" class="form-control" placeholder="ประเภท" name="product_type" value="">
                    <input type="text" class="form-control" placeholder="วันที่เริ่ม" name="start_date" value="">
                    <input type="text" class="form-control" placeholder="วันที่สิ้นสุด" name="end_date" value="">
                    <input type="text" class="form-control" placeholder="อีเมล์" name="email" value="">
                </div>
                <button type="submit" class="btn btn-default">บันทึก</button>
            </form>
        </div>
    </div>

    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">แสดงข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>รหัส</th>
                        <th>ประเภท</th>
                        <th>วันที่เริ่ม</th>
                        <th>วันที่สิ้นสุด</th>
                        <th>อีเมล์</th>
                    </tr>
                    @foreach($rs as $key=>$row)
                    <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_type }}</td>
                        <td>{{ $row->start_date }}</td>
                        <td>{{ $row->end_date }}</td>
                        <td>{{ $row->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
            {{ $rs->appends(@$_GET)->render() }}
        </div>
    </div>

@stop

@push('js')
    <!-- สถานะ -->
    <!-- switch toggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
    $(function() {
        $(document).on('change', ".switch_status", function () {
            $.ajax({
                url: 'ajax/changestatus',
                data:{ table : 'stickers', status : $(this).prop('checked'), id : $(this).data('switch-id') },
                dataType: "json",
            });
        });
    });
    </script>

    <!-- ประเทศ -->
    <script>
    $(document).ready(function(){
        $('select[name=country]').change(function(){
            $.ajax({
                url: 'ajax/changecountry',
                data:{ table : 'stickers', country : $(this).val(), id : $(this).attr( 'rowid' ) },
                dataType: "json",
            });
        });
    });
    </script>
@endpush