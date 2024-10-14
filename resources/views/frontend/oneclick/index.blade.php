<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Click Open Links</title>
</head>

<body>

    <!-- ปุ่มสำหรับเปิดลิงก์สติ๊กเกอร์ -->
    <button id="openStickerLinksButton">Open Sticker Links</button>

    <!-- ปุ่มสำหรับเปิดลิงก์ธีม -->
    <button id="openThemeLinksButton">Open Theme Links</button>

    <!-- ปุ่มสำหรับหยุดการเปิดลิงก์ -->
    <button id="stopButton">Stop</button>

    <script>
        // ตัวแปรสำหรับเก็บลิงก์สติ๊กเกอร์
        let stickerLinks = [];

        // ตัวแปรสำหรับเก็บลิงก์ธีม
        let themeLinks = [];

        // รับค่าจาก Laravel Controller และสร้างลิงก์สำหรับสติ๊กเกอร์และธีม
        const stickerAuthorIds = @json($stickerAuthorIds);
        const themeAuthorIds = @json($themeAuthorIds);

        // ตรวจสอบว่ามีข้อมูล stickerAuthorIds หรือไม่ ถ้ามีจะสร้างลิงก์สำหรับสติ๊กเกอร์
        if (stickerAuthorIds && stickerAuthorIds.length > 0) {
            // สร้างลิงก์สำหรับสติ๊กเกอร์ โดยเพิ่ม 3 ลิงก์ต่อ author_id
            stickerLinks = stickerAuthorIds.flatMap(id => [
                `http://line2me.in.th.test/admin/get-sticker-by-author/${id}/3`,
            ]);
        } else {
            console.error('stickerAuthorIds ไม่ถูกส่งมาจาก Laravel');
        }

        // ตรวจสอบว่ามีข้อมูล themeAuthorIds หรือไม่ ถ้ามีจะสร้างลิงก์สำหรับธีม
        if (themeAuthorIds && themeAuthorIds.length > 0) {
            themeLinks = themeAuthorIds.map(id => `http://line2me.in.th.test/admin/get-theme-by-author/${id}/10`);
        } else {
            console.error('themeAuthorIds ไม่ถูกส่งมาจาก Laravel');
        }

        let countdownInterval = null;
        let isStopped = false;

        // ฟังก์ชันสำหรับเปิดลิงก์ทีละลิงก์ โดยมีการนับถอยหลังก่อนเปิดลิงก์
        function openLinksWithCountdown(links, openMultiple = false) {
            isStopped = false;
            let delay = 10; // 10 วินาทีนับถอยหลัง
            let currentLinkIndex = 0; // เริ่มที่ลิงก์แรก

            function openNextLink() {
                if (currentLinkIndex >= links.length || isStopped) {
                    clearInterval(countdownInterval);
                    document.title = "ลิงก์ทั้งหมดเปิดแล้ว หรือถูกหยุด";
                    return;
                }

                let timeLeft = delay;
                document.title = `เปิดใน ${timeLeft} วินาที - เหลือลิงก์ ${links.length - currentLinkIndex}`;

                countdownInterval = setInterval(() => {
                    if (isStopped) {
                        clearInterval(countdownInterval);
                        document.title = "หยุดการเปิดลิงก์แล้ว";
                        return;
                    }

                    timeLeft--;
                    document.title = `เปิดใน ${timeLeft} วินาที - เหลือลิงก์ ${links.length - currentLinkIndex - 1}`;

                    if (timeLeft < 0) {
                        clearInterval(countdownInterval);

                        if (openMultiple) {
                            // เปิดลิงก์ 3 ลิงก์พร้อมกันสำหรับสติ๊กเกอร์
                            for (let i = 0; i < 3 && currentLinkIndex + i < links.length; i++) {
                                window.open(links[currentLinkIndex + i], '_blank', 'noopener,noreferrer');
                            }
                            currentLinkIndex += 3; // เพิ่ม index ทีละ 3
                        } else {
                            // เปิดลิงก์ธีมทีละลิงก์
                            window.open(links[currentLinkIndex], '_blank', 'noopener,noreferrer');
                            currentLinkIndex++;
                        }

                        openNextLink(); // เรียกตัวเองใหม่เพื่อเปิดลิงก์ถัดไป
                    }
                }, 1000); // นับถอยหลังทุกๆ 1 วินาที
            }

            openNextLink(); // เริ่มเปิดลิงก์แรก
        }

        // ฟังก์ชันสำหรับหยุดการเปิดลิงก์
        function stopOpeningLinks() {
            isStopped = true;
            clearInterval(countdownInterval);
            document.title = "หยุดการเปิดลิงก์แล้ว";
        }

        // ตั้งค่าให้ปุ่มทำงานเมื่อคลิก (เปิดลิงก์สติ๊กเกอร์ 3 ลิงก์พร้อมกันต่อ author)
        document.getElementById("openStickerLinksButton").addEventListener("click", function() {
            openLinksWithCountdown(stickerLinks, true); // เปิดลิงก์สติ๊กเกอร์ 3 ลิงก์พร้อมกัน
        });

        // ตั้งค่าให้ปุ่มทำงานเมื่อคลิก (เปิดลิงก์ธีม ทีละลิงก์)
        document.getElementById("openThemeLinksButton").addEventListener("click", function() {
            openLinksWithCountdown(themeLinks); // เปิดลิงก์ธีมทีละลิงก์
        });

        // ตั้งค่าให้ปุ่มหยุดการทำงานเมื่อคลิก
        document.getElementById("stopButton").addEventListener("click", stopOpeningLinks);
    </script>

</body>

</html>
