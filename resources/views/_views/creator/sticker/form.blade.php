@extends('layouts.adminlte')

@section('content')


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
      <h1>
        General Form Elements
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">สติ๊กเกอร์ไลน์ (เพิ่มรายการ)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{Form::open(array('url'=>'creator/sticker/save', 'method'=>'post', 'class'=>'','id'=>'stickerFrm'))}}
              <div class="box-body">

                @if(count($errors))
                  <div class="alert alert-danger">
                    <strong>อุ๊บส์!</strong> ไม่สามารถบันทึกข้อมูลได้เนื่องจาก...
                    <br/>
                    <ul>
                      @foreach($errors->all() as $error)
                      <li>{!! $error !!}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <div class="form-group {{ $errors->has('sticker_code') ? 'has-error' : '' }}">
                  <label for="inputSticker_code">ตัวอย่าง : https://store.line.me/stickershop/product/<code><b>8994</b></code>/th</label>
                  <input id="inputSticker_code" type="text" class="form-control" name="sticker_code" placeholder="ใส่เฉพาะตัวเลขสีแดง" value="{{ old('sticker_code') }}">
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
              </div>
              <!-- /.box-footer -->
            {{Form::close()}}
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->


      {{-- comment
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Preview</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ค้นหาข้อมูล</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon">https://store.line.me/stickershop/product/</span>
                    <input type="text" class="form-control" placeholder="หมายเลขไอดีของสติ๊กเกอร์">
                    <span class="input-group-addon">/th</span>
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">ดึงข้อมูลสติ๊กเกอร์</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!--/.col (left) -->

        <!-- left column -->
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Detail</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">ค้นหาข้อมูล</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <span class="input-group-addon">https://store.line.me/stickershop/product/</span>
                    <input type="text" class="form-control" placeholder="หมายเลขไอดีของสติ๊กเกอร์">
                    <span class="input-group-addon">/th</span>
                  </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">ดึงข้อมูลสติ๊กเกอร์</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
      comment --}}

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
