@extends('layouts.front')

@section('content')

<div class="fh5co-narrow-content">
	<h2 class="fh5co-heading animate-box" data-animate-effect="fadeInLeft">รวมสติ๊กเกอร์ไลน์ชุดน่าสนใจ</h2>

	<table class="table table-striped">
        <thead>
            <tr>
                <th></th>
                <th>ชุด</th>
                <th>จำนวน</th>
            </tr>
        </thead>
        @foreach(@$rs as $row)
        <tr>
            <td class="align-middle">
                @if($row->seriesItem->first()->product_type == 'sticker')
                    <img src="https://sdl-stickershop.line.naver.jp/products/0/0/1/{{ $row->seriesItem->first()->product_code }}/android/main.png" height="60">
                @elseif($row->seriesItem->first()->product_type == 'emoji')
                    <img src="https://stickershop.line-scdn.net/sticonshop/v1/product/{{ $row->seriesItem->first()->product_code }}/iphone/main.png" height="60">
                @elseif($row->seriesItem->first()->product_type == 'theme')
                    <img src="https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/{{ $row->seriesItem->first()->product_code }}/1/WEBSTORE/icon_198x278.png" height="60">
                @endif
            </td>
            <td class="align-middle"><a href="{{ url('series/'. $row->id) }}">{{ $row->title }} @if($row->hilight == 1) <i class="fas fa-star fa-spin" style="color:#dc3545;"></i> @endif</a></td>
            <td class="align-middle">{{ $row->seriesItem->count() }}</td>
        </tr>
        @endforeach
    </table>

    {{ $rs->appends(@$_GET)->render() }}
</div>

@endsection
