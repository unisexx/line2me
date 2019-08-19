@extends('adminlte::page')

@section('content_header')
    <h1>Crawler</h1>
@stop

@section('content')

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">ดึงข้อมูล</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

        <form class="form-inline">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td>สติ๊กเกอร์ไลน์</td>
                        <td>
                            {{ url('/') }}/admin/getsticker/<input class="form-control" type="text" name="sticker_code" placeholder="sticker_code">
                            <button id="GetStickerBtn" type="button" class="btn btn-primary">GetSticker</button>
                        </td>
                    </tr>
                    <tr>
                        <td>ธีมไลน์</td>
                        <td>
                            {{ url('/') }}/admin/gettheme/<input class="form-control" type="text" name="theme_code" placeholder="theme_code">
                            <button id="GetThemeBtn" type="button" class="btn btn-primary">GetTheme</button>
                        </td>
                    </tr>
                    <tr>
                        <td>อิโมจิไลน์</td>
                        <td>
                            {{ url('/') }}/admin/getemoji/<input class="form-control" type="text" name="emoji_code" placeholder="emoji_code">
                            <button id="GetEmojiBtn" type="button" class="btn btn-primary">GetEmoji</button>
                        </td>
                    </tr>
                    <tr>
                        <td>ค้นหา</td>
                        <td>
                            <input class="form-control" type="text" name="txtSearch" placeholder="คำค้นหา">
                            <button id="GetStickerSearch" type="button" class="btn btn-primary">GetStickerSearch</button>
                            <button id="GetThemeSearch" type="button" class="btn btn-primary">GetThemeSearch</button>
                            <button id="GetEmojiSearch" type="button" class="btn btn-primary">GetEmojiSearch</button>
                        </td>
                    </tr>
                    <tr>
                        <td>อัพเดท สติ๊กเกอร์,ธีม,อิโมจิ ทางการ</td>
                        <td>
                            <button id="GetOfficialSticker" type="button" class="btn btn-primary">GetOfficialSticker</button>
                            <button id="GetOfficialTheme" type="button" class="btn btn-primary">GetOfficialTheme</button>
                            <button id="GetOfficialEmoji" type="button" class="btn btn-primary">GetOfficialEmoji</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        </div>
    </div>

@stop

@section('js')
<script>
$(document).ready(function(){
    // getSticker
    $("#GetStickerBtn").click(function(){
        window.open("{{ url('/') }}/admin/getsticker/"+$('input[name=sticker_code]').val(), '_blank').focus();
    });

    // getTheme
    $("#GetThemeBtn").click(function(){
        window.open("{{ url('/') }}/admin/gettheme/"+$('input[name=theme_code]').val(), '_blank').focus();
    });

    // getEmoji
    $("#GetEmojiBtn").click(function(){
        window.open("{{ url('/') }}/admin/getemoji/"+$('input[name=emoji_code]').val(), '_blank').focus();
    });

    // getOfficial
    $("#GetOfficialSticker").click(function(){
        window.open("{{ url('/') }}/admin/getstickerstore/1/new/3", '_blank');
    });

    $("#GetOfficialTheme").click(function(){
         window.open("{{ url('/') }}/admin/getthemestore/1/new/3", '_blank');
    });

    $("#GetOfficialEmoji").click(function(){
        window.open("{{ url('/') }}/admin/getemojistore/1/new/3", '_blank');
    });

    // GetStickerSearch
    $("#GetStickerSearch").click(function(){
        window.open("{{ url('/') }}/admin/getstickerstoresearch/"+$('input[name=txtSearch]').val(), '_blank');
    });

    // GetThemeSearch
    $("#GetThemeSearch").click(function(){
        window.open("{{ url('/') }}/admin/getthemestoresearch/"+$('input[name=txtSearch]').val(), '_blank');
    });

    // GetEmojiSearch
    $("#GetEmojiSearch").click(function(){
        window.open("{{ url('/') }}/admin/getemojistoresearch/"+$('input[name=txtSearch]').val(), '_blank');
    });
});
</script>
@stop