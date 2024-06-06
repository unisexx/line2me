<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css" />
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

        .product-cover-img {
            width: 180px;
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

    .testimonial-card {
        position: relative;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 60px;
        /* เพิ่มระยะห่างด้านบนเพื่อให้มีที่สำหรับไอคอนแมว */
        background-color: #f8f9fa;
    }

    .testimonial-card::before {
        content: "";
        position: absolute;
        top: -10px;
        /* ปรับตำแหน่งของแหลม */
        left: 70px;
        /* ปรับตำแหน่งของแหลม */
        border-width: 0 10px 10px 10px;
        border-style: solid;
        border-color: transparent transparent #ddd transparent;
    }

    .cat-icon {
        position: absolute;
        top: -50px;
        /* ปรับตำแหน่งตามต้องการ */
        left: 10%;
        transform: translateX(-50%);
        width: 50px;
        /* ขนาดของไอคอนแมว */
        height: 50px;
    }


    .custom-btn-blue {
        /* background-color: #3285fd; */
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 18px;
        border-radius: 30px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .custom-btn-blue:hover {
        /* background-color: #3285fd; */
        transform: scale(1.05);
        color: white;
    }


    .new-product-card {
        /* border: 2px solid red; */
        /* border-image-slice: 1; */
        /* border-width: 2px; */
        /* border-image-source: linear-gradient(45deg, red, orange, yellow, green, cyan, blue, violet); */
        position: relative;
    }

    .new-product-card::before {
        content: 'NEW';
        position: absolute;
        top: -1px;
        left: -1px;
        background: #ff0000;
        /* background: #28a745 ;
        background: #fd7e14 ;
        background: #007bff; */
        color: #ffffff;
        padding: 5px 10px;
        font-weight: bold;
        border-radius: 5px;
        z-index: 9;
    }
</style>
