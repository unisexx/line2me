<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Emoji;
use App\Models\Sticker;
use App\Models\Theme;

use DB;
use Goutte;
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
        $this->middleware('auth');
    }

    public function getTest(){
        $crawler = Goutte::request('GET', 'https://yabeline.tw/Homepage.php');
        print_r($crawler);
    }

    public function getsticker($sticker_code){
        // นำ sticker_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Sticker::select('id')->where('sticker_code',$sticker_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)){

            $crawler_page = Goutte::request('GET','https://store.line.me/stickershop/product/'.$sticker_code.'/th');

            // หา stamp_start & stamp_end
            for ($i = 0; $i < 40; $i++) {
                // check node empty
                if ($crawler_page->filter('span.mdCMN09Image.FnCustomBase')->eq($i)->count() != 0) {
                    $imgTxt = $crawler_page->filter('span.mdCMN09Image.FnCustomBase')->eq($i)->attr('style');
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
            $version = str_replace('v','',$image[4]);

            // ดึงข้อมูลสติ๊กเกอร์จาก meta ไฟล์
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,'http://dl.stickershop.line.naver.jp/products/0/0/'.$version.'/'.$sticker_code.'/LINEStorePC/productInfo.meta');
            $result=curl_exec($ch);
            curl_close($ch);
            $productInfo = json_decode($result, true);

            $title_th            = @$productInfo['title']['th'] ? $productInfo['title']['th'] : $productInfo['title']['en'];
            $title_en            = $productInfo['title']['en'];
            $author_th           = @$productInfo['author']['th'] ? $productInfo['author']['th'] : $productInfo['author']['en'];
            $author_en           = $productInfo['author']['en'];
            $onsale              = $productInfo['onSale'];
            $hasanimation        = $productInfo['hasAnimation'];
            $hassound            = $productInfo['hasSound'];
            $validdays           = $productInfo['validDays'];
            $stickerresourcetype = $productInfo['stickerResourceType'];

            $detail              = @trim($crawler_page->filter('p.mdCMN38Item01Txt')->text());
            $credit              = @trim($crawler_page->filter('a.mdCMN38Item01Author')->text());
            $sticker_code        = $sticker_code;
            $created             = date("Y-m-d H:i:s");
            $price               = @th_2_coin(substr(trim($crawler_page->filter('p.mdCMN38Item01Price')->text()),0,-3));
            $country             = "thai";
            $stamp_start         = reset($data)['stamp_code'];
            $stamp_end           = end($data)['stamp_code'];

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
                    'stamp_end'           => $stamp_end
                ]
            );

            unset($data);

            dump($title_th);
        }// endif
    }

    public function gettheme($theme_code){
        // นำ theme_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Theme::select('id')->where('theme_code',$theme_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)){

            $crawler_page = Goutte::request('GET','https://store.line.me/themeshop/product/'.$theme_code.'/th');

            $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
            $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
            $author = trim($crawler_page->filter('p.mdCMN08Copy')->text());
            $credit = trim($crawler_page->filter('p.mdCMN09Copy')->text());
            $price = substr(trim($crawler_page->filter('p.mdCMN08Price')->text()),0,-3);

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
                    'price'      => $price,
                    'status'     => 'approve',
                ]
            );

            dump($title);
        }// endif
    }

    public function getemoji($emoji_code){
        // นำ emoji_code มาค้นหาใส DB ว่ามีไหม ถ้ามีอยู่แล้วให้ข้ามไป
        $rs = Emoji::select('id')->where('emoji_code',$emoji_code)->first();

        // ถ้ายังไม่มีค่าใน DB
        if (empty($rs->id)){

            $crawler_page = Goutte::request('GET','https://store.line.me/emojishop/product/'.$emoji_code.'/th');

            $title = trim($crawler_page->filter('h3.mdCMN08Ttl')->text());
            $creator_name = trim($crawler_page->filter('p.mdCMN08Copy')->text());
            $detail = trim($crawler_page->filter('p.mdCMN08Desc')->text());
            $country = "global";
            $price = substr(trim($crawler_page->filter('p.mdCMN08Price')->text()),0,-3);

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
        }// endif
    }
}
