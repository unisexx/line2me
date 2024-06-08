@extends('layouts.front2024')

@section('breadcrumb')
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-custom">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าแรก</a></li>
                <li class="breadcrumb-item active">ทำให้สติ๊กเกอร์ไลน์ของคุณเป็นที่รู้จักมากขึ้น! เริ่มโปรโมทกับเราวันนี้ 🎉📈</li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">ทำให้สติ๊กเกอร์ไลน์ของคุณเป็นที่รู้จักมากขึ้น! เริ่มโปรโมทกับเราวันนี้ 🎉📈</h2>
        <div class="row">

            <div class="newcontent">
                <p>โปรโมทสติ๊กเกอร์ไลน์ครีเอเทอร์ของคุณวันนี้! พื้นที่โฆษณาเด่นสำหรับการแสดงผลที่ผ่านสายตาผู้เข้าชมเว็บไซต์อย่างมากที่สุด โดยโฆษณาของคุณจะถูกแสดงในหน้าต่างๆ ดังนี้:</p>

                <h3 class="mt-5"><strong>1. แสดงในหน้าแรกในส่วนของสติ๊กเกอร์แนะนำ</strong></h3>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20171810.png?1640687205259" alt="สกรีนช็อต 2021-12-28 171810" class="img-fluid img-bordered" />
                </div>

                <h3 class="mt-5"><strong>2. แสดงในส่วนของหน้ารายละเอียดของสติ๊กเกอร์ทุกหน้า</strong></h3>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20171938.png?1640687214219" alt="สกรีนช็อต 2021-12-28 171938" class="img-fluid img-bordered" />
                </div>

                <h3 class="mt-5"><strong>3. โปรโมทสติ๊กเกอร์ไลน์ผ่านทาง Social ช่องทางต่างๆของร้าน (Line, Facebook, Twitter, Instagram, Pinterest, Etc.)</strong></h3>
                <p class="social-text"><i class="fab fa-line"></i> <span class="text-success">LINE</span></p>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20172259.png?1640687294852" alt="สกรีนช็อต 2021-12-28 172259" class="img-fluid img-bordered" />
                </div>

                <p class="social-text"><i class="fab fa-facebook"></i> <span class="text-primary">Facebook</span></p>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20172430.png?1640687308305" alt="สกรีนช็อต 2021-12-28 172430" class="img-fluid img-bordered" />
                </div>

                <p class="social-text"><i class="fab fa-twitter"></i> <span class="text-info">Twitter</span></p>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20172500.png?1640687314352" alt="สกรีนช็อต 2021-12-28 172500" class="img-fluid img-bordered" />
                </div>

                <p class="social-text"><i class="fab fa-instagram"></i> <span class="text-danger">Instagram</span></p>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20172527.png?1640687317789" alt="สกรีนช็อต 2021-12-28 172527" class="img-fluid img-bordered" />
                </div>

                <p class="social-text"><i class="fab fa-pinterest"></i> <span class="text-danger">Pinterest</span></p>
                <div>
                    <img src="https://line2me.in.th/js/tinymce_file_manager/source/%E0%B8%AA%E0%B8%81%E0%B8%A3%E0%B8%B5%E0%B8%99%E0%B8%8A%E0%B9%87%E0%B8%AD%E0%B8%95%202021-12-28%20172545.png?1640687320843" alt="สกรีนช็อต 2021-12-28 172545" class="img-fluid img-bordered" />
                </div>

                <h3 class="mt-5"><strong>4. สติ๊กเกอร์ของคุณจะถูกแนะนำให้กับผู้ซื้อเป็นอันดับแรกๆ หากมีการสอบถามเข้ามา</strong></h3>
                <p>- เพียงลงโฆษณาโปรโมทสติ๊กเกอร์ไลน์กับเราในตำแหน่งเดียว คุณก็จะสามารถเพิ่มโอกาสให้สติ๊กเกอร์ของคุณได้ผ่านสายตาผู้คนมากมาย เพิ่มยอดขายได้หลายสิบเท่าตัวเมื่อเทียบกับการไม่ได้โปรโมท!<br />- ทุกการซื้อสติ๊กเกอร์ผ่านร้านเรามีผลต่อการจัดอันดับสติ๊กเกอร์ในเว็บไลน์สโตร์และในแอพไลน์โดยตรง</p>

                <p><strong>ปล.</strong> พิเศษ! ค่าโฆษณาเพียง 100 บาทต่อเดือน หรือเลือกเหมา 3 เดือนในราคาเพียง 250 บาทเท่านั้น (<span class="text-danger">เฉลี่ยเพียงวันละ 2.7 บาท</span>)<br /><strong>ปล2.</strong> เว็บไซต์ของเรามียอดการเปิดหน้าเพจโดยเฉลี่ยประมาณ 50,000 - 80,000 หน้าต่อวัน หรือ 1,500,000 - 2,400,000 หน้าต่อเดือน คุ้มค่ามากกับราคาค่าโฆษณาที่คุณจ่าย!</p>

                <p><strong>ถ้าคุณต้องการ:</strong></p>
                <ol>
                    <li><strong>เพิ่มการเห็นสติกเกอร์ของคุณ</strong> เพื่อเพิ่มโอกาสในการซื้อ</li>
                    <li><strong>เพิ่มยอดขายให้ถึงเป้า</strong> เพื่อที่จะสามารถถอนเงินจากไลน์ออกมาใช้ได้</li>
                    <li><strong>ขยายกลุ่มผู้ซื้อสติ๊กเกอร์</strong> ให้กว้างกว่าเดิม</li>
                    <li><strong>ไต่อันดับสติ๊กเกอร์ของคุณ</strong> ให้อยู่ในอันดับบนๆในแอพไลน์</li>
                    <li><strong>โปรโมทตัวคุณ</strong> ให้เป็นที่รู้จักเพื่อปูทางสู่ผลงานสติ๊กเกอร์ลายใหม่ๆ</li>
                </ol>

                <p><strong>การโปรโมทสติกเกอร์กับเราน่าจะเป็นคำตอบที่ดีที่สุด!</strong> ^^</p>
                <hr />

                <p><strong>ทำความเข้าใจสักนิด:</strong></p>
                <ul>
                    <li>
                        <p><strong>กลุ่มคนที่เข้ามาดูเว็บเรา:</strong></p>
                        <ol>
                            <li><strong>ผู้ที่สามารถซื้อเองได้</strong> แต่ไม่ถนัดดูในแอพไลน์ ก็หาดูจากในเว็บแล้วกดเข้าไปซื้อ</li>
                            <li><strong>ผู้ที่ฝากซื้อกับทางร้านเราเอง</strong></li>
                            <li><strong>ร้านอื่นๆ</strong> ที่ไม่มีหน้าร้านเป็นของตัวเอง ก็มีหลายร้านที่อ้างอิงจากเว็บนี้</li>
                        </ol>
                    </li>
                    <li>
                        <p><strong>สติ๊กเกอร์ที่โปรโมทกับเรา:</strong></p>
                        <ul>
                            <li>มีบางลายที่ <strong>ขายดีมากๆ</strong> จนได้รับการทำเป็นสติ๊กเกอร์ดุ๊กดิ๊กมีเสียงในเวลาต่อมา</li>
                            <li>มีบางลายที่ <strong>ขายไม่ออกเลย</strong> ซึ่งการโปรโมทจะทำให้คนเห็นสติ๊กเกอร์ของคุณมากขึ้นจริง แต่สุดท้ายขึ้นอยู่กับตัวสติ๊กเกอร์เองว่ามีความน่าสนใจมากน้อยแค่ไหน</li>
                        </ul>
                    </li>
                </ul>
                <p><strong>ดังนั้นการโปรโมทจึงมีความเสี่ยง</strong> ถ้าเน้นที่ยอดขายเป็นหลัก แต่ถ้าไม่คิดมาก เน้นโปรโมทแบบขำๆ เผื่อมีคนซื้อ หรืออยากทดสอบว่าสติ๊กเกอร์ของคุณกำลังเป็นที่นิยมหรือเปล่า ก็ยินดีให้บริการค่ะ</p>
            </div>

            <style>
                .social-text {
                    font-size: 1.5rem;
                    margin: 1rem 0;
                    display: flex;
                    align-items: center;
                }

                .social-text i {
                    margin-right: 0.5rem;
                }

                .text-success {
                    color: #28a745;
                }

                .text-primary {
                    color: #007bff;
                }

                .text-info {
                    color: #17a2b8;
                }

                .text-danger {
                    color: #dc3545;
                }

                .img-bordered {
                    border: 2px solid #ccc;
                    padding: 5px;
                    border-radius: 5px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
            </style>


        </div>
    </div>
@endsection
