<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emoji;
use App\Models\Sticker;
use App\Models\Theme;
use DB;
use Goutte;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrawlerController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('admin.crawler.index');
    }

    public function getTest()
    {
        $crawler = Goutte::request('GET', 'https://yabeline.tw/Homepage.php');
        print_r($crawler);
    }

    /**
     *
     *
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line ตาม sticker_code ที่กรอกข้อมูล
     *
     */
    public function getsticker($sticker_code)
    {
        // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Sticker::select('id')->where('sticker_code', $sticker_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)) {

            $crawler_page = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');

            // หา stamp_start & stamp_end
            for ($i = 0; $i < 40; $i++) {
                // check node empty
                if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->count() != 0) {
                    $imgTxt = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                    $image_path = explode("/", getUrlFromText($imgTxt));
                    $stamp_code = $image_path[6];
                    // dump($imgTxt);

                    $data[] = array(
                        'stamp_code' => $stamp_code,
                    );
                }
            }

            // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
            // $image = trim($crawler_page->filter('div.mdCMN08Img > img')->attr('src'));
            $image = trim($crawler_page->filter('img.FnImage')->attr('src'));
            $image = explode("/", $image);
            $version = str_replace('v', '', $image[4]);

            // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
            $result = curl_exec($ch);
            curl_close($ch);
            $productInfo = json_decode($result, true);

            // dd($productInfo);

            $title_th = @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'];
            $title_en = $productInfo['title']['en'];
            $author_th = @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'];
            $author_en = $productInfo['author']['en'];
            $onsale = $productInfo['onSale'];
            $hasanimation = @$productInfo['hasAnimation'];
            $hassound = @$productInfo['hasSound'];
            $validdays = $productInfo['validDays'];
            $stickerresourcetype = @$productInfo['stickerResourceType'];

            $detail = @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text());
            $credit = @trim($crawler_page->filter('a.mdCMN38Item01Author')->text());
            $sticker_code = $sticker_code;
            $created = date("Y-m-d H:i:s");
            $price = @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), 0, -3));
            $country = "thai";
            $stamp_start = reset($data)['stamp_code'];
            $stamp_end = end($data)['stamp_code'];

            // dump($productInfo);
            // dump($price);

            // insert ลง db
            DB::table('stickers')->insert(
                [
                    'sticker_code'        => $sticker_code,
                    'version'             => $version,
                    'title_th'            => $title_th,
                    'title_en'            => $title_en,
                    'detail'              => $detail,
                    'author_th'           => $author_th,
                    'author_en'           => $author_en,
                    'credit'              => $credit,
                    'created_at'          => date("Y-m-d H:i:s"),
                    'category'            => 'creator',
                    'country'             => 'thai',
                    'price'               => $price,
                    'status'              => 'approve',
                    'onsale'              => $onsale,
                    'validdays'           => $validdays,
                    'hasanimation'        => $hasanimation,
                    'hassound'            => $hassound,
                    'stickerresourcetype' => $stickerresourcetype,
                    'stamp_start'         => $stamp_start,
                    'stamp_end'           => $stamp_end,
                ]
            );

            unset($data);

            dump($title_th);
        } else {
            dump("มีสติ๊กเกอร์ชุดนี้ในระบบแล้ว!!!");
        } // endif
    }

    /**
     *
     *
     * ดึงธีมไลน์จากเว็บ store.line ตาม theme_code ที่กรอกข้อมูล
     *
     */
    public function gettheme($theme_code)
    {
        // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Theme::select('id')->where('theme_code', $theme_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)) {

            $crawler_page = Goutte::request('GET', 'https://store.line.me/themeshop/product/' . $theme_code . '/th');

            $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
            $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
            $author = trim($crawler_page->filter('p.mdCMN08Copy')->text());
            $credit = trim($crawler_page->filter('p.mdCMN09Copy')->text());

            // insert ลง db
            DB::table('themes')->insert(
                [
                    'theme_code' => $theme_code,
                    'title'      => $title,
                    'detail'     => $detail,
                    'author'     => $author,
                    'credit'     => $credit,
                    'created_at' => date("Y-m-d H:i:s"),
                    'category'   => 'creator',
                    'country'    => 'thai',
                    'price'      => (int) filter_var(trim($crawler_page->filter('p.mdCMN08Price')->text()), FILTER_SANITIZE_NUMBER_INT),
                    'status'     => 'approve',
                ]
            );

            dump($title);
        } else {
            dump("มีธีมชุดนี้ในระบบแล้ว!!!");
        } // endif
    }

    /**
     *
     *
     * ดึงอิโมจิไลน์จากเว็บ store.line ตาม emoji_code ที่กรอกข้อมูล
     *
     */
    public function getemoji($emoji_code)
    {
        // นำ emoji_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Emoji::select('id')->where('emoji_code', $emoji_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)) {

            $crawler_page = Goutte::request('GET', 'https://store.line.me/emojishop/product/' . $emoji_code . '/th');

            $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
            $creator_name = trim($crawler_page->filter('p.mdCMN08Copy')->text());
            $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
            $country = "global";
            $price = substr(trim($crawler_page->filter('p.mdCMN08Price')->text()), 0, -3);

            // insert ลง db
            DB::table('emojis')->insert(
                [
                    'emoji_code'   => $emoji_code,
                    'title'        => $title,
                    'detail'       => $detail,
                    'creator_name' => $creator_name,
                    'created_at'   => date("Y-m-d H:i:s"),
                    'category'     => 'creator',
                    'country'      => 'thai',
                    'price'        => $price,
                    'status'       => 'approve',
                ]
            );

            dump($title);
        } else {
            dump("มีอิโมจิชุดนี้ในระบบแล้ว!!!");
        } // endif
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line
     * Type: 1 = official, 2 = creator
     * cat : top, new, top_creators, new_top_creators, new_creators
     * Page: หน้าที่จะเข้าไปดึงข้อมูล
     */
    public static function getstickerstore($type, $cat, $page = null)
    {
        if ($type == 1) {
            // official
            $pageTarget = 'https://store.line.me/stickershop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'official';
        } elseif ($type == 2) {
            // creator
            $pageTarget = 'https://store.line.me/stickershop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($category) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า sticker_code
            $sticker_code = explode("/", $url);
            $sticker_code = $sticker_code[3];
            // dump($sticker_code);

            // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Sticker::select('id')->where('sticker_code', $sticker_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)) {

                $crawler_page = Goutte::request('GET', 'https://store.line.me/stickershop/product/' . $sticker_code . '/th');
                // dd($crawler_page);

                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->count() != 0) {
                        $imgTxt = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                        // dd($imgTxt);
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];

                        $data[] = array(
                            'stamp_code' => $stamp_code,
                        );
                    }
                }

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                // $image = trim($crawler_page->filter('div.mdCMN08Img > img')->attr('src'));
                $image = trim($crawler_page->filter('.mdCMN38Img > img')->attr('src'));
                $image = explode("/", $image);
                $version = str_replace('v', '', $image[4]);

                // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_URL, 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta');
                $result = curl_exec($ch);
                curl_close($ch);
                $productInfo = json_decode($result, true);

                $title_th = @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'];
                $title_en = $productInfo['title']['en'];
                $author_th = @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'];
                $author_en = $productInfo['author']['en'];
                $onsale = $productInfo['onSale'];
                $hasanimation = @$productInfo['hasAnimation'];
                $hassound = @$productInfo['hasSound'];
                $validdays = $productInfo['validDays'];
                $stickerresourcetype = @$productInfo['stickerResourceType'];

                $detail = @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text());
                $credit = @trim($crawler_page->filter('a.mdCMN38Item01Author')->text());
                $sticker_code = $sticker_code;
                $created = date("Y-m-d H:i:s");
                $price = @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()), 0, -3));
                $country = "thai";
                $stamp_start = reset($data)['stamp_code'];
                $stamp_end = end($data)['stamp_code'];

                // dump($productInfo);
                // dump($price);

                // insert ลง db
                DB::table('stickers')->insert(
                    [
                        'sticker_code'        => $sticker_code,
                        'version'             => $version,
                        'title_th'            => $title_th,
                        'title_en'            => $title_en,
                        'detail'              => $detail,
                        'author_th'           => $author_th,
                        'author_en'           => $author_en,
                        'credit'              => $credit,
                        'created_at'          => date("Y-m-d H:i:s"),
                        'category'            => $category,
                        'country'             => $country,
                        'price'               => $price,
                        'status'              => 'approve',
                        'onsale'              => $onsale,
                        'validdays'           => $validdays,
                        'hasanimation'        => $hasanimation,
                        'hassound'            => $hassound,
                        'stickerresourcetype' => $stickerresourcetype,
                        'stamp_start'         => $stamp_start,
                        'stamp_end'           => $stamp_end,
                    ]
                );

                unset($data);

                dump($title_th);
            } // endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page = $page - 1;
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
    public static function getthemestore($type, $cat, $page = null)
    {
        if ($type == 1) {
            // official
            $pageTarget = 'https://store.line.me/themeshop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'official';
        } elseif ($type == 2) {
            // creator
            $pageTarget = 'https://store.line.me/themeshop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($category) {

            // หา url ของสติ๊กเกอร์
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ สติ๊กเกอร์ที่ได้มา หาค่า theme_code
            $theme_code = explode('/', $url);
            $theme_code = $theme_code[3];

            // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Theme::select('id')->where('theme_code', $theme_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)) {

                $crawler_page = Goutte::request('GET', 'https://store.line.me/themeshop/product/' . $theme_code . '/th');

                $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
                $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                $author = trim($crawler_page->filter('p.mdCMN08Copy')->text());
                $credit = trim($crawler_page->filter('p.mdCMN09Copy')->text());

                // insert ลง db
                DB::table('themes')->insert(
                    [
                        'theme_code' => $theme_code,
                        'title'      => $title,
                        'slug'       => Str::slug($title, '-'),
                        'detail'     => $detail,
                        'author'     => $author,
                        'credit'     => $credit,
                        'created_at' => date("Y-m-d H:i:s"),
                        'category'   => $category,
                        'country'    => 'thai',
                        'price'      => (int) filter_var(trim($crawler_page->filter('p.mdCMN08Price')->text()), FILTER_SANITIZE_NUMBER_INT),
                        'status'     => 'approve',
                    ]
                );

                dump($title);
            } // endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page = $page - 1;
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
    public static function getemojistore($type, $cat, $page = null)
    {
        if ($type == 1) {
            // official
            $pageTarget = 'https://store.line.me/emojishop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'official';
        } elseif ($type == 2) {
            // creator
            $pageTarget = 'https://store.line.me/emojishop/showcase/' . $cat . '/th?page=' . $page;
            $category = 'creator';
        }

        $crawler = Goutte::request('GET', $pageTarget);

        // foreach
        $crawler->filter('.mdCMN02Li')->each(function ($node) use ($category) {

            // หา url ของอโมจิ
            $url = $node->filter('a')->attr('href');

            // เอาลิ้งค์ อิโมจิที่ได้มา หาค่า emoji_code
            $emoji_code = explode("/", $url);
            $emoji_code = $emoji_code[3];

            // นำ emoji_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
            $rs = Emoji::select('id')->where('emoji_code', $emoji_code)->first();

            // ถ้ายังไม่มีค่าใน DB
            if (empty($rs->id)) {

                $crawler_page = Goutte::request('GET', 'https://store.line.me/emojishop/product/' . $emoji_code . '/th');

                $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
                $creator_name = trim($crawler_page->filter('p.mdCMN08Copy')->text());
                $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
                $country = "global";
                $txtprice = trim($crawler_page->filter('p.mdCMN08Price')->text());
                $price = (int) filter_var($txtprice, FILTER_SANITIZE_NUMBER_INT);

                // insert ลง db
                DB::table('emojis')->insert(
                    [
                        'emoji_code'   => $emoji_code,
                        'title'        => $title,
                        'detail'       => $detail,
                        'creator_name' => $creator_name,
                        'created_at'   => date("Y-m-d H:i:s"),
                        'category'     => $category,
                        'country'      => $country,
                        'slug'         => Str::slug($title, '-'),
                        'price'        => $price,
                        'status'       => 'approve',
                    ]
                );

                dump($title);
            } // endif

            // exit();
        }); // endforeach

        // ดำเนินการเสร็จทั้งหมดแล้ว ให้ redirect ถ้า $page ยังไม่ถึงหน้าแรก
        if (isset($page) && $page != 1) {
            $page = $page - 1;
            $page_redirect = url('admin/getemojistore/' . $type . '/' . $cat . '/' . $page);
            echo "<script>setTimeout(function(){ window.location.href = '" . $page_redirect . "'; }, 1000);</script>";
        }
    }

    /**
     * ดึงสติ๊กเกอร์ไลน์จากเว็บ store.line ตามคำค้นหา
     *
     *
     *
     */
    public function getstickerstoresearch($txtSearch)
    {
        // หมวดหมู่
        $categoryArray = array('GENERAL' => 'official', 'CREATORS' => 'creator');

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q = array('query' => $txtSearch);
        $api = 'https://store.line.me/api/search/sticker?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = array();
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
                        $imgTxt = $crawler_page->filter('div.mdCMN09LiInner.FnImage > span.mdCMN09Image:last-child')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dd($stamp_code);

                        $stamp[] = array(
                            'stamp_code' => $stamp_code,
                        );
                    }
                }

                // หาเวอร์ชั่นของสติ๊กเกอร์โดยวิเคราะห์จาก url ของรูปสติ๊กเกอร์
                $image = trim($crawler_page->filter('img.FnImage')->attr('src'));
                $image = explode("/", $image);
                $version = str_replace('v', '', $image[4]);

                // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
                $metaUrl = 'http://dl.stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/productInfo.meta';
                $meta = json_decode(file_get_contents($metaUrl), true);
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
                    'status'              => 'approve',
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
        $categoryArray = array('GENERAL' => 'official', 'CREATORS' => 'creator');

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q = array('query' => $txtSearch);
        $api = 'https://store.line.me/api/search/theme?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = array();
        foreach ($json['items'] as $row) {
            // dump($row);

            // รหัสธีม
            $theme_code = $row['id'];

            // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ายังไม่มีให้ทำงานต่อ
            $rs = Theme::select('id')->where('theme_code', $theme_code)->first();
            if (empty($rs->id)) {

                $crawler_page = Goutte::request('GET', 'https://store.line.me/themeshop/product/' . $theme_code . '/th');

                $data[] = [
                    'theme_code' => $theme_code,
                    'title'      => trim($crawler_page->filter('h3.mdCMN08Ttl')->text()),
                    'detail'     => trim($crawler_page->filter('p.mdCMN08Desc')->text()),
                    'author'     => trim($crawler_page->filter('p.mdCMN08Copy')->text()),
                    'credit'     => trim($crawler_page->filter('p.mdCMN09Copy')->text()),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'category'   => $categoryArray[$row['subtype']],
                    'country'    => getCountry($crawler_page->filter('p.mdCMN08Price')->text()),
                    'price'      => (int) filter_var(trim($crawler_page->filter('p.mdCMN08Price')->text()), FILTER_SANITIZE_NUMBER_INT),
                    'status'     => 'approve',
                ];
            }
        }

        DB::table('themes')->insert($data);
        dump($data);
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
        $categoryArray = array('GENERAL' => 'official', 'CREATORS' => 'creator');

        // แปลงคำค้นหา ภาษาไทย ให้เป็น http_build_query ไม่งั้นจะดึงค่าไม่ได้
        $q = array('query' => $txtSearch);
        $api = 'https://store.line.me/api/search/emoji?' . http_build_query($q) . '&offset=0&limit=50&type=ALL&includeFacets=true';
        $json = json_decode(file_get_contents($api), true);
        // dd($json);

        $data = array();
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
                    'status'       => 'approve',
                ];
            }
        }

        DB::table('emojis')->insert($data);
        dump($data);
    }
}
