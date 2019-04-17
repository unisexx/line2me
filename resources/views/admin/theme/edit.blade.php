@extends('adminlte::page')

@section('content_header')
    <h1>Theme (เพิ่ม / แก้ไข)</h1>
@stop

@section('content')
    
    @if ($errors->any())
    <ul class="alert alert-danger list-unstyled">
        <li><b>ไม่สามารถบันทึกได้เนื่องจาก</b></li>
        @foreach ($errors->all() as $error)
        <li>- {{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Quick Example</h3>
        </div>

        <form method="POST" action="{{ url('/admin/theme/' . $rs->id) }}" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}

            @include ('admin.theme.form', ['formMode' => 'edit'])
        </form>
    </div>

@stop
