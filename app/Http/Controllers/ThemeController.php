<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use OpenGraph;
use SEO;
use SEOMeta;

class ThemeController extends Controller
{
    public function getIndex()
    {

    }

    public function getOfficial($country, $type)
    {
        // SEO
        SEO::setTitle('ธีมไลน์ทางการ' . ($country == 'thai' ? 'ไทย' : 'ต่างประเทศ') . 'ยอดนิยม');
        SEO::setDescription('รวมธีมไลน์ทางการ' . ($country == 'thai' ? 'ไทย' : 'ต่างประเทศ') . 'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['theme'] = new Theme;
        $data['theme'] = $data['theme']
            ->where('status', 1)
            ->where('category', 'official')
            ->where(function ($q) use ($country) {

                // ประเทศ : thai, oversea
                if ($country == 'thai') {
                    $q->whereIn('country', ['gb','th']);
                } elseif ($country == 'oversea') {
                    $q->whereNotIn('country', ['gb','th']);
                }

            })
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);
        return view('theme.official', $data);
    }

    public function getCreator($type)
    {
        // SEO
        SEO::setTitle('ธีมไลน์ครีเอเตอร์ยอดนิยม');
        SEO::setDescription('รวมธีมไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

        if ($type == 'top') {
            $orderByField = 'threedays';
        } elseif ($type == 'new') {
            $orderByField = 'id';
        }

        $data['theme'] = new Theme;
        $data['theme'] = $data['theme']
            ->where('category', 'creator')
            ->where('status', 1)
            ->orderBy($orderByField, 'desc')
            ->simplePaginate(30);
        return view('theme.creator', $data);
    }

    public function getProduct($id)
    {
        // cache file
        // $data['rs'] = Cache::rememberForever('theme_'.$id, function() use ($id) {
        //     return DB::table('themes')->find($id);
        // });

        $data['rs'] = Theme::findOrFail($id);

        // if (empty($data['rs'])) {
        //     return abort(404);
        // }

        // SEO
        SEO::setTitle('ธีมไลน์ ' . $data['rs']->title);
        SEO::setDescription('ธีมไลน์ ' . $data['rs']->detail);
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/' . $data['rs']->theme_code . '/1/WEBSTORE/icon_198x278.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords(str_replace(" ", ", ", $data['rs']->title) . ', line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        // SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        OpenGraph::addProperty('image:width', '198');
        OpenGraph::addProperty('image:height', '278');

        return view('theme.product', $data);
    }
}
