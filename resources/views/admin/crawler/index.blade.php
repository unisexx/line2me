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
});
</script>
@stop