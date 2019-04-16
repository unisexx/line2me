@extends('layouts.adminlte')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">ธีมไลน์</h3>
              <a href="{{ url('creator/theme/form') }}">
                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> เพิ่มรายการ</button>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="tableSticker" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th data-priority="1">รูป</th>
                  <th>ชื่อ</th>
                  <th>รายละเอียด</th>
                  <th>ราคา</th>
                  <th data-orderable="false" data-priority="2">จัดการ</th>
                </tr>
                </thead>
                <tbody>
                	@foreach($rs as $row)
                		<tr>
		                  <td><img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png" width="60" height="84"></td>
		                  <td>{{ $row->name }}</td>
		                  <td>{{ $row->description }}</td>
		                  <td>{{ $row->price }}</td>
		                  <td>
		                  	<a href="creator/theme/update/{{ $row->id }}" onclick="return confirm('ต้องการอัพเดทข้อมูลรายการนี้')"><button type="button" class="btn btn-warning  btn-xs">อัพเดทข้อมูล</button></a>
		                  	<a href="creator/theme/delete/{{ $row->id }}" onclick="return confirm('ต้องการลบรายการนี้')"><button type="button" class="btn btn-danger btn-xs">ลบ</button></a>
		                  	<a href="creator/theme/up/{{ $row->id }}" onclick="return confirm('ต้องการดันข้อมูลนี้')"><button type="button" class="btn btn-primary btn-xs">ดันข้อมูลขึ้นบนสุด</button></a>
		                  </td>
		                </tr>
                	@endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    @widget('backendAds')
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
