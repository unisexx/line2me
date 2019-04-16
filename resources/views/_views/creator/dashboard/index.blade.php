@extends('layouts.adminlte')

@section('content')

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
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{ $sticker_count }}</h3>

            <p>Sticker</p>
          </div>
          <div class="icon">
            <i class="fa fa-optin-monster"></i>
          </div>
          <a href="{{ url('creator/sticker') }}" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ $theme_count }}</h3>

            <p>Theme</p>
          </div>
          <div class="icon">
            <i class="fa fa-map-o"></i>
          </div>
          <a href="{{ url('creator/theme') }}" class="small-box-footer">
            More info
            <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row">
      <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <i class="fa fa-edit"></i>

              <h3 class="box-title">{{ $page->title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! $page->description !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


@endsection
