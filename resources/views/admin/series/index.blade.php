@extends('adminlte::page')

@section('content_header')
    <h1>Series</h1>
@stop

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ค้นหา</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- form start -->
            <form class="form-inline" method="GET" action="{{ url('/admin/sticker') }}" accept-charset="UTF-8" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="ชื่อ, รหัส" name="search" value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-default">ค้นหา</button>
            </form>
        </div>
    </div>

    
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">แสดงข้อมูล</h3>
            <a class="btn btn-success" href="/admin/series/create">เพิ่มข้อมูล</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th>จัดการ</th>
                    </tr>
                    @foreach($rs as $key=>$row)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/series/' . $row->id . '/edit') }}">
                                {{ $row->title }} 
                                @if($row->hilight == 1)
                                    <i class="fas fa-star fa-spin" style="color:#dc3545;"></i>
                                @endif
                            </a>
                        </td>
                        <td>{{ $row->seriesItem->count() }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ url('/admin/series/' . $row->id . '/edit') }}" title="Edit">แก้ไข</a>

                            <form method="POST" action="{{ url('/admin/series' . '/' . $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button class="btn btn-danger" type="submit" title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;)">ลบ</button>
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
    {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
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
    </script> --}}
@endpush