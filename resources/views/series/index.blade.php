@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">รวมสติ๊กเกอร์ไลน์ชุดน่าสนใจ</h2>

	<table class="table table-striped">
        <thead>
            <tr>
                {{-- <th>ลำดับ</th> --}}
                <th>ชุด</th>
                <th>จำนวน</th>
            </tr>
        </thead>
        @foreach(@$rs as $row)
        <tr>
            {{-- <td>{{ (($rs->currentPage() - 1 ) * $rs->perPage() ) + $loop->iteration }}</td> --}}
            <td><a href="{{ url('series/'. $row->id) }}">{{ $row->title }} {!! new_badge($row->created_at) !!}</a></td>
            <td>{{ $row->seriesItem->count() }}</td>
        </tr>
        @endforeach
    </table>

    {{ $rs->appends(@$_GET)->render() }}
</div>

@endsection
