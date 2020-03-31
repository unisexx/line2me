@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">รวมสติ๊กเกอร์ไลน์ทางการอัพเดทใหม่ล่าสุด</h2>

	<table class="table table-striped">
        <thead>
            <tr>
                {{-- <th>ลำดับ</th> --}}
                <th>วันที่</th>
            </tr>
        </thead>
        @foreach(@$rs as $row)
        <tr>
            {{-- <td>{{ (($rs->currentPage() - 1 ) * $rs->perPage() ) + $loop->iteration }}</td> --}}
            <td><a href="{{ url('new_arrival/'. $row->id) }}">{{ ThaiDate($row->start_date) }} {!! new_badge($row->start_date) !!}</a></td>
        </tr>
        @endforeach
    </table>

    {{ $rs->appends(@$_GET)->render() }}
</div>

@endsection
