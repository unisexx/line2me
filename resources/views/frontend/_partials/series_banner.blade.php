@foreach ($series->chunk(3) as $chunk)
    <div class="row mb-2">
        @foreach ($chunk as $row)
            <div class="col pl-2 pr-2">
                <a href="{{ url('series/' . $row->id) }}">
                    <img class="img-fluid" src="{{ @$row->image ?? 'https://dummyimage.com/526x250/fff' }}" title="{{ @$row->title }}" alt="{{ @$row->sub_title }}">
                </a>
            </div>
        @endforeach
    </div>
@endforeach
