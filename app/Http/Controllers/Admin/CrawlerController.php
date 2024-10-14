<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emoji;
use App\Models\Series;
use App\Models\SeriesItem;
use App\Models\Sticker;
use App\Models\Theme;
use DB;
use Goutte;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrawlerController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.crawler.index');
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line ตาม sticker_code ที่กรอกข้อมูล
     */
    public function getsticker($sticker_code)
    {
        // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Sticker::select('id')->where('sticker_code', $sticker_code)->first();

        /**
         * ถ้ายังไม่มีค่าใน DB
         */
        if (empty($rs->id)) {

            $crawler_page = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');

            /**
             * หา stamp_start & stamp_end  & version
             */
            for ($i = 0; $i < 40; $i++) {
                // check node empty
                if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->count() != 0) {
                    $imgTxt     = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                    $image_path = explode("/", getUrlFromText($imgTxt));
                    $stamp_code = $image_path[6];
                    $version    = str_replace('v', '', $image_path[4]);
                    // dump($imgTxt);

                    $data[] = [
                        'stamp_code' => $stamp_code,
                    ];
                }
            }

            /**
             * หา stamp json
             */
            $stamp = $crawler_page->filter('ul.FnStickerList > li.FnStickerPreviewItem')->each(function ($node) {
                $imgTxt     = $node->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->attr('style');
                $image_path = explode("/", getUrlFromText($imgTxt));
                $stamp_code = $image_path[6];
                // dump($stamp_code);
                // dd('exit');
                return $stamp_code;
            });

            /**
             * หา version ของ รูป
             */
            // if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq(0)->count() != 0) {
            //     $imgTxt     = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq(0)->attr('style');
            //     $image_path = explode("/", getUrlFromText($imgTxt));
            //     $version    = str_replace('v', '', $image_path[4]);
            // }

            // dd(json_encode($stamp));

            if (empty($version)) {
                return false;
            }

            /**
             * ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
             */
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
            $result = curl_exec($ch);
            curl_close($ch);
            $productInfo = json_decode($result, true);

            /**
             * insert ลง db
             */
            DB::table('stickers')->insert(
                [
                    'sticker_code'        => @$sticker_code,
                    'version'             => @$version,
                    'title_th'            => @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'],
                    'title_en'            => @$productInfo['title']['en'],
                    'detail'              => @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text()),
                    'author_th'           => @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'],
                    'author_en'           => @$productInfo['author']['en'],
                    'credit'              => @trim($crawler_page->filter('a.mdCMN38Item01Author')->text()),
                    'created_at'          => date("Y-m-d H:i:s"),
                    'category'            => @$sticker_code > 1000000 ? 'creator' : 'official',
                    'country'             => @money2country(preg_replace('/[0-9.,\s]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text())),
                    'price'               => @(int) $productInfo['price'][0]['price'],
                    'status'              => 1,
                    'onsale'              => @$productInfo['onSale'],
                    'validdays'           => @$productInfo['validDays'],
                    'hasanimation'        => @$productInfo['hasAnimation'],
                    'hassound'            => @$productInfo['hasSound'],
                    'stickerresourcetype' => @$productInfo['stickerResourceType'],
                    'stamp_start'         => @reset($data)['stamp_code'],
                    'stamp_end'           => @end($data)['stamp_code'],
                    'stamp'               => json_encode(@$stamp),
                ]
            );
            unset($data);
            dump($sticker_code);
        }

        // สั่งให้ปิด tab เลย
        if (@$_GET['closetab'] == 1) {
            echo "<script>window.close();</script>";
        }
    }

    /**
     * ดึงธีมไลน์จากเว็บ store.line ตาม theme_code ที่กรอกข้อมูล
     */
    public function gettheme($theme_code, $category = 'creator')
    {
        // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Theme::where('theme_code', $theme_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->section)) {
            $crawler_page = Goutte::request('GET', 'https://store.line.me/themeshop/product/' . $theme_code . '/th');

            // ถ้า node ไม่ empty
            if ($crawler_page->filter('p.mdCMN38Item01Ttl')->count() > 0) {

                $imagePath = $crawler_page->filter('.mdCMN38Img img')->attr('src');

                // ใช้ Regular Expression ในการดึงเฉพาะเลข 234
                preg_match('/\/(\d+)\/WEBSTORE\/icon_198x278\.png$/', $imagePath, $matches);
                $imageNumber = $matches[1] ?? null;

                Theme::updateOrCreate(
                    [
                        'theme_code' => $theme_code,
                    ],
                    [
                        'title'      => trim($crawler_page->filter('p.mdCMN38Item01Ttl')->text()),
                        'detail'     => trim($crawler_page->filter('p.mdCMN38Item01Txt')->text()),
                        'author'     => trim($crawler_page->filter('a.mdCMN38Item01Author')->text()),
                        'credit'     => trim($crawler_page->filter('p.mdCMN09Copy')->text()),
                        'created_at' => now(),
                        'category'   => $category,
                        'country'    => money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text())),
                        'price'      => $this->getConvert2Coin((int) filter_var(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), FILTER_SANITIZE_NUMBER_INT), money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text()))),
                        'status'     => 1,
                        'section'    => $imageNumber,
                        'ok'         => 1,
                    ]
                );

                dump($theme_code);
            }
        }

        // สั่งให้ปิด tab เลย
        if (@$_GET['closetab'] == 1) {
            echo "<script>window.close();</script>";
        }
    }

    /**
     * ดึงอิโมจิไลน์จากเว็บ store.line ตาม emoji_code ที่กรอกข้อมูล
     */
    public function getemoji($emoji_code, $category = 'creator')
    {
        // นำ emoji_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Emoji::select('id')->where('emoji_code', $emoji_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)) {
            $crawler_page = Goutte::request('GET', 'https://store.line.me/emojishop/product/' . $emoji_code . '/th');

            // insert ลง db
            DB::table('emojis')->insert(
                [
                    'emoji_code'   => $emoji_code,
                    'title'        => trim($crawler_page->filter('.mdCMN38Item01Ttl')->text()),
                    'detail'       => trim($crawler_page->filter('.mdCMN38Item01Txt')->text()),
                    'creator_name' => trim($crawler_page->filter('.mdCMN38Item01Author')->text()),
                    'created_at'   => date("Y-m-d H:i:s"),
                    'category'     => $category,
                    'country'      => @money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text())),
                    'price'        => $this->getConvert2Coin((int) filter_var(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), FILTER_SANITIZE_NUMBER_INT), @money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text()))),
                    'status'       => 1,
                ]
            );

            dump($emoji_code);
        } // endif

        // สั่งให้ปิด tab เลย
        if (@$_GET['closetab'] == 1) {
            echo "<script>window.close();</script>";
        }
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * cat : top, new, top_creators, new_top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getstickerstore($type, $cat, $page = null)
    {
        $pageTarget = 'https://store.line.me/stickershop/showcase/' . $cat . '/th?page=' . $page;

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า sticker_code
            $sticker_code = explode("/", $url);
            $sticker_code = $sticker_code[3];

            $this->getsticker($sticker_code);
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page          = $page - 1;
            $page_redirect = url('admin/getstickerstore/' . $type . '/' . $cat . '/' . $page);
            echo "<script>setTimeout(function(){ window.location.href = '" . $page_redirect . "'; }, 1000);</script>";
        }
    }

    /**
     * ดึงธีมจากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * cat : top, new, top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getthemestore($type, $cat, $page = null)
    {
        $pageTarget = 'https://store.line.me/themeshop/showcase/' . $cat . '/th?page=' . $page;
        $category   = $type == 1 ? 'official' : 'creator';

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($category) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า theme_code
            $theme_code = explode('/', $url);
            $theme_code = $theme_code[3];

            $this->gettheme($theme_code, $category);
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page          = $page - 1;
            $page_redirect = url('admin/getthemestore/' . $type . '/' . $cat . '/' . $page);
            echo "<script>setTimeout(function(){ window.location.href = '" . $page_redirect . "'; }, 1000);</script>";
        }
    }

    /**
     * ดึงอิโมจิจากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * Cat : top, new, top_creators, new_top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public function getemojistore($type, $cat, $page = null)
    {
        $pageTarget = 'https://store.line.me/emojishop/showcase/' . $cat . '/th?page=' . $page;
        $category   = $type == 1 ? 'official' : 'creator';

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($category) {

            // หา url ของอโมจิ
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ อิโมจิที่ได้มา หาค่า emoji_code
            $emoji_code = explode("/", $url);
            $emoji_code = $emoji_code[3];

            $this->getemoji($emoji_code, $category);
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page          = $page - 1;
            $page_redirect = url('admin/getemojistore/' . $type . '/' . $cat . '/' . $page);
            echo "<script>setTimeout(function(){ window.location.href = '" . $page_redirect . "'; }, 1000);</script>";
        }
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line ตามคำค้นหา
     */
    public function getstickerstoresearch($txtSearch)
    {
        // หมวดหมู่
        $categoryArray = ['GENERAL' => 'official', 'CREATORS' => 'creator'];

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q    = ['query' => $txtSearch];
        $api  = 'https://store.line.me/api/search/sticker?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = [];
        foreach ($json['items'] as $row) {
            // dump($row);

            // รหัสสติ๊กเกอร์
            $sticker_code = $row['id'];

            // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ายังไม่มีให้ทำงานต่อ
            $rs = Sticker::select('id')->where('sticker_code', $sticker_code)->first();
            if (empty($rs->id)) {

                // ดึงข้อมูลจากหน้าเว็บ store.line
                $crawler_page = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');

                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->count() != 0) {
                        $imgTxt     = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dd($stamp_code);

                        $stamp[] = [
                            'stamp_code' => $stamp_code,
                        ];
                    }
                }

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                $image   = trim($crawler_page->filter('img.FnImage')->attr('src'));
                $image   = explode("/", $image);
                $version = str_replace('v', '', $image[4]);

                // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                $metaUrl = 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta';
                $meta    = json_decode(file_get_contents($metaUrl), true);
                // dump($meta);

                $data[] = [
                    'sticker_code'        => $row['id'],
                    'category'            => $categoryArray[$row['subtype']],
                    'country'             => getCountry($crawler_page->filter('p.mdCMN38Item01Price')->text()),
                    'title_th'            => @$meta['title']['th'] ? $meta['title']['th'] : $meta['title']['en'],
                    'title_en'            => $meta['title']['en'],
                    'author_th'           => @$meta['author']['th'] ? $meta['author']['th'] : $meta['author']['en'],
                    'author_en'           => $meta['author']['en'],
                    'detail'              => @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text()),
                    'credit'              => @trim($crawler_page->filter('a.mdCMN38Item01Author')->text()),
                    'price'               => @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), 0, -3)),
                    'version'             => $version,
                    'onsale'              => $meta['onSale'],
                    'validdays'           => $meta['validDays'],
                    'hasanimation'        => @$meta['hasAnimation'],
                    'hassound'            => @$meta['hasSound'],
                    'stickerresourcetype' => @$meta['stickerResourceType'],
                    'status'              => 1,
                    'created_at'          => date("Y-m-d H:i:s"),
                    'updated_at'          => date("Y-m-d H:i:s"),
                    'stamp_start'         => reset($stamp)['stamp_code'],
                    'stamp_end'           => end($stamp)['stamp_code'],
                ];
            }
        }

        DB::table('stickers')->insert($data);
        dump($data);
    }

    /**
     * ดึงธีมไลน์จากเว็บ store.line ตามคำค้นหา
     *
     *
     *
     */
    public function getthemestoresearch($txtSearch)
    {
        // หมวดหมู่
        $categoryArray = ['GENERAL' => 'official', 'CREATORS' => 'creator'];

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q    = ['query' => $txtSearch];
        $api  = 'https://store.line.me/api/search/theme?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = [];
        foreach ($json['items'] as $row) {
            // dump($row);

            // รหัสธีม
            $theme_code = $row['id'];

            $this->gettheme($theme_code);
        }
    }

    /**
     * ดึงอิโมจิไลน์จากเว็บ store.line ตามคำค้นหา
     *
     *
     *
     */
    public function getemojistoresearch($txtSearch)
    {
        // หมวดหมู่
        $categoryArray = ['GENERAL' => 'official', 'CREATORS' => 'creator'];

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q    = ['query' => $txtSearch];
        $api  = 'https://store.line.me/api/search/emoji?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = [];
        foreach ($json['items'] as $row) {
            // dump($row);

            // รหัสธีม
            $emoji_code = $row['id'];

            // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ายังไม่มีให้ทำงานต่อ
            $rs = Emoji::select('id')->where('emoji_code', $emoji_code)->first();
            if (empty($rs->id)) {

                $crawler_page = Goutte::request('GET', 'https://store.line.me/emojishop/product/' . $emoji_code . '/th');

                $data[] = [
                    'emoji_code'   => $emoji_code,
                    'title'        => trim($crawler_page->filter('h3.mdCMN08Ttl')->text()),
                    'detail'       => trim($crawler_page->filter('p.mdCMN08Desc')->text()),
                    'creator_name' => trim($crawler_page->filter('p.mdCMN08Copy')->text()),
                    'created_at'   => date("Y-m-d H:i:s"),
                    'updated_at'   => date("Y-m-d H:i:s"),
                    'category'     => $categoryArray[$row['subtype']],
                    'country'      => getCountry($crawler_page->filter('p.mdCMN08Price')->text()),
                    'price'        => (int) filter_var(trim($crawler_page->filter('p.mdCMN08Price')->text()), FILTER_SANITIZE_NUMBER_INT),
                    'status'       => 1,
                ];
            }
        }

        DB::table('emojis')->insert($data);
        dump($data);
    }

    public function getEditorPick($page = null, $link_number = null)
    {
        // หน้าเพจเป้าหมาย
        $pageTarget = 'https://store.line.me/editorspick/th?page=' . $page;
        $crawler    = Goutte::request('GET', $pageTarget);

        // foreach วนลูปหา หัวข้อของ editorpick
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($link_number) {

            // dump($node->filter('a')->attr('href'));

            /**
             * ประกาศตัวแปร
             */
            $url       = $node->filter('a')->attr('href');
            $image     = $node->filter('img')->attr('src');
            $title     = $node->filter('img')->attr('alt');
            $sub_title = $node->filter('img')->attr('title');
            // dump($url);
            // dump($sub_title);

            // เปิด 2 บรรทัดนี้ถ้าจะเปลี่ยนเป็นแบบจับทีละลิ้งค์
            $url_number = explode("/", $url)[3];
            if ($link_number == $url_number):

                // บันทึกลงฐานข้อมูล
                $series = Series::updateOrCreate(
                    [
                        'url' => @$url,
                    ],
                    [
                        'image'     => @$image,
                        'title'     => @$title,
                        'sub_title' => @$sub_title,
                        'status'    => 1,
                    ]
                );

                // หาไอดีล่าสุด
                // dd(DB::getPdo()->lastInsertId());
                $seriesId = $series->id;

                // บันทึก series item ตามหน้าที่ scrap
                for ($i = 0; $i <= 10; $i++) {
                    $this->getEditorPickDetail(@$url, $seriesId, $i);
                }

                // สติ๊กเกอร์ :: ค้นหาและบันทึกที่ยังไม่มีในดาค้าเบส
                $seriesItemArray = SeriesItem::where('product_type', 'sticker')->where('series_id', $seriesId)->pluck('product_code')->toArray();
                $dbArray         = Sticker::whereIn('sticker_code', $seriesItemArray)->pluck('sticker_code')->toArray();
                $differenceArray = array_diff($seriesItemArray, $dbArray);
                if (count($differenceArray)) {
                    foreach ($differenceArray as $product_code) {
                        $this->getsticker($product_code);
                    }
                }

                // ธีม :: ค้นหาและบันทึกที่ยังไม่มีในดาค้าเบส
                $seriesItemArray = SeriesItem::where('product_type', 'theme')->where('series_id', $seriesId)->pluck('product_code')->toArray();
                $dbArray         = Theme::whereIn('theme_code', $seriesItemArray)->pluck('theme_code')->toArray();
                $differenceArray = array_diff($seriesItemArray, $dbArray);
                if (count($differenceArray)) {
                    foreach ($differenceArray as $product_code) {
                        $this->gettheme($product_code);
                    }
                }

                // อิโมจิ :: ค้นหาและบันทึกที่ยังไม่มีในดาค้าเบส
                $seriesItemArray = SeriesItem::where('product_type', 'emoji')->where('series_id', $seriesId)->pluck('product_code')->toArray();
                $dbArray         = Emoji::whereIn('emoji_code', $seriesItemArray)->pluck('emoji_code')->toArray();
                $differenceArray = array_diff($seriesItemArray, $dbArray);
                if (count($differenceArray)) {
                    foreach ($differenceArray as $product_code) {
                        $this->getemoji($product_code);
                    }
                }

                dump($title);

                // เปิด 3 บรรทัดนี้ถ้าจะเปลี่ยนเป็นแบบจับทีละลิ้งค์
            else:
                dump('จบ');
            endif;

        }); // endforeach
    }

    // ดึงข้อมูลหน้าในของ editorpick
    public function getEditorPickDetail($url, $seriesId, $page = null)
    {
        // หน้าเพจเป้าหมาย
        $pageTarget = 'https://store.line.me' . $url . '?page=' . $page;
        $crawler    = Goutte::request('GET', $pageTarget);

        // foreach วนลูปหา item ของหน้า
        $crawler->filter('.mdCMN02Li')->each(function ($node, $i) use ($seriesId) {

            $this->getRealLink($node->filter('a')->attr('href'));
            /**
             * ประกาศตัวแปร
             */
            $series_id    = $seriesId;
            $product_code = getProductCodeFromStoreUrl($this->getRealLink($node->filter('a')->attr('href')));
            $product_type = getProductTypeFromStoreUrl($this->getRealLink($node->filter('a')->attr('href')));
            $order        = ($i + 1);
            // dd($product_type);

            // บันทึกลงฐานข้อมูล
            SeriesItem::updateOrCreate(
                [
                    'series_id'    => $series_id,
                    'product_code' => $product_code,
                    'product_type' => $product_type,
                ],
                [
                    'order' => $order,
                ]
            );

        }); // endforeach
    }

    public function getRealLink($href)
    {
        /**
         * ค่าที่ได้จาก sticker :: /stickershop/product/1244010/th
         * ค่าที่ได้จาก theme :: https://store.line.me/themeshop/product/4c08fc1c-a1d2-4bd2-9bb7-d632962e09c2
         * ค่าที่ได้จาก emoji :: /emojishop/product/5cf2068b100cc3b7eeaa0f03/th
         */
        $type = explode("/", $href)[1];

        if ($type == 'stickershop' || $type == 'emojishop') {
            return 'https://store.line.me' . $href;
        } else {
            // theme
            return $href;
        }
    }

    public function getConvert2Bath($price, $country)
    {
        if ($country == 'th') {
            $Bath = [
                '30'  => '30',
                '60'  => '60',
                '90'  => '90',
                '120' => '120',
                '150' => '150',
            ];
        } elseif ($country == 'jp') {
            $Bath = [
                '120' => '30',
                '250' => '60',
                '370' => '90',
                '490' => '120',
                '610' => '150',
            ];
        } elseif ($country == 'tw') {
            $Bath = [
                '30'  => '30',
                '60'  => '60',
                '90'  => '90',
                '120' => '120',
                '150' => '150',
            ];
        }

        return @$Bath[$price];
    }

    public function getConvert2Coin($price, $country)
    {
        if ($country == 'th') {
            $Bath = [
                '31'  => '50',
                '35'  => '50',
                '65'  => '100',
                '69'  => '100',
                '99'  => '150',
                '120' => '200',
                '150' => '250',
            ];
        } elseif ($country == 'jp') {
            $Bath = [
                '120' => '50',
                '250' => '100',
                '370' => '150',
                '490' => '200',
                '610' => '250',
            ];
        } elseif ($country == 'tw') {
            $Bath = [
                '30'  => '50',
                '60'  => '100',
                '90'  => '150',
                '120' => '200',
                '150' => '250',
            ];
        }

        return @$Bath[$price];
    }

    public function getStickerByAuthor($authorID, $page = null)
    {
        // ตรวจสอบว่า $authorID มีอยู่ในตาราง author_log แล้วหรือไม่
        $existingAuthor = DB::table('author_log')->where('author_id', $authorID)->where('type', 'sticker')->first();

        // ถ้าไม่มี $authorID ในตาราง ให้ทำการบันทึก
        if (!$existingAuthor) {
            DB::table('author_log')->insert([
                'author_id'  => $authorID,
                'type'       => 'sticker',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // หน้าเพจเป้าหมาย
        $pageTarget = 'https://store.line.me/stickershop/author/' . $authorID . '?page=' . $page;
        $crawler    = Goutte::request('GET', $pageTarget);

        // foreach
        $stickerCodeArray = $crawler->filter('.mdCMN02Li')->each(function ($node) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า sticker_code
            $sticker_code = explode("/", $url);
            $sticker_code = $sticker_code[3];

            return $array[] = $sticker_code;
        });

        $this->getStickerArray($stickerCodeArray);

        // echo "<script>
        //     setTimeout(function(){
        //         window.close();
        //     }, 1000);
        // </script>";

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page          = $page - 1;
            $page_redirect = url('admin/get-sticker-by-author/' . $authorID . '/' . $page);
            echo "<script>
            setTimeout(function(){
                window.location.href = '" . $page_redirect . "';
            }, 1000);
        </script>";
        } else {
            // ถ้าหน้าถึงหน้าแรกแล้วหรือไม่มีการ redirect ให้ปิดแท็บ
            echo "<script>
            setTimeout(function(){
                window.close();
            }, 1000);
        </script>";
        }
    }

    public function getThemeByAuthor($authorID, $page = null)
    {
        // ตรวจสอบว่า $authorID มีอยู่ในตาราง author_log แล้วหรือไม่
        $existingAuthor = DB::table('author_log')->where('author_id', $authorID)->where('type', 'theme')->first();

        // ถ้าไม่มี $authorID ในตาราง ให้ทำการบันทึก
        if (!$existingAuthor) {
            DB::table('author_log')->insert([
                'author_id'  => $authorID,
                'type'       => 'theme',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // หน้าเพจเป้าหมาย
        $pageTarget = 'https://store.line.me/themeshop/author/' . $authorID . '?page=' . $page;
        $crawler    = Goutte::request('GET', $pageTarget);

        // foreach
        $themeCodeArray = $crawler->filter('.mdCMN02Li')->each(function ($node) {

            // หา url ของธีม
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ ธีมที่ได้มา หาค่า theme_code
            $theme_code = explode('/', $url);
            $theme_code = $theme_code[3];

            return $array[] = $theme_code;
        });

        $this->getthemeArray($themeCodeArray);

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page          = $page - 1;
            $page_redirect = url('admin/get-theme-by-author/' . $authorID . '/' . $page);
            echo "<script>
            setTimeout(function(){
                window.location.href = '" . $page_redirect . "';
            }, 1000);
        </script>";
        } else {
            // ถ้าหน้าถึงหน้าแรกแล้วหรือไม่มีการ redirect ให้ปิดแท็บ
            echo "<script>
            setTimeout(function(){
                window.close();
            }, 1000);
        </script>";
        }
    }

    public function getThemeArray($themeCodeArray, $category = 'creator')
    {
        foreach ($themeCodeArray as $theme_code) {
            $this->gettheme($theme_code, $category = 'creator');
        }
    }

    public function getStickerArray($stickerCodeArray)
    {
        $rs  = Sticker::select('sticker_code')->whereIn('sticker_code', $stickerCodeArray)->pluck('sticker_code')->toArray();
        $rs2 = Emoji::select('emoji_code')->whereIn('emoji_code', $stickerCodeArray)->pluck('emoji_code')->toArray();

        $differenceArray  = array_diff($stickerCodeArray, $rs);
        $differenceArray2 = array_diff($differenceArray, $rs2);
        dump($differenceArray2);

        $arrayDataSticker = [];
        $arrayDataEmoji   = [];
        foreach ($differenceArray2 as $sticker_code) {

            if (Str::length($sticker_code) != 24) {
                $crawler_page = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');

                /**
                 * หา stamp_start & stamp_end  & version
                 */
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->count() != 0) {
                        $imgTxt     = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        $version    = str_replace('v', '', $image_path[4]);
                        // dump($imgTxt);

                        $data[] = [
                            'stamp_code' => $stamp_code,
                        ];
                    }
                }

                /**
                 * หา stamp json
                 */
                $stamp = $crawler_page->filter('ul.FnStickerList > li.FnStickerPreviewItem')->each(function ($node) {
                    $imgTxt     = $node->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->attr('style');
                    $image_path = explode("/", getUrlFromText($imgTxt));
                    $stamp_code = $image_path[6];
                    // dump($stamp_code);
                    // dd('exit');
                    return $stamp_code;
                });

                if (empty($version)) {
                    return false;
                }

                /**
                 * ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                 */
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
                $result = curl_exec($ch);
                curl_close($ch);
                $productInfo = json_decode($result, true);

                /**
                 * insert ลง db
                 */
                $arrayDataSticker[] = [
                    'sticker_code'        => @$sticker_code,
                    'version'             => @$version,
                    'title_th'            => @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'],
                    'title_en'            => @$productInfo['title']['en'],
                    'detail'              => @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text()),
                    'author_th'           => @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'],
                    'author_en'           => @$productInfo['author']['en'],
                    'credit'              => @trim($crawler_page->filter('a.mdCMN38Item01Author')->text()),
                    'created_at'          => date("Y-m-d H:i:s"),
                    'category'            => @$sticker_code > 1000000 ? 'creator' : 'official',
                    'country'             => @money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text())),
                    'price'               => @(int) $productInfo['price'][0]['price'],
                    'status'              => 1,
                    'onsale'              => @$productInfo['onSale'],
                    'validdays'           => @$productInfo['validDays'],
                    'hasanimation'        => @$productInfo['hasAnimation'],
                    'hassound'            => @$productInfo['hasSound'],
                    'stickerresourcetype' => @$productInfo['stickerResourceType'],
                    'stamp_start'         => @reset($data)['stamp_code'],
                    'stamp_end'           => @end($data)['stamp_code'],
                    'stamp'               => json_encode(@$stamp),
                ];

                dump($sticker_code);
            } else {
                $emoji_code   = $sticker_code;
                $crawler_page = Goutte::request('GET', 'https://store.line.me/emojishop/product/' . $emoji_code . '/th');

                // insert ลง db
                $arrayDataEmoji[] = [
                    'emoji_code'   => $emoji_code,
                    'title'        => trim($crawler_page->filter('.mdCMN38Item01Ttl')->text()),
                    'detail'       => trim($crawler_page->filter('.mdCMN38Item01Txt')->text()),
                    'creator_name' => trim($crawler_page->filter('.mdCMN38Item01Author')->text()),
                    'created_at'   => date("Y-m-d H:i:s"),
                    'category'     => 'creator',
                    'country'      => @money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text())),
                    'price'        => $this->getConvert2Coin((int) filter_var(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), FILTER_SANITIZE_NUMBER_INT), @money2country(preg_replace('/[0-9]+/', '', $crawler_page->filter('p.mdCMN38Item01Price')->text()))),
                    'status'       => 1,
                ];

                dump($emoji_code);
            }
        }

        // dd($arrayDataSticker);
        if ($arrayDataSticker) {
            Sticker::insert($arrayDataSticker);
        }

        if ($arrayDataEmoji) {
            Emoji::insert($arrayDataEmoji);
        }
    }
}
