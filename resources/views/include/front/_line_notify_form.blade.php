<div class="fh5co-narrow-content">

    <!-- form card login -->
    <div class="card rounded-0 lineidFrm">
        <div class="card-header text-white bg-danger">
            <h5 class="mb-0 text-white">สนใจสั่งซื้อสติ๊กเกอร์ แต่แอดเพื่อนไม่ได้
                ให้ทิ้งไอดีไลน์ไว้เดี๋ยวทางร้านจะติดต่อกลับไปจ้า</h5>
        </div>
        <div class="card-body">
            <div class="input-group mb-3">
                <input name="lineid" type="text" class="form-control" placeholder="ไลน์ไอดีผู้สั่งซื้อ">
                <div class="input-group-append">
                    <button class="btn btn-success btn-send-lineid" type="button" style="margin-bottom:0px;">ส่งข้อมูล</button>
                </div>
            </div>
        </div>
        <!--/card-block-->
    </div>
    <!-- /form card login -->

</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.0/dist/sweetalert2.all.min.js" integrity="sha256-PokS6eWvc67qkBbhxlpg/W4UHnseEHRwArGs9+0zbXI=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('body').on('click', '.btn-send-lineid', function(e){
        $(".lineidFrm").LoadingOverlay("show");
        e.preventDefault();

        if( $('input[name=lineid]').val() ){
            $.get( "{{ url('ajax/linenotify') }}", { 
                lineid: $('input[name=lineid]').val()
            }).done(function( data ) {
                
                $('input[name=lineid]').val('');

                $(".lineidFrm").LoadingOverlay("hide");

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ได้รับข้อมูลเรียบร้อย',
                    text: 'ทางเราจะติดต่อกลับไปโดยเร็วที่สุด ขอบคุณมากครับ',
                    showConfirmButton: true,
                    // timer: 1500
                })

            });
        }
    });
});
</script>
@endpush