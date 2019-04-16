<h2 class="h2sidebar">ธีมไลน์ที่น่าสนใจ</h2>
@foreach($other as $row)
    <div class="col-xs-6 col-sm-12 col-md-12 mediablk">
        <div class="panel panel-default">
            <div class="panel-body">
            <a href="{{ url('theme/'.$row->slug) }}">
            <div class="media-left media-top">
                <img src="https://shop.line-scdn.net/themeshop/v1/products/{{ $row->theme_path }}/WEBSTORE/icon_136x190.png" width="40">
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