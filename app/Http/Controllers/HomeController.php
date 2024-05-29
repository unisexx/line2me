<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\NewArrival;
use App\Models\Promote;
use App\Models\Series;
use App\Models\Sticker;
use App\Models\Theme;
use Cache;
use Carbon;
use DB;
use SEO;
use SEOMeta;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // DB::enableQueryLog();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SEO::setTitle('ขายสติ๊กเกอร์ไลน์ของแท้ราคาถูก ส่งไว ติดต่อไอดีไลน์ ratasak1234');
        SEO::setDescription('ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ที่เปิดให้บริการมากว่า 8 ปี');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://linesticker.in.th/image/qr_ratasak1234.png');
        SEO::twitter()->setSite('@line2me_th');
        // SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        // SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        $cache_time = now()->addMinutes(60);

        // สติ๊กเกอร์ไลน์โปรโมท
        // $data['sticker_promote'] = Promote::where('product_type', '=', 'sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->inRandomOrder()->get();
        // $data['theme_promote'] = Promote::where('product_type', '=', 'theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->inRandomOrder()->get();
        // $data['emoji_promote'] = Promote::where('product_type', '=', 'emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->inRandomOrder()->get();

        $data['sticker_promote'] = Cache::remember('home_sticker_promote', config('calculations.cache_time'), function () {
            return Promote::where('product_type', '=', 'sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->orderBy('id', 'desc')->get();
        });
        $data['theme_promote'] = Cache::remember('home_theme_promote', config('calculations.cache_time'), function () {
            return Promote::where('product_type', '=', 'theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->orderBy('id', 'desc')->get();
        });
        $data['emoji_promote'] = Cache::remember('home_emoji_promote', config('calculations.cache_time'), function () {
            return Promote::where('product_type', '=', 'emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->orderBy('id', 'desc')->get();
        });

        // $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();
        // $new_arrival = Cache::remember('home_new_arrival', config('calculations.cache_time'), function () {
        //     return NewArrival::orderBy('id', 'desc')->first();
        // });
        // $data['new_arrival_note'] = $new_arrival->note;

        // สตื๊กเกอร์ไลน์อัพเดท
        // $data['sticker_update'] = Sticker::where('category', 'official')
        //     ->where('status', 1)
        //     ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
        //     ->orderByRaw("FIELD(country,'th','jp','tw','id','hk') asc")->get();
        $data['sticker_update'] = Cache::remember('home_sticker_update', config('calculations.cache_time'), function () {
            return Sticker::where('category', 'official')
                ->where('status', 1)
                ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->orderBy('created_at', 'desc')->get();
            // ->orderByRaw("FIELD(country,'th','id','jp','tw','hk') asc")->get();
        });

        // ธีมไลน์อัพเดท
        // $data['theme_update'] = Theme::where('category', 'official')
        //     ->where('status', 1)
        //     ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
        //     ->get();
        $data['theme_update'] = Cache::remember('home_theme_update', config('calculations.cache_time'), function () {
            return Theme::where('category', 'official')
                ->where('status', 1)
                ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->get();
        });

        // อิโมจิอัพเดท
        // $data['emoji_update'] = Emoji::where('category', 'official')
        //     ->where('status', 1)
        //     ->whereBetween('created_at', [$data['new_arrival']->start_date, $data['new_arrival']->end_date])
        //     ->get();
        $data['emoji_update'] = Cache::remember('home_emoji_update', config('calculations.cache_time'), function () {
            return Emoji::where('category', 'official')
                ->where('status', 1)
                ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->get();
        });

        // editorpick
        // $data['series'] = Series::where('status', 1)->take(3)->inRandomOrder()->get();
        $data['series'] = Cache::remember('home_series', config('calculations.cache_time'), function () {
            return Series::where('status', 1)->where('hilight', 1)->take(9)->inRandomOrder()->get();
        });

        // สติ๊กเกอร์ไลน์ทางการ (ไทย)
        // $data['sticker_official_thai'] = Sticker::where('status', 1)
        //     ->where('category', 'official')
        //     ->where(function ($q) {
        //         $q->where('country', 'gb')->orWhere('country', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['sticker_official_thai'] = Cache::remember('home_sticker_official_thai', config('calculations.cache_time'), function () {
            return Sticker::where('status', 1)
                ->where('category', 'official')
                ->where(function ($q) {
                    $q->where('country', 'gb')->orWhere('country', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // สติ๊กเกอร์ไลน์ทางการ (ต่างประเทศ)
        // $data['sticker_official_oversea'] = Sticker::where('status', 1)
        //     ->where('category', 'official')
        //     ->where(function ($q) {
        //         $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['sticker_official_oversea'] = Cache::remember('home_sticker_official_oversea', config('calculations.cache_time'), function () {
            return Sticker::where('status', 1)
                ->where('category', 'official')
                ->where(function ($q) {
                    $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // สติ๊กเกอร์ไลน์ครีเอเตอร์
        // $data['sticker_creator'] = Sticker::where('category', 'creator')
        //     ->where('status', 1)
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['sticker_creator'] = Cache::remember('home_sticker_creator', config('calculations.cache_time'), function () {
            return Sticker::where('category', 'creator')
                ->where('status', 1)
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // ธีมไลน์ทางการ (ไทย)
        // $data['theme_official_thai'] = Theme::where('category', 'official')
        //     ->where('status', 1)
        //     ->where(function ($q) {
        //         $q->where('country', 'gb')->orWhere('country', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['theme_official_thai'] = Cache::remember('home_theme_official_thai', config('calculations.cache_time'), function () {
            return Theme::where('category', 'official')
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where('country', 'gb')->orWhere('country', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // ธีมไลน์ทางการ (ต่างประเทศ)
        // $data['theme_official_oversea'] = Theme::where('category', 'official')
        //     ->where('status', 1)
        //     ->where(function ($q) {
        //         $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['theme_official_oversea'] = Cache::remember('home_theme_official_oversea', config('calculations.cache_time'), function () {
            return Theme::where('category', 'official')
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // ธีมไลน์ครีเอเตอร์
        // $data['theme_creator'] = Theme::where('category', 'creator')
        //     ->where('status', 1)
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['theme_creator'] = Cache::remember('home_theme_creator', config('calculations.cache_time'), function () {
            return Theme::where('category', 'creator')
                ->where('status', 1)
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // อิโมจิทางการ (ไทย)
        // $data['emoji_official_thai'] = Emoji::where('category', 'official')
        //     ->where('status', 1)
        //     ->where(function ($q) {
        //         $q->where('country', 'gb')->orWhere('country', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['emoji_official_thai'] = Cache::remember('home_emoji_official_thai', config('calculations.cache_time'), function () {
            return Emoji::where('category', 'official')
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where('country', 'gb')->orWhere('country', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // อิโมจิทางการ (ต่างประเทศ)
        // $data['emoji_official_oversea'] = Emoji::where('category', 'official')
        //     ->where('status', 1)
        //     ->where(function ($q) {
        //         $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
        //     })
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['emoji_official_oversea'] = Cache::remember('home_emoji_official_oversea', config('calculations.cache_time'), function () {
            return Emoji::where('category', 'official')
                ->where('status', 1)
                ->where(function ($q) {
                    $q->where('country', '!=', 'gb')->where('country', '!=', 'th');
                })
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        // อิโมจิครีเอเตอร์
        // $data['emoji_creator'] = Emoji::where('category', 'creator')
        //     ->where('status', 1)
        //     ->orderBy('threedays', 'desc')
        //     ->take(12)
        //     ->get();
        $data['emoji_creator'] = Cache::remember('home_emoji_creator', config('calculations.cache_time'), function () {
            return Emoji::where('category', 'creator')
                ->where('status', 1)
                ->orderBy('threedays', 'desc')
                ->take(12)
                ->get();
        });

        return view('home', $data);
    }

    public function search($type = false)
    {
        if ($type) {

            $data['type'] = $type;

            $data['search'] = DB::table($type . 's');

            if (!empty($_GET['country'])) {
                $data['search'] = $data['search']->where('country', $_GET['country']);
            }

            if (!empty($_GET['category'])) {
                $data['search'] = $data['search']->where('category', $_GET['category']);
            }

            if (!empty($_GET['q'])) {
                $data['search'] = $data['search']
                    ->where('status', 1)
                    ->where(function ($q) use ($type) {
                        if ($type == 'sticker') {
                            $q->where('title_th', 'like', '%' . $_GET['q'] . '%')
                                ->orWhere('title_en', 'like', '%' . $_GET['q'] . '%');
                        } else {
                            $q->where('title', 'like', '%' . $_GET['q'] . '%');
                        }
                    });
            }

            $data['search'] = $data['search']->orderBy('id', 'desc')->simplePaginate(30);

            SEO::setTitle(@$type . ' ' . @$_GET['q']);
            SEO::setDescription('สติกเกอร์ ธีม อีโมจิไลน์ ' . @$_GET['q'] . ' ติดต่อไอดีไลน์ ratasak1234');

            return view('home.search_type', $data);
        } else {

            // ค้นหา sticker
            $data['sticker'] = new Sticker;

            if (!empty($_GET['country'])) {
                $data['sticker'] = $data['sticker']->where('country', $_GET['country']);
            }

            if (!empty($_GET['category'])) {
                $data['sticker'] = $data['sticker']->where('category', $_GET['category']);
            }

            if (!empty($_GET['q'])) {
                $data['sticker'] = $data['sticker']
                    ->where('status', 1)
                    ->where(function ($q) {
                        $q->where('title_th', 'like', '%' . $_GET['q'] . '%')
                            ->orWhere('title_en', 'like', '%' . $_GET['q'] . '%');
                    });
            }

            $data['sticker'] = $data['sticker']->orderBy('id', 'desc')->take(12)->get();

            // ค้นหา theme
            $data['theme'] = new Theme;

            if (!empty($_GET['country'])) {
                $data['theme'] = $data['theme']->where('country', $_GET['country']);
            }

            if (!empty($_GET['category'])) {
                $data['theme'] = $data['theme']->where('category', $_GET['category']);
            }

            if (!empty($_GET['q'])) {
                $data['theme'] = $data['theme']
                    ->where('status', 1)
                    ->where('title', 'like', '%' . $_GET['q'] . '%');
            }

            $data['theme'] = $data['theme']->orderBy('id', 'desc')->take(12)->get();

            // ค้นหา emoji
            $data['emoji'] = new Emoji;
            if (!empty($_GET['country'])) {
                $data['emoji'] = $data['emoji']->where('country', $_GET['country']);
            }

            if (!empty($_GET['category'])) {
                $data['emoji'] = $data['emoji']->where('category', $_GET['category']);
            }

            if (!empty($_GET['q'])) {
                $data['emoji'] = $data['emoji']
                    ->where('status', 1)
                    ->where('title', 'like', '%' . $_GET['q'] . '%');
            }

            $data['emoji'] = $data['emoji']->orderBy('id', 'desc')->take(12)->get();

            SEO::setTitle('ค้นหาสติกเกอร์ ธีม อีโมจิไลน์ ' . @$_GET['q']);
            SEO::setDescription('สติกเกอร์ ธีม อีโมจิไลน์ ' . @$_GET['q'] . ' ติดต่อไอดีไลน์ ratasak1234');

            return view('home.search', $data);
        }
    }

    // public function author($user_id)
    // {
    //     $data['sticker'] = new Sticker;
    //     $data['sticker'] = $data['sticker']->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

    //     $data['theme'] = new Theme;
    //     $data['theme'] = $data['theme']->where('user_id', $user_id)->orderBy('updated_at', 'desc')->get();

    //     return view('home.author', $data);
    // }

    // public function tag($tag)
    // {
    //     $data['tag'] = $tag;
    //     $data['stamp'] = new Stamp;
    //     if (!empty($tag)) {
    //         $data['stamp'] = $data['stamp']->where('tag', 'like', '%' . $tag . '%');
    //     }
    //     $data['stamp'] = $data['stamp']->orderBy('updated_at', 'desc')->get();

    //     return view('home.tag', $data);
    // }

    public function new_arrival($id = false)
    {
        SEO::setTitle('สติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ อัพเดทล่าสุดประจำสัปดาห์');
        SEO::setDescription('ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดี ratasak1234');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://linesticker.in.th/image/qr_ratasak1234.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อัพเดท, เติมคำ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อัพเดท, เติมคำ');

        if ($id) {
            $data['new_arrival'] = NewArrival::findOrFail($id);
        } else {
            $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();
        }

        $data['sticker'] = Sticker::where('category', 'official')
            ->where('status', 1)
            ->whereBetween('created_at', [$data['new_arrival']
                    ->start_date, $data['new_arrival']->end_date])
                ->get();

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

        return view('home.new_arrival', $data);
    }

    public function aboutus()
    {
        SEO::setTitle('เกี่ยวกับเรา');
        SEO::setDescription('ข้อมูลเกี่ยวกับเว็บไซต์ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ line2me.in.th ติดต่อไอดี ratasak1234');
        // SEO::opengraph()->setUrl(url()->current());
        // SEO::addImages('https://i.imgur.com/M1FvcTu.png');
        // SEO::twitter()->setSite('@line2me_th');
        // SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
        // SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');

        return view('aboutus');
    }

    public function viewlineid()
    {
        SEO::setTitle('วิธีดูไอดีไลน์');
        SEO::setDescription('วิธีดูไอดีไลน์ของตัวเอง ง่ายๆ สามารถทำได้ด้วยตัวเอง');

        return view('viewlineid');
    }

    public function viewlineqrcode()
    {
        SEO::setTitle('วิธีทำคิวอาร์โค้ดไลน์');
        SEO::setDescription('วิธีทำคิวอาร์โค้ดไลน์ของตัวเอง ง่ายๆ สามารถทำได้ด้วยตัวเอง');

        return view('viewlineqrcode');
    }

    // public function info(){
    //     echo phpinfo();
    // }

    // public function xxx()
    // {
    //     Emoji::where('status', 'approve')->chunk(100, function ($emojis) {
    //         foreach ($emojis as $emoji) {
    //             $emoji->update(['status' => 1]);
    //         }
    //     });
    // }

    // product code redirect 2 url
    public function code2url($product_code)
    {
        $data = explode('-', $product_code);

        if (strtolower($data[0]) == 's') {
            $url = 'https://line.me/S/sticker/' . $data[1];
        } elseif (strtolower($data[0]) == 't') {
            $rs  = DB::table('themes')->find($data[1]);
            $url = 'https://line.me/S/shop/theme/detail?id=' . $rs->theme_code;
        } elseif (strtolower($data[0]) == 'e') {
            $rs  = DB::table('emojis')->find($data[1]);
            $url = 'https://line.me/S/emoji/?id=' . $rs->emoji_code;
        }

        return redirect(@$url);
    }

    public function cacheFlush()
    {
        Cache::flush();
        echo "<script>";
        echo "window.top.close();";
        echo "</script>";
    }

    public function cacheFlush2()
    {
        Cache::flush();

        return redirect('home');
    }

    public function googleSearchResult()
    {
        return view('home.google-search-result');
    }

    public function testnotify()
    {
        $receipt = [];
        array_push($receipt, 'GJVCpZq2yFINxVW9uxzlAKd5A6zBkzJUUQhd2Aw6hAg'); // เดียร์

        foreach ($receipt as $tokens) {
            $LINE_API = "https://notify-api.line.me/api/notify";
            //$queryData = array('message' => $message, 'stickerPackageId' => '789', 'stickerId' => '10855');
            $queryData     = ['message' => '(ทดสอบระบบ ส่ง Line Notify)'];
            $queryData     = http_build_query($queryData, '', '&');
            $headerOptions = [
                'http' => [
                    'method'  => 'POST',
                    'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $tokens . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                    'content' => $queryData,
                ],
            ];
            $context = stream_context_create($headerOptions);
            $result  = file_get_contents($LINE_API, false, $context);
            $res     = json_decode($result);
        }
    }

    public function home2()
    {
        return view('home2.index');
    }
}
