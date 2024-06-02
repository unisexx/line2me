<style>
    .hero {
        padding: 60px 0;
        text-align: center;
        background-color: #f8f9fa;
    }

    .hero img {
        max-width: 100%;
        height: auto;
        margin-bottom: 30px;
    }

    .categories,
    .products,
    .reviews,
    .promotions,
    .contact {
        padding: 40px 0;
    }

    .category-img {
        max-width: 100%;
        height: auto;
    }

    .category-link {
        display: block;
        text-decoration: none;
        color: inherit;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .category-link:hover {
        transform: translateY(-5px);
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); */
    }

    .category-img {
        width: 100%;
        transition: transform 0.3s ease;
    }

    .category-link:hover .category-img {
        transform: translateY(-5px);
    }

    .category-link h5 {
        margin-top: 10px;
    }


    .fixed-width-240 {
        width: 240;
    }

    .btn-custom {
        background-color: #00A65A;
        border-color: #008F47;
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 1.2em;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
        width: 100%;
    }

    .btn-custom:hover {
        background-color: #008F47;
        border-color: #006837;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        color: white;
    }

    hr.custom-hr {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .logo {
        background-color: #00A65A;
        border-color: #008F47;
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 1.2em;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .logo:hover {
        background-color: #008F47;
        border-color: #006837;
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .animated-sticker {
        width: 240px;
        /* คุณสามารถปรับขนาดตามต้องการ */
        height: auto;
    }

    .no-padding {
        padding: 0;
    }

    .playAnimate.enlarged {
        transform: scale(1.5);
        /* ขยายขนาดตามต้องการ */
        transition: transform 0.3s ease, opacity 0.3s ease;
        /* ใช้ transition เพื่อความนุ่มนวล */
        z-index: 1;
        position: relative;
    }

    .dimmed {
        opacity: 0.3;
        transition: opacity 0.3s ease;
    }

    .hidden-link {
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        opacity: 0;
        /* ทำให้มองไม่เห็น */
    }

    .positionBottomRight {
        bottom: 10px;
        right: 5px
    }

    .positionTopRight {
        top: 10px;
        right: 5px
    }

    .iconProperty {
        background-size: 35px 35px;
        position: absolute;
        overflow: hidden;
        text-align: left;
        text-indent: -9999px;
        display: block;
        width: 35px;
        height: 35px
    }

    .iconAnimation {
        background-image: url({{ asset('image/play.png') }})
    }

    .iconSound {
        background-image: url({{ asset('image/sound.png') }})
    }

    .iconAnimationSound {
        background-image: url({{ asset('image/animate.png') }})
    }

    .iconPopup {
        background-image: url({{ asset('image/popup.png') }})
    }

    .iconPopupSound {
        background-image: url({{ asset('image/popup_sound.png') }})
    }

    .iconNameText {
        background-image: url({{ asset('image/ico_nameSticker_m') }})
    }

    .breadcrumb-custom {
        background: linear-gradient(90deg, #ffdd00, #01dfc0);
        border-radius: 30px;
        padding: 10px 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* เพิ่มเงา */
        /* display: inline-block; */
    }

    .breadcrumb-custom a {
        color: black;
        text-decoration: none;
        font-weight: bold;
    }

    .breadcrumb-custom a:hover {
        text-decoration: underline;
    }

    .breadcrumb-custom .breadcrumb-item+.breadcrumb-item::before {
        content: ">";
        color: black;
        padding: 0 5px;
    }

    .no-style {
        color: inherit;
        text-decoration: none;
        cursor: default;
    }

    .sticker-stamp {
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 576px) {
        .sticker-stamp {
            width: 200px;
        }
    }

    @media (min-width: 577px) and (max-width: 768px) {
        .sticker-stamp {
            width: 200px;
        }
    }

    @media (min-width: 769px) {
        .sticker-stamp {
            width: 200px;
        }
    }

    .no-padding {
        padding-left: 0;
        padding-right: 0;
    }

    .no-margin {
        margin-left: 0;
        margin-right: 0;
    }

    #return-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
        z-index: 100;
    }
</style>
