<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sticker;
use OpenGraph;
use SEO;
use SEOMeta;

class StickerController extends Controller
{
    public function getIndex()
    {}

    public function getOfficial($country, $type)
    {
        // SEO
        SEO::setTitle('สติ๊กเกอร์ไลน์ทางการ' . ($country == 'thai' ? 'ไทย' : 'ต่างประเทศ') . 'ยอดนิยม');
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ทางการ' . ($country == 'thai' ? 'ไทย' : 'ต่างประเทศ') . 'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        // ประเภท : top, new
        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['sticker'] = new Sticker;
        $data['sticker'] = $data['sticker']
            ->where('status', 1)
            ->where('category', 'official')
            ->where(function ($q) use ($country) {
                // ประเทศ : thai, oversea
                if ($country == 'othercountry') {
                    $q->whereNotIn('country', ['global','thai','japan','taiwan','indonesia']);
                } elseif($country == 'oversea') {
                    $q->whereNotIn('country', ['global','thai']);
                } else {
                    $q->where('country', $country);
                }
            })
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);

        return view('sticker.official', $data);
    }

    public function getCreator($country, $type)
    {
        // SEO
        SEO::setTitle('สติ๊กเกอร์ไลน์ครีเอเตอร์ยอดนิยม');
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['sticker'] = new Sticker;
        $data['sticker'] = $data['sticker']
            ->where('status', 1)
            ->where(function ($q) use ($country) {
                // ประเทศ : thai, oversea
                if($country == 'all'){

                } elseif($country == 'oversea') {
                    $q->whereNotIn('country', ['global','thai']);
                } else {
                    $q->where('country', $country);
                }
            })
            ->where('category', 'creator')
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);
        return view('sticker.creator', $data);
    }

    public function getProduct($id = null)
    {
        // ใช้ Cache File
        // $data['rs'] = Cache::rememberForever('stickers_'.$id, function() use ($id) {
        //     return DB::table('stickers')->where('sticker_code',$id)->first();
        // });
        // $data['rs'] = Cache::remember('stickers_'.$id, 60, function() use ($id) {
        //     return DB::table('stickers')->where('sticker_code',$id)->first();
        // });

        // ใช้ Redis Cache
        // $redis = Redis::get('laravel:stickers_'.$id);
        // if ($redis) {
        //     $data['rs'] = unserialize($redis);
        // }else{
        //     $data['rs'] = DB::table('stickers')->where('sticker_code',$id)->first();
        //     Cache::store('redis')->put('stickers_'.$id, $data['rs'], 10);
        // }

        $data['rs'] = Sticker::where('sticker_code', $id)->firstOrFail();

        if (empty($data['rs'])) {
            return abort(404);
        }

        // SEO
        SEO::setTitle('สติ๊กเกอร์ไลน์ ' . $data['rs']->title_th);
        SEO::setDescription('สติ๊กเกอร์ไลน์' . $data['rs']->detail);
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('http://sdl-stickershop.line.naver.jp/products/0/0/' . $data['rs']->version . '/' . $data['rs']->sticker_code . '/LINEStorePC/main.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords(str_replace(" ", ", ", $data['rs']->title_th) . ', line, sticker, theme, emoji, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, อิโมจิ, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ', 'เติมคำ');
        // SEOMeta::addKeyword(str_replace(" ",", ",$data['rs']->title_th));
        OpenGraph::addProperty('image:width', '240');
        OpenGraph::addProperty('image:height', '240');

        return view('sticker.product', $data);
    }
}
