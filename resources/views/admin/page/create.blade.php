@extends('adminlte::page')

@section('content_header')
    <h1>Page</h1>
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

<form method="POST" action="{{ url('/admin/page') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    @include ('admin.page.form', ['formMode' => 'create'])
</form>

@endsection
