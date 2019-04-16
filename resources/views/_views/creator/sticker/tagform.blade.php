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
              <h3 class="box-title">สติ๊กเกอร์ไลน์ (เพิ่มแท็ก,คำค้นหา)</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {{Form::open(array('url'=>'creator/sticker/tagsave', 'method'=>'post', 'class'=>'','id'=>'stickerFrm'))}}
              <div class="box-body">
                <dl>
                  <dt>การใส่ Tags หรือคำค้นหาให้ได้ประสิทธิภาพมากที่สุด</dt>
                  <dd>- ใส่ตามคำพูดที่อยู่ในสติ๊กเกอร์</dd>
                  <dd>- ถ้าหากสติ๊กเกอร์ไม่มีคำพูด ให้ใส่ตามอารมณ์, ความรู้สึกของตัวสติ๊กเกอร์ ตัวอย่าง ดีใจ, เสียใจ, โกรธ, งอน เป็นต้น</dd>
                  <dd>- ไม่ควรใส่คำที่ไม่เกี่ยวข้องหรือไม่สื่อความหมาย เพราะจะทำให้การค้นหาสติกเกอร์ของเราดูไม่น่าเชื่อถือ</dd>
                  <dd>- หากสติ๊กเกอร์นี้สื่อได้หลายความหมาย ให้คั่นระหว่างคำด้วยเครื่องหมายจุลภาค ( , )</dd>
                </dl>
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
                
                @foreach($rs->stamp()->get() as $key=>$row)
                  <div class="col-xs-12 col-sm-3 col-md-3">
                    <div class="panel panel-default">
                      <div class="panel-body {{ $errors->has('tag.'.$key) ? 'has-error' : '' }}">
                        <div class="img-cover">
                        <img src="https://stickershop.line-scdn.net/stickershop/v{{ $row->version }}/sticker/{{ $row->stamp_code }}/android/sticker.png;compress=true" height="120" width="120">
                        </div>
                        <input type="hidden" name="id[]" value="{{ $row->id }}">
                        <input type="hidden" name="stamp_code[]" value="{{ $row->stamp_code }}">
                        <textarea id="tag.{{ $key }}" name="tag[]" style="width:100%;">{{ @$row->tag ? @$row->tag : old('tag.'.$key) }}</textarea>
                      </div>
                    </div>
                  </div>
                @endforeach
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="sticker_id" value="{{ $rs->id }}"> 
                <a href="creator/sticker" class="btn btn-default">< กลับหน้าสติ๊กเกอร์</a>
                <button type="submit" class="btn btn-info pull-right">บันทึกข้อมูล</button>
              </div>
              <!-- /.box-footer -->
            {{Form::close()}}
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection
