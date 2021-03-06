<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Emoji;
use App\Models\NewArrival;
use App\Models\Sticker;
use App\Models\Theme;
use SEO;

class NewArrivalController extends Controller
{
    public function getIndex()
    {
        $rs = NewArrival::select('*');
        if (!empty($keyword)) {
            $rs = $rs->where('title', 'LIKE', "%$keyword%");
        }
        $rs = $rs->orderBy('id', 'desc')->simplePaginate(30);

        SEO::setTitle('รวมสติ๊กเกอร์ไลน์ทางการอัพเดทใหม่ล่าสุด');

        return view('new-arrival.index', compact('rs'));
    }

    public function getDetail($id)
    {
        $data['new_arrival'] = NewArrival::findOrFail($id);

        $data['sticker'] = Sticker::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->orderByRaw("FIELD(country,'th','jp','tw','id','hk') asc")->get();

        $data['theme'] = Theme::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        $data['emoji'] = Emoji::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        SEO::setTitle('สติ๊กเกอร์ไลน์, อิโมจิไลน์, ธีมไลน์มาใหม่ ' . DBToDate($data['new_arrival']->created_at));

        return view('new-arrival.detail', $data);
    }

    public function getDetail2($id)
    {
        $data['new_arrival'] = NewArrival::findOrFail($id);

        $data['sticker'] = Sticker::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->orderByRaw("FIELD(country,'th','jp','tw','id','hk') asc")->get();

        $data['theme'] = Theme::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        $data['emoji'] = Emoji::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        SEO::setTitle('สติ๊กเกอร์ไลน์, อิโมจิไลน์, ธีมไลน์มาใหม่ ' . DBToDate($data['new_arrival']->created_at));

        return view('new-arrival.detail2', $data);
    }
}
