<!-- Categories Section -->
<section class="categories" id="categories">
    <div class="container">
        <h2 class="mb-4">หมวดหมู่</h2>
        <div class="row text-center">
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4"> <!-- col-4 สำหรับแสดง 3 items ต่อแถว -->
                <a href="{{ url('stickers/official/th/new') }}" class="category-link">
                    <img src="{{ asset('image/1.png') }}" alt="Category 1" class="category-img">
                    <h5>สติกเกอร์ไลน์ไทย</h5>
                </a>
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4"> <!-- col-4 สำหรับแสดง 3 items ต่อแถว -->
                <a href="{{ url('stickers/official/oversea/new') }}" class="category-link">
                    <img src="{{ asset('image/2.png') }}" alt="Category 2" class="category-img">
                    <h5>สติกเกอร์ไลน์ต่างประเทศ</h5>
                </a>
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4"> <!-- col-4 สำหรับแสดง 3 items ต่อแถว -->
                <a href="{{ url('themes/official/th/new') }}" class="category-link">
                    <img src="{{ asset('image/3.png') }}" alt="Category 3" class="category-img">
                    <h5>ธีมไลน์ไทย</h5>
                </a>
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4">
                <a href="{{ url('themes/official/oversea/new') }}" class="category-link">
                    <img src="{{ asset('image/4.png') }}" alt="Category 4" class="category-img">
                    <h5>ธีมไลน์ต่างประเทศ</h5>
                </a>
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4">
                <a href="{{ url('emojis/official/th/new') }}" class="category-link">
                    <img src="{{ asset('image/5.png') }}" alt="Category 5" class="category-img">
                    <h5>อิโมจิไลน์ไทย</h5>
                </a>
            </div>
            <div class="col-4 col-lg-2 col-md-4 col-sm-6 mb-4">
                <a href="{{ url('emojis/official/oversea/new') }}" class="category-link">
                    <img src="{{ asset('image/6.png') }}" alt="Category 6" class="category-img">
                    <h5>อิโมจิไลน์ต่างประเทศ</h5>
                </a>
            </div>
        </div>
    </div>
</section>

@push('css')
    <style>
        /* Adjust font-size for mobile */
        @media (max-width: 768px) {
            .category-link h5 {
                font-size: 0.7rem;
                /* ย่อขนาดฟอนต์สำหรับมือถือ */
            }

            .category-img {
                /* width: 80px; */
                /* ปรับขนาดภาพสำหรับมือถือ */
                height: auto;
            }
        }
    </style>
@endpush
