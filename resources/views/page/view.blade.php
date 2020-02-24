@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content pagecontent">
    <div class="row">
        <div class="col-md-12 animate-box pageContent" data-animate-effect="fadeInLeft">
            <h1>{{ $rs->title }}</h1>
            {!! $rs->detail !!}
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .pagecontent a{
        color:#da1212 !important;
    }
</style>
@endpush