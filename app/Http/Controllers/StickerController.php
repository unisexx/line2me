<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sticker;
use Cache;
use DB;
use Illuminate\Support\Facades\Redis;
use OpenGraph;
use SEO;
use SEOMeta;

// use Carbon;

class StickerController extends Controller
{
    public function getIndex()
    {}

    public function getOfficial($country, $type)
    {
        // SEO
        SEO::setTitle('สติ๊กเกอร์ไลน์ทางการ' . @getCountryTh($country) . ($type == 'top' ? 'ยอดนิยม' : 'ใหม่ล่าสุด'));
        SEO::setDescription('รวมสติ๊กเกอร์ไลน์ทางการ' . @getCountryTh($country) . 'ขายดีแนะนำ' . ($type == 'top' ? 'ยอดนิยม' : 'ใหม่ล่าสุด'));

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
                    $q->whereNotIn('country', ['gb', 'th', 'jp', 'tw', 'id']);
                } elseif ($country == 'oversea') {
                    $q->whereNotIn('country', ['gb', 'th']);
                } elseif ($country == 'th') {
                    $q->whereIn('country', ['gb', 'th']);
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
                if ($country == 'all') {

                } elseif ($country == 'oversea') {
                    $q->whereNotIn('country', ['gb', 'th']);
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
        // Redis::set('CacheTest', 'asdfasdfasdf');
        // $data = Redis::get('CacheTest');
        // dd($data);

        // ใช้ Cache File
        $data['rs'] = Cache::rememberForever('stickers_' . $id, function () use ($id) {
            return DB::table('stickers')->where('sticker_code', $id)->first();
        });

        // $data['rs'] = Cache::remember('stickers_'.$id, 60, function() use ($id) {
        //     return DB::table('stickers')->where('sticker_code',$id)->first();
        // });

        // ใช้ Redis Cache
        // $redis = Redis::get('stickers_' . $id);
        // dump($redis);

        // if ($redis) {
        //     $data['rs'] = json_decode($redis);
        // } else {
        //     $data['rs'] = DB::table('stickers')->where('sticker_code', $id)->first();
        //     // Cache::store('redis')->put('stickers_' . $id, json_encode($data['rs']), "ex", 1000);
        //     // dd($data['rs']);
        //     Redis::set('stickers_' . $id, json_encode($data['rs']), "ex", 1000);
        // }

        // $data['rs'] = Sticker::where('sticker_code', $id)->firstOrFail();

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

    public function getProductRedirect($id = null)
    {
        return redirect('sticker/' . $id);
    }
}
