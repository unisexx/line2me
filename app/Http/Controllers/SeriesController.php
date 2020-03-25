<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Series;
use OpenGraph;
use SEO;
use SEOMeta;

class SeriesController extends Controller
{
    public function getIndex(){
        $rs = Series::select('*');
		if (!empty($keyword)) {
			$rs = $rs->where('title', 'LIKE', "%$keyword%");
		}
		$rs = $rs->orderBy('id','desc')->simplePaginate(30);
        return view('series.index', compact('rs'));
    }

    public function getDetail(){

    }
}
