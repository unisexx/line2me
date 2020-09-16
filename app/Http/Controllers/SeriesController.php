<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\SeriesItem;
use SEO;

class SeriesController extends Controller
{
    public function getIndex()
    {
        $rs = Series::select('*');
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

        $rs = Series::findOrFail($id);
        $rs->touch();
        $series_items = SeriesItem::where('series_id', $id)
            ->with(['sticker' => function ($q) {
                $q->orderBy('threedays', 'desc');
            }])
            ->with(['theme' => function ($q) {
                $q->orderBy('threedays', 'desc');
            }])
            ->with(['emoji' => function ($q) {
                $q->orderBy('threedays', 'desc');
            }])->simplePaginate(90);

        // more
        $more_series = Series::where('id', '!=', $id)->take(3)->inRandomOrder()->get();

        // SEO
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์แนะนำชุด' . $rs->title);

        return view('series.detail', compact('rs', 'series_items', 'more_series'));
    }
}
