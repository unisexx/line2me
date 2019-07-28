<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;

use DB;
use SEO;
use SEOMeta;
use Session;
use OpenGraph;
use Cache;
use Redis;
use Carbon;


class StickerController extends Controller
{
	public function getIndex()
	{

	}

	public function getOfficial($country,$type)
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		// ประเภท : top, new
		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['sticker'] = new Sticker;
		$data['sticker'] = $data['sticker']
							->where('status','approve')
							->where('category','official')
							->where(function($q) use ($country){

								// ประเทศ : thai, oversea
								if($country == 'thai'){
									$q->where('country','global')->orWhere('country','thai');
								}elseif($country == 'oversea'){
									$q->where('country','!=','global')->where('country','!=','thai');
								}
								
							})
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);

		return view('sticker.official', $data);
	}

	public function getCreator($type)
	{
		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ครีเอเตอร์ยอดนิยม');
		SEO::setDescription('รวมสติ๊กเกอร์ไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['sticker'] = new Sticker;
		$data['sticker'] = $data['sticker']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('sticker.creator', $data);
	}

	public function getProduct($id = null)
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
			
		// ใช้ Cache File
		// $data['rs'] = Cache::rememberForever('stickers_'.$id, function() use ($id) {
		// 	return DB::table('stickers')->where('sticker_code',$id)->first();
		// });
		// $data['rs'] = Cache::remember('stickers_'.$id, 60, function() use ($id) {
		// 	return DB::table('stickers')->where('sticker_code',$id)->first();
		// });

		// ใช้ Redis Cache
		// $redis = Redis::get('laravel:stickers_'.$id);
		// if ($redis) {
		// 	$data['rs'] = unserialize($redis);
		// }else{
		// 	$data['rs'] = DB::table('stickers')->where('sticker_code',$id)->first();
		// 	Cache::store('redis')->put('stickers_'.$id, $data['rs'], 10);
		// }

		$data['rs'] = Sticker::where('sticker_code',$id)->first();

		if(empty($data['rs'])){
			return abort(404);
		}

		// SEO
		SEO::setTitle('สติ๊กเกอร์ไลน์ '.$data['rs']->title_th);
		SEO::setDescription('สติ๊กเกอร์ไลน์' . $data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('http://sdl-stickershop.line.naver.jp/products/0/0/' . $data['rs']->version . '/' . $data['rs']->sticker_code . '/LINEStorePC/main.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords(str_replace(" ",", ",$data['rs']->title_th).', line, sticker, theme, emoji, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, อิโมจิ, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ', 'เติมคำ');
		// SEOMeta::addKeyword(str_replace(" ",", ",$data['rs']->title_th));
		OpenGraph::addProperty('image:width', '240');
		OpenGraph::addProperty('image:height', '240');

		return view('sticker.product', $data);
	}
}
