@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">แนะนำจากทางร้าน</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">แนะนำจากทางร้าน</h2>
        <div class="row">
            @foreach ($rs as $row)
                <div class="col-12 col-lg-4 col-md-4 col-sm-6 mb-4">
                    <div class="col pl-2 pr-2">
                        <a href="{{ url('series/' . $row->id) }}">
                            <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- แสดงลิงก์การแบ่งหน้า -->
        <div class="d-flex justify-content-center">
            {{ $rs->appends(['query' => request()->input('query')])->links() }}
        </div>
    </div>
@endsection
