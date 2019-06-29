<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Theme;

use DB;
use SEO;
use SEOMeta;
use OpenGraph;
use	Cache;
use Carbon;

class ThemeController extends Controller {
    public function getIndex() {
		
	}
	
	public function getOfficial($country,$type)
	{
		// SEO
		SEO::setTitle('ธีมไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ยอดนิยม');
		SEO::setDescription('รวมธีมไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
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
		return view('theme.official', $data);
	}

	public function getCreator($type)
	{
		// SEO
		SEO::setTitle('ธีมไลน์ครีเอเตอร์ยอดนิยม');
		SEO::setDescription('รวมธีมไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['theme'] = new Theme;
		$data['theme'] = $data['theme']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('theme.creator', $data);
	}
	
	public function getProduct($id){

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

		// cache file
		// $data['rs'] = Cache::rememberForever('theme_'.$id, function() use ($id) {
		// 	return DB::table('themes')->find($id);
		// });
		
		$data['rs'] = Theme::find($id);

		// SEO
		SEO::setTitle('ธีมไลน์ '.$data['rs']->title);
		SEO::setDescription('ธีมไลน์ '.$data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://shop.line-scdn.net/themeshop/v1/products/li/st/kr/'.$data['rs']->theme_code.'/1/WEBSTORE/icon_198x278.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords(str_replace(" ",", ",$data['rs']->title).', line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		// SEOMeta::addKeyword('line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '198');
		OpenGraph::addProperty('image:height', '278');
		
    	return view('theme.product',$data);
	}
}
