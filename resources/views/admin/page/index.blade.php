@extends('adminlte::page')

@section('content_header')
    <h1>Sticker</h1>
@stop

@section('content')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">แสดงข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <a href="{{ url('admin/page/create') }}">
                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> เพิ่มรายการ</button>
            </a>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>สถานะ</th>
                        <th>หัวข้อ</th>
                        <th>จัดการ</th>
                    </tr>
                    @foreach($rs as $key=>$row)
                    <tr>
                        <td>
                            <input class="switch_status" type="checkbox" data-toggle="toggle" data-switch-id="<?php echo $row->id?>" <?php echo $row->status == 'approve' ? 'checked' : '' ;?>>
                        </td>
                        <td>{{ $row->title }}</td>
                        <td>
                            <a href="{{ url('/admin/page/' . $row->id . '/edit') }}" title="Edit StAscc">
                                <button type="button" class="btn btn-warning  btn-xs">แก้ไข</button>
                            </a>

                            <form method="POST" action="{{ url('/admin/page' . '/' . $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm(&quot;Confirm delete?&quot;)">ลบ</button>
                            </form>
                        </td>
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
                data:{ table : 'pages', status : $(this).prop('checked'), id : $(this).data('switch-id') },
                dataType: "json",
            });
        });
    });
    </script>
@endpush