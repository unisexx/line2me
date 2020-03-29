<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NewArrival;
use App\Models\Emoji;
use App\Models\Sticker;
use App\Models\Theme;
use OpenGraph;
use SEO;
use SEOMeta;

class NewArrivalController extends Controller
{
    public function getIndex(){
        $rs = NewArrival::select('*');
		if (!empty($keyword)) {
			$rs = $rs->where('title', 'LIKE', "%$keyword%");
		}
		$rs = $rs->orderBy('id','desc')->simplePaginate(30);
        return view('new-arrival.index', compact('rs'));
    }

    public function getDetail($id){
        $data['new_arrival'] = NewArrival::findOrFail($id);

        $data['sticker'] = Sticker::where('category', 'official')
            ->where('status', 'approve')
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        $data['theme'] = Theme::where('category', 'official')
            ->where('status', 'approve')
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        $data['emoji'] = Emoji::where('category', 'official')
            ->where('status', 'approve')
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

        return view('new-arrival.detail', $data);
    }
}