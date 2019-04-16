<h2 class="h2sidebar">สติ๊กเกอร์ที่น่าสนใจ</h2>
@foreach($other as $row)
    <div class="col-xs-6 col-sm-12 col-md-12 mediablk">
        <div class="panel panel-default">
            <div class="panel-body">
            <a href="{{ url('sticker/'.$row->slug) }}">
            <div class="media-left media-top">
                <img src="https://sdl-stickershop.line.naver.jp/products/0/0/{{ $row->version }}/{{ $row->sticker_code }}/android/thumbnail.png" width="40" height="40">
            </div>
            <div class="media-body">
                <h3 class="media-heading h3sidebar">{{ $row->name }}</h3>
            </div>
            </a>
            </div>
        </div>
    </div>
@endforeach
<br clear="all">