<!-- Copy Link Button -->
<button class="btn btn-sm btn-outline-secondary" onclick="copyStickerLink()" style="vertical-align: baseline;">Copy Link</button>

<!-- Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="copyToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                คัดลอกลิงก์สำเร็จแล้ว!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@push('js')
    <!-- JavaScript to copy the current URL and show Toast -->
    <script>
        function copyStickerLink() {
            // ใช้ URL ปัจจุบัน
            const stickerUrl = window.location.href;

            // คัดลอก URL ไปยังคลิปบอร์ด
            navigator.clipboard.writeText(stickerUrl).then(function() {
                // แสดง Toast เมื่อคัดลอกสำเร็จ
                var copyToast = new bootstrap.Toast(document.getElementById('copyToast'));
                copyToast.show();
            }, function(err) {
                console.error('ไม่สามารถคัดลอกข้อความ: ', err);
            });
        }
    </script>
@endpush
