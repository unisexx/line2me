<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script>
    document.querySelectorAll('.animated-sticker').forEach(animatedSticker => {
        animatedSticker.addEventListener('load', () => {
            setTimeout(() => {
                animatedSticker.src = animatedSticker.src.split('?')[0] + '?' + new Date().getTime();
            }, 3000); // ระยะเวลาตรงนี้ต้องเท่ากับระยะเวลาของแอนิเมชัน
        });

        animatedSticker.src = animatedSticker.src.split('?')[0] + '?' + new Date().getTime(); // เริ่มเล่นแอนิเมชัน
    });
</script>
<script>
    let animationTimeout; // ตัวแปรสำหรับเก็บ Timeout

    $(document).ready(function() {
        // เปิด sticker stamp animation ตอนคลิก
        $('.playAnimate').click(function() {
            resetAnimations(); // รีเซ็ตทุกอย่างก่อน
            playAnimate($(this)); // เริ่มแอนิเมชันใหม่
        });
    });

    function resetAnimations() {
        // ยกเลิก Timeout ที่ค้างอยู่
        clearTimeout(animationTimeout);

        // รีเซ็ตทุกภาพให้กลับไปสถานะปกติ
        $('.playAnimate').removeClass('enlarged dimmed').each(function() {
            const originalSrc = $(this).data('animation').replace('/IOS/sticker_animation@2x.png', '/android/sticker.png');
            $(this).attr('src', originalSrc);
        });

        // หยุดเสียงทั้งหมด
        $('audio').each(function() {
            this.pause();
            this.currentTime = 0;
        });
    }

    function playAnimate(thisObj) {
        // ขยายขนาดรูปที่ถูกคลิก
        thisObj.addClass('enlarged');
        // จางรูปภาพอื่น ๆ
        $('.playAnimate').not(thisObj).addClass('dimmed');

        // ตั้งเวลา 5 วินาทีเพื่อหดกลับไปขนาดเดิม
        animationTimeout = setTimeout(function() {
            thisObj.removeClass('enlarged');
            // นำความจางออกจากรูปภาพอื่น ๆ
            $('.playAnimate').not(thisObj).removeClass('dimmed');
        }, 3000);

        // เล่น sticker animation
        thisObj.attr('src', thisObj.data('animation'));

        // เล่นเสียงพร้อมกับการเล่น animation
        var audio = thisObj.next('audio')[0];
        audio.play();
    }
</script>
<script>
    $(document).ready(function() {
        var btn = $('#return-to-top');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                btn.fadeIn();
            } else {
                btn.fadeOut();
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    });
</script>
