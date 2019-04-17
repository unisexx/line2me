@extends('adminlte::page')

@section('content_header')
    <h1>Theme</h1>
@stop

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ค้นหา</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <!-- form start -->
            <form class="form-inline" method="GET" action="{{ url('/admin/theme') }}" accept-charset="UTF-8" role="search">
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option value="">ทั้งหมด</option>
                        <option value="official" {{ request('category') == 'official' ? 'selected' : '' }}>official</option>
                    </select>
                    <input type="text" class="form-control" id="search" placeholder="ชื่อ, รหัส" name="search" value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-default">ค้นหา</button>
            </form>

            <div class="pull-right">https://line2me.in.th/admin/gettheme/{theme_code}</div>
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
                        <th>สถานะ</th>
                        <th>ประเภท</th>
                        <th>ประเทศ</th>
                        <th>รหัส</th>
                        <th>รูป</th>
                        <th>ชื่อ</th>
                    </tr>
                    @foreach($rs as $key=>$row)
                    <tr>
                        <td>
                            <input class="switch_status" type="checkbox" data-toggle="toggle" data-switch-id="<?php echo $row->id?>" <?php echo $row->status == 'approve' ? 'checked' : '' ;?>>
                        </td>
                        <td>
                            <select name="category" rowid=<?=$row->id?>>
                                <option value="official" <?php echo ($row->category == 'official')?'selected=selected':'';?>>official</option>
                                <option value="creator" <?php echo ($row->category == 'creator')?'selected=selected':'';?>>creator</option>
                            </select>
                        </td>
                        <td>
                            <select name="country" rowid=<?=$row->id?>>
                                <option value="global" <?php echo ($row->country == 'global')?'selected=selected':'';?>>ทั่วโลก</option>
                                <option value="thai" <?php echo ($row->country == 'thai')?'selected=selected':'';?>>ไทย</option>
                                <option value="japan" <?php echo ($row->country == 'japan')?'selected=selected':'';?>>ญี่ปุ่น</option>
                                <option value="taiwan" <?php echo ($row->country == 'taiwan')?'selected=selected':'';?>>ไต้หวัน</option>
                                <option value="indonesia" <?php echo ($row->country == 'indonesia')?'selected=selected':'';?>>อินโดนีเซีย</option>
                            </select>
                        </td>
                        <td>{{ $row->theme_code }}</td>
                        <td><img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/<?=$row->theme_code?>/1/WEBSTORE/icon_198x278.png" width="90"></td>
                        <td>
                            <a href="{{ url('/admin/theme/' . $row->theme_code . '/edit') }}">
                                {{ $row->title }}
                            </a>
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
                data:{ table : 'themes', status : $(this).prop('checked'), id : $(this).data('switch-id') },
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
                data:{ table : 'themes', country : $(this).val(), id : $(this).attr( 'rowid' ) },
                dataType: "json",
            });
        });
    });
    </script>

    <!-- ประเภท -->
    <script>
    $(document).ready(function(){
        $('select[name=category]').change(function(){
            $.ajax({
                url: 'ajax/changecategory',
                data:{ table : 'themes', category : $(this).val(), id : $(this).attr( 'rowid' ) },
                dataType: "json",
            });
        });
    });
    </script>
@endpush