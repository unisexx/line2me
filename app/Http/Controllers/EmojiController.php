<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Emoji;
use Cache;
use DB;
use OpenGraph;
use SEO;
use SEOMeta;

class EmojiController extends Controller
{
    public function getIndex()
    {

    }

    public function getOfficial($country, $type)
    {
        // SEO
        SEO::setTitle('อีโมจิไลน์ทางการ' . ($country == 'th' ? 'ไทย' : 'ต่างประเทศ') . 'ยอดนิยม');
        SEO::setDescription('รวมอิโมจิไลน์ทางการ' . ($country == 'th' ? 'ไทย' : 'ต่างประเทศ') . 'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['emoji'] = new Emoji;
        $data['emoji'] = $data['emoji']
            ->where('status', 1)
            ->where('category', 'official')
            ->where(function ($q) use ($country) {

                // ประเทศ : thai, oversea
                if ($country == 'th') {
                    $q->whereIn('country', ['gb', 'th']);
                } elseif ($country == 'oversea') {
                    $q->whereNotIn('country', ['gb', 'th']);
                } else {
                    $q->where('country', $country);
                }

            })
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);
        return view('emoji.official', $data);
    }

    public function getCreator($type)
    {
        // SEO
        SEO::setTitle('อิโมจิครีเอเตอร์ยอดนิยม');
        SEO::setDescription('รวมอิโมจิไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['emoji'] = new Emoji;
        $data['emoji'] = $data['emoji']
            ->where('category', 'creator')
            ->where('status', 1)
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);
        return view('emoji.creator', $data);
    }

    public function getProduct($id)
    {
        // cache file
        $data['rs'] = Cache::rememberForever('emoji_' . $id, function () use ($id) {
            return DB::table('emojis')->find($id);
        });

        // $data['rs'] = Emoji::findOrFail($id);

        // if (empty($data['rs'])) {
        //     return abort(404);
        // }

        // SEO
        SEO::setTitle('อิโมจิไลน์ ' . $data['rs']->title);
        SEO::setDescription('อิโมจิไลน์' . $data['rs']->detail);
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://stickershop.line-scdn.net/sticonshop/v1/product/' . $data['rs']->emoji_code . '/iphone/main.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords(str_replace(" ", ", ", $data['rs']->title) . ', line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        // SEOMeta::addKeyword('line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        OpenGraph::addProperty('image:width', '240');
        OpenGraph::addProperty('image:height', '240');

        return view('emoji.product', $data);
    }

    public function getProductRedirect($id = null)
    {
        return redirect('emoji/' . $id);
    }
}
