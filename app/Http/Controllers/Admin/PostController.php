<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\Theme;
use App\Models\Emoji;
use App\Models\NewArrival;
use App\Models\Promote;

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
        $data['sticker_promote'] = Promote::where('product_type','=','sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->inRandomOrder()->get();
        $data['theme_promote'] = Promote::where('product_type','=','theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->inRandomOrder()->get();
        $data['emoji_promote'] = Promote::where('product_type','=','emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->inRandomOrder()->get();

        // new arrival
        $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();

        $data['sticker'] = Sticker::where('category','official')
                            ->where('status', 1)
                            ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
                            ->orderByRaw("FIELD(country,'th','jp','tw','id') asc")->get();

        $data['theme'] = Theme::where('category','official')
                            ->where('status', 1)
                            ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
                            ->get();

        $data['emoji'] = Emoji::where('category','official')
                            ->where('status', 1)
                            ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
                            ->get();

        return view('admin.post.index', $data);
    }

}
