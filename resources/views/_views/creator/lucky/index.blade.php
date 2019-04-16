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
                        <h3 class="box-title">Lucky Draw</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <dl>
                            <dt>หลักการทำงาน</dt>
                            <dd>- รายการที่แสดงด้านล่างคือรายการที่สุ่มได้รับการโพสต์โปรโมทลงในเพจ <a href="https://www.facebook.com/line2me.in.th/"
                                    target="_blank">line2me.in.th</a></dd>
                            <dd>- วันไหนที่หน้าเพจไม่มีการเคลื่อนไหว ระบบ lucky draw จะทำงาน โดยการสุ่ม 1 สติ๊กเกอร์
                                และ 1 ธีม ในระบบเพื่อโพสต์ลงโปรโมทในเพจ</dd>
                            <dd>- เป็นระบบอัติโนมัติ ไม่สามารถบอกเวลาการสุ่มที่แน่นอนได้</dd>
                            <dd>-
                                ทุกครั้งเป็นระบบสุ่มจากข้อมูลที่มีอยู่ในเว็บทั้งหมดดังนั้นมีโอกาสที่จะสุ่มเจอซ้ำได้นะครับ
                                (อนาคตอาจเปลี่ยนเงื่อนไขใหม่ตามความเหมาะสม)</dd>
                        </dl>

                        <table id="tableSticker" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th data-priority="1">รูป</th>
                                    <th data-priority="2">หัวข้อ</th>
                                    <th>เวลา</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rs as $row)
                                <tr>
                                    @if($row->type == 1)
                                    <td><img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ @$row->sticker->version }}/{{ @$row->sticker->sticker_code }}/android/thumbnail.png"></td>
                                    <td><a href="{{ url('sticker/'.@$row->sticker->slug) }}" target="_blank">{{ @$row->sticker->name }}</a></td>
                                    @elseif($row->type == 2)
                                    <td><img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme->theme_path }}/WEBSTORE/icon_136x190.png"
                                            width="60" height="84"></td>
                                    <td><a href="{{ url('theme/'.$row->theme->slug) }}" target="_blank">{{
                                            $row->theme->name }}</a></td>
                                    @endif
                                    <td>{{ $row->created_at }}</td>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection
