<h2 class="h2sidebar">สติ๊กเกอร์ตามอารมณ์</h2>
<span class="tag">
@foreach($stamp as $key=>$row)
    @php
        $myArray = "";       
    @endphp

    @if($row->tag != "")

        @php
            $tags = explode(',',$row->tag);
        @endphp

        @php
            foreach($tags as $key){
                $myArray[] = '<a href="'.url('tag/'.trim($key)).'">'.trim($key).'</a> ';
            }

        @endphp
        
        @php
            echo str_replace(',',' ',implode( ', ', $myArray ));
        @endphp

    @endif
@endforeach
</span>
<br clear="all">