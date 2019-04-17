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
            <form class="form-inline" method="POST" action="{{ url('/admin/promote') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="รหัส" name="product_code" value="">
                    <input type="text" class="form-control" placeholder="ประเภท" name="product_type" value="">
                    <input type="date" class="form-control" placeholder="วันที่เริ่ม" name="start_date" value="">
                    <input type="date" class="form-control" placeholder="วันที่สิ้นสุด" name="end_date" value="">
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
                        <th>สถานะ</th>
                        <th>จัดการ</th>
                    </tr>
                    @foreach($rs as $key=>$row)
                    <tr>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_type }}</td>
                        <td>{{ $row->start_date }}</td>
                        <td>{{ $row->end_date }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{!! $row->end_date >= Carbon::now()->toDateString() ? '<span class="label label-success">โปรโมท</span>' : '<span class="label label-danger">หมดเวลา</span>' !!}</td>
                        <td>
                            <form method="POST" action="{{ url('/admin/promote' . '/' . $row->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" title="Delete StAscc" onclick="return confirm(&quot;Confirm delete?&quot;)" style="border:none; background:none;">
                                    <i class="fa fa-fw fa-trash-o"></i>
                                </button>
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
    <script>
    $(document).ready(function(){
        //Date picker
        $('.datepicker').datepicker({
            autoclose: true
        })
    });
    </script>
@endpush