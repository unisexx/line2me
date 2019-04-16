@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content">
    <div class="row">

        <div class="col-md-12 animate-box pageContent" data-animate-effect="fadeInLeft">
            <h1>{{ $rs->title }}</h1>
            {!! $rs->detail !!}
        </div>
        
    </div>

</div>

@endsection