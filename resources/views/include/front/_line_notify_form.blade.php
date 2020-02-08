<div class="fh5co-narrow-content mb-5">

    <form id="mainForm" method="POST" action="{{ url('ajax/linenotify') }}" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="card rounded-0 lineidFrm">
        <div class="card-header text-white bg-danger">
            <h5 class="mb-0 text-white"><small>สนใจสั่งซื้อสติ๊กเกอร์ แต่แอดเพื่อนไม่ได้ ให้อัพโหลดคิวอาร์โค้ดของท่านไว้เดี๋ยวทางเราจะติดต่อกลับไปครับ</small></h5>
        </div>
        <div class="card-body">
            <div class="custom-file mb-3">
                <input type="file" name="imgUpload" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">เลือกรูปคิวอาร์โค้ด</label>
            </div>

            <button type="submit" class="btn-send-lineid btn btn-success"><small>อัพโหลดคิวอาร์โค้ด</small></button>
            <div class="text-danger"><u>สำคัญสุดๆ</u> ก่อนอัพโหลดคิวอาร์โค้ด ให้ดูวิธีตั้งค่าไลน์ด้านล่างนี้ก่อนนะครับ ไม่อย่างนั้นพอเราทักเข้าไปหาแล้วเพื่อนๆจะไม่ได้รับข้อความนะครับ</div>
        </div>
        <!--/card-block-->
    </div>
    </form>

</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.0/dist/sweetalert2.all.min.js" integrity="sha256-PokS6eWvc67qkBbhxlpg/W4UHnseEHRwArGs9+0zbXI=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
    $('#customFile').on('change', function() { 
        // alert( this.files[0].size + "bytes" );
        if(this.files[0].size > 1000000){
            
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'ขนาดไฟล์ห้ามเกิน 1mb',
                text: 'กรุณาลองใหม่อีกครั้ง',
                showConfirmButton: true,
            })
            clearFileInput();

        }
    });

    $('body').on('click', '.btn-send-lineid', function(e){
        e.preventDefault();
            
        var ext = $('#customFile').val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {

            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รูปคิวอาร์โค้ดไม่ถูกต้อง',
                text: 'กรุณาลองใหม่อีกครั้ง',
                showConfirmButton: true,
            })
            clearFileInput();

        }else{

            $(".lineidFrm").LoadingOverlay("show");
            $.ajax({
                url: "{{ url('ajaxLinenotify') }}",
                type:'POST',
                data: new FormData($("#mainForm")[0]),
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data == "false"){

                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'รูปคิวอาร์โค้ดไม่ถูกต้อง',
                            text: 'กรุณาลองใหม่อีกครั้ง',
                            showConfirmButton: true,
                        })

                    }else{

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'ได้รับข้อมูลเรียบร้อย',
                            text: 'ทางเราจะติดต่อกลับไปโดยเร็วที่สุด ขอบคุณมากครับ',
                            showConfirmButton: true,
                        })

                    }
                    
                    $(".lineidFrm").LoadingOverlay("hide");
                    clearFileInput();
                }
            });

        }

    });
});
</script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function clearFileInput(){
    $("#customFile").val("");
    $("#customFile").siblings(".custom-file-label").removeClass("selected").html("เลือกรูปคิวอาร์โค้ด");
}
</script>
@endpush