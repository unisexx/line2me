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
        $rs = $rs->orderBY('hilight', 'desc')->orderBy('updated_at', 'desc')->with('seriesItem')->simplePaginate(30);

        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ชุดน่าสนใจ');

        return view('series.index2', compact('rs'));
    }

    public function getDetail($id)
    {
        // $rs = Series::with('seriesItem.sticker', 'seriesItem.theme', 'seriesItem.emoji')->findOrFail($id);
        // $rs->touch();

        $rs = Series::findOrFail($id);
        $rs->touch();
        $series_items = SeriesItem::with('sticker', 'theme', 'emoji')->where('series_id', $id)->simplePaginate(30);

        // SEO
        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ชุด' . $rs->title);

        return view('series.detail', compact('rs', 'series_items'));
    }
}
