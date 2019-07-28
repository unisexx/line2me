<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\Sticker;
use App\Models\Theme;
use App\Models\Emoji;
use App\Models\NewArrival;

use DB;
use SEO;
use SEOMeta;
use Carbon;

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


        $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();
        // สตื๊กเกอร์ไลน์อัพเดท
        $data['sticker_update'] = Sticker::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

        // ธีมไลน์อัพเดท
        $data['theme_update'] = Theme::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

        // อิโมจิอัพเดท
        $data['emoji_update'] = Emoji::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

        // สติ๊กเกอร์ไลน์ทางการ (ไทย)
        $data['sticker_official_thai'] = new Sticker;
        $data['sticker_official_thai'] = $data['sticker_official_thai']
                            ->where('status','approve')
                            ->where('category','official')
                            ->where(function($q){
                                $q->where('country','global')->orWhere('country','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // สติ๊กเกอร์ไลน์ทางการ (ต่างประเทศ)
        $data['sticker_official_oversea'] = new Sticker;
        $data['sticker_official_oversea'] = $data['sticker_official_oversea']
                            ->where('status','approve')
                            ->where('category','official')
                            ->where(function($q){
                                $q->where('country','!=','global')->where('country','!=','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // สติ๊กเกอร์ไลน์ครีเอเตอร์
        $data['sticker_creator'] = new Sticker;
        $data['sticker_creator'] = $data['sticker_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();


        // ธีมไลน์ทางการ (ไทย)
        $data['theme_official_thai'] = new Theme;
        $data['theme_official_thai'] = $data['theme_official_thai']
                            ->where('category','official')
                            ->where('status','approve')
                            ->where(function($q){
                                $q->where('country','global')->orWhere('country','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // ธีมไลน์ทางการ (ต่างประเทศ)
        $data['theme_official_oversea'] = new Theme;
        $data['theme_official_oversea'] = $data['theme_official_oversea']
                            ->where('category','official')
                            ->where('status','approve')
                            ->where(function($q){
                                $q->where('country','!=','global')->where('country','!=','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // ธีมไลน์ครีเอเตอร์
        $data['theme_creator'] = new Theme;
        $data['theme_creator'] = $data['theme_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // อิโมจิทางการ (ไทย)
        $data['emoji_official_thai'] = new Emoji;
        $data['emoji_official_thai'] = $data['emoji_official_thai']
                            ->where('category','official')
                            ->where('status','approve')
                            ->where(function($q){
                                $q->where('country','global')->orWhere('country','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // อิโมจิทางการ (ต่างประเทศ)
        $data['emoji_official_oversea'] = new Emoji;
        $data['emoji_official_oversea'] = $data['emoji_official_oversea']
                            ->where('category','official')
                            ->where('status','approve')
                            ->where(function($q){
                                $q->where('country','!=','global')->where('country','!=','thai');
                            })
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        // อิโมจิครีเอเตอร์
        $data['emoji_creator'] = new Emoji;
        $data['emoji_creator'] = $data['emoji_creator']
                            ->where('category','creator')
                            ->where('status','approve')
                            ->orderBy('threedays', 'desc')
                            ->take(12)
                            ->get();

        return view('home',$data);
    }

    public function search($type = false)
    {
        if($type){

            $data['type'] = $type;

            if (!empty($_GET['q'])) {
                $data['search'] = DB::table($type.'s')
                                    ->where('status','approve')
                                    ->where(function($q) use ($type){
                                        if($type == 'sticker'){
                                            $q->where('title_th', 'like', '%'.$_GET['q'].'%')
                                            ->orWhere('title_en', 'like', '%'.$_GET['q'].'%');
                                        }else{
                                            $q->where('title', 'like', '%'.$_GET['q'].'%');
                                        }
                                    })
                                    ->orderBy('id', 'desc')
                                    ->simplePaginate(30);
            }

            SEO::setTitle(@$type.' '.@$_GET['q']);
            SEO::setDescription('สติกเกอร์ ธีม อีโมจิไลน์ '.@$_GET['q'].' ติดต่อไอดีไลน์ ratasak1234');
            
            return view('home.search_type', $data);

        }else{

            // ค้นหา sticker
            $data['sticker'] = new Sticker;
            if (!empty($_GET['q'])) {
                $data['sticker'] = $data['sticker']
                                    ->where('status','approve')
                                    ->where(function($q){
                                        $q->where('title_th', 'like', '%'.$_GET['q'].'%')
                                        ->orWhere('title_en', 'like', '%'.$_GET['q'].'%');
                                    });
            }
            $data['sticker'] = $data['sticker']->orderBy('id', 'desc')->take(12)->get();

            // ค้นหา theme
            $data['theme'] = new Theme;
            if (!empty($_GET['q'])) {
                $data['theme'] = $data['theme']
                                ->where('status','approve')
                                ->where('title', 'like', '%'.$_GET['q'].'%');
            }
            $data['theme'] = $data['theme']->orderBy('id', 'desc')->take(12)->get();

            // ค้นหา emoji
            $data['emoji'] = new Emoji;
            if (!empty($_GET['q'])) {
                $data['emoji'] = $data['emoji']
                                ->where('status','approve')
                                ->where('title', 'like', '%'.$_GET['q'].'%');
            }
            $data['emoji'] = $data['emoji']->orderBy('id', 'desc')->take(12)->get();

            SEO::setTitle('ค้นหาสติกเกอร์ ธีม อีโมจิไลน์ '.@$_GET['q']);
            SEO::setDescription('สติกเกอร์ ธีม อีโมจิไลน์ '.@$_GET['q'].' ติดต่อไอดีไลน์ ratasak1234');

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

    public function new_arrival($id=false){
        SEO::setTitle('สติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ อัพเดทล่าสุดประจำสัปดาห์');
        SEO::setDescription('ขายสติ๊กเกอร์ไลน์ ธีมไลน์ อิโมจิไลน์ ของแท้ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดี ratasak1234');
        SEO::opengraph()->setUrl(url()->current());
        SEO::addImages('https://linesticker.in.th/image/qr_ratasak1234.png');
        SEO::twitter()->setSite('@line2me_th');
        SEOMeta::setKeywords('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อัพเดท, เติมคำ');
        SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, อัพเดท, เติมคำ');
        
        $data['new_arrival'] = NewArrival::orderBy('id', 'desc')->first();

        $data['sticker'] = Sticker::where('category','official')
                            ->where('status','approve')
                            ->whereBetween('created_at', [$data['new_arrival']
                            ->start_date, $data['new_arrival']->end_date])
                            ->get();

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

        return view('home.new_arrival',$data);
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

    // public function info(){
    //     echo phpinfo();
    // }
}
