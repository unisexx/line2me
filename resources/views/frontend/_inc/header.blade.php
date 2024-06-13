<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Line2me Stickers Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/') }}">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/stickers') }}">สติกเกอร์ไลน์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/themes') }}">ธีมไลน์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/emojis') }}">อิโมจิไลน์</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/series') }}">แนะนำจากทางร้าน</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
