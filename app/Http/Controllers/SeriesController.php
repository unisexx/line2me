<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\SeriesItem;
use Cache;
use OpenGraph;
use SEO;
use SEOMeta;

class SeriesController extends Controller
{
    public function getIndex()
    {
        $rs = Series::select('*')->where('status', 1);
        if (!empty($keyword)) {
            $rs = $rs->where('title', 'LIKE', "%$keyword%");
        }
        $rs = $rs->orderBY('hilight', 'desc')->orderBy('updated_at', 'desc')->simplePaginate(30);

        SEO::setTitle('รวมสติ๊กเกอร์ไลน์แนะนำชุดน่าสนใจ');

        return view('series.index2', compact('rs'));
    }

    public function getDetail($id)
    {
        // $rs = Series::with('seriesItem.sticker', 'seriesItem.theme', 'seriesItem.emoji')->findOrFail($id);
        // $rs->touch();

        // $rs = Series::findOrFail($id);
        // $rs->touch();
        // $series_items = SeriesItem::where('series_id', $id)
        //     ->with(['sticker' => function ($q) {
        //         $q->orderBy('threedays', 'desc');
        //     }])
        //     ->with(['theme' => function ($q) {
        //         $q->orderBy('threedays', 'desc');
        //     }])
        //     ->with(['emoji' => function ($q) {
        //         $q->orderBy('threedays', 'desc');
        //     }])->orderBy('order', 'asc')->simplePaginate(90);

        $rs = Cache::remember('series_' . $id, config('calculations.cache_time'), function () use ($id) {
            return Series::findOrFail($id);
        });
        $series_items = Cache::remember('series_items_' . $id . '_' . @$_GET['page'], config('calculations.cache_time'), function () use ($id) {
            return SeriesItem::where('series_id', $id)
                ->with(['sticker' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])
                ->with(['theme' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])
                ->with(['emoji' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])->orderBy('order', 'asc')->simplePaginate(120);
        });

        // more
        $more_series = Series::where('id', '!=', $id)->take(3)->inRandomOrder()->get();

        // SEO
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์แนะนำชุด' . $rs->title);
        SEO::setDescription('ขายสติ๊กเกอร์ไลน์ลิขสิทธิ์ของแท้ ไม่มีหาย ติดต่อไลน์ไอดี ratasak1234');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages($rs->image);
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords(str_replace(" ", ", ", $rs->title) . ',' . str_replace(" ", ", ", $rs->sub_title) . ', line, sticker, theme, emoji, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, อิโมจิ, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, เติมคำ, รีวิว, รวมชุด, แนะนำ');
        OpenGraph::addProperty('image:width', '240');
        OpenGraph::addProperty('image:height', '240');

        return view('series.detail', compact('rs', 'series_items', 'more_series'));
    }
}
