<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\Theme;
use App\Models\Emoji;
use App\Models\NewArrival;

use DB;
use Carbon;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // สติ๊กเกอร์ไลน์โปรโมท
        $data['sticker_promote'] = DB::table('promotes')
            ->join('stickers', 'promotes.product_code', '=', 'stickers.sticker_code')
            ->select('stickers.*')
            ->where('promotes.product_type','=','sticker')
            ->where('promotes.end_date', '>=', Carbon::now()->toDateString())
            ->inRandomOrder()
            ->take(30)
            ->get();

        // ธีมไลน์โปรโมท
        $data['theme_promote'] = DB::table('promotes')
            ->join('themes', 'promotes.product_code', '=', 'themes.id')
            ->select('themes.*')
            ->where('promotes.product_type','=','theme')
            ->where('promotes.end_date', '>=', Carbon::now()->toDateString())
            ->inRandomOrder()
            ->take(30)
            ->get();

        // อิโมจิไลน์โปรโมท
        $data['emoji_promote'] = DB::table('promotes')
            ->join('emojis', 'promotes.product_code', '=', 'emojis.emoji_code')
            ->select('emojis.*')
            ->where('promotes.product_type','=','emoji')
            ->where('promotes.end_date', '>=', Carbon::now()->toDateString())
            ->inRandomOrder()
            ->take(30)
            ->get();

        // new arrival
        $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();

        $data['sticker'] = Sticker::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->orderByRaw("FIELD(country,'thai','japan','taiwan','indonesia') asc")->get();

        $data['theme'] = Theme::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

        $data['emoji'] = Emoji::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

        return view('admin.post.index', $data);
    }

}
