@extends('layouts.front') @section('content')

<div class="fh5co-narrow-content pagecontent">
    <div class="row">
        <div class="col-md-12 animate-box pageContent" data-animate-effect="fadeInLeft">
            <h1>{{ $rs->title }}</h1>
            {!! $rs->detail !!}
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    .pagecontent a{
        color:#da1212 !important;
    }
</style>
@endpush

@push('js')
<!-- Messenger ปลั๊กอินแชท Code -->
<div id="fb-root"></div>
<script>
window.fbAsyncInit = function() {
    FB.init({
    xfbml            : true,
    version          : 'v10.0'
    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<div class="fb-customerchat"
attribution="biz_inbox"
page_id="619024168129948">
</div>
@endpush