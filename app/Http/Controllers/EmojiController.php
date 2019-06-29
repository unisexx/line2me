<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Emoji;

use DB;
use SEO;
use SEOMeta;
use Session;
use OpenGraph;
use Cache;
use Carbon;


class EmojiController extends Controller
{
	public function getIndex()
	{

	}

	public function getOfficial($country,$type)
	{
		// SEO
		SEO::setTitle('อีโมจิไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ยอดนิยม');
		SEO::setDescription('รวมอิโมจิไลน์ทางการ'.($country == 'thai' ? 'ไทย' : 'ต่างประเทศ').'ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['emoji'] = new Emoji;
		$data['emoji'] = $data['emoji']
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
		return view('emoji.official', $data);
	}

	public function getCreator($type)
	{
		// SEO
		SEO::setTitle('อิโมจิครีเอเตอร์ยอดนิยม');
		SEO::setDescription('รวมอิโมจิไลน์ไลน์ครีเอเตอร์ขายดี แนะนำ ฮิตๆ ยอดนิยม');

		if($type == 'top'){
			$orderByField = 'threedays';
		}elseif($type == 'new'){
			$orderByField = 'id';
		}

		$data['emoji'] = new Emoji;
		$data['emoji'] = $data['emoji']
							->where('category','creator')
							->where('status','approve')
							->orderBy($orderByField, 'desc')
							->simplePaginate(30);
		return view('emoji.creator', $data);
	}

	public function getProduct($id)
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

		// cache file
		// $data['rs'] = Cache::rememberForever('emoji_'.$id, function() use ($id) {
		// 	return DB::table('emojis')->find($id);
		// });

		$data['rs'] = Emoji::find($id);

		// SEO
		SEO::setTitle('อิโมจิไลน์ '.$data['rs']->title);
		SEO::setDescription('อิโมจิไลน์' . $data['rs']->detail);
		SEO::opengraph()->setUrl(url()->current());
		SEO::addImages('https://stickershop.line-scdn.net/sticonshop/v1/product/'.$data['rs']->emoji_code.'/iphone/main.png');
		SEO::twitter()->setSite('@line2me_th');
		SEOMeta::setKeywords(str_replace(" ",", ",$data['rs']->title).', line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		// SEOMeta::addKeyword('line, emoji, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ');
		OpenGraph::addProperty('image:width', '240');
		OpenGraph::addProperty('image:height', '240');

		return view('emoji.product', $data);
	}
}
