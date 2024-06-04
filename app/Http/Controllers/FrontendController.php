<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\Series;
use App\Models\SeriesItem;
use App\Models\Sticker;
use App\Models\Theme;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function home()
    {
        $data['ogTags'] = config('opengraph.default');

        $data['sticker_update'] = Cache::remember('home_sticker_update', config('calculations.cache_time'), function () {
            return Sticker::where('category', 'official')
                ->where('status', 1)
                ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->orderBy('id', 'desc')->get();
        });

        $data['theme_update'] = Cache::remember('home_theme_update', config('calculations.cache_time'), function () {
            return Theme::where('category', 'official')
                ->where('status', 1)
            // ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->orderBy('id', 'desc')
                ->take(6)->get();
        });

        $data['emoji_update'] = Cache::remember('home_emoji_update', config('calculations.cache_time'), function () {
            return Emoji::where('category', 'official')
                ->where('status', 1)
            // ->where('created_at', '>', now()->subDays(7)->endOfDay())
                ->orderBy('id', 'desc')
                ->take(6)->get();
        });

        $data['series'] = Cache::remember('home_series', config('calculations.cache_time'), function () {
            return Series::where('status', 1)->where('hilight', 1)->take(9)->inRandomOrder()->get();
        });

        return view('frontend.home', $data);
    }

    public function stickerMore($category = null, $country = null, $type = null)
    {
        $ogTags = config('opengraph.default');

        $rs = Sticker::where('status', 1)
            ->when($category == 'official', function ($query) {
                $query->where('category', 'official');
            })
            ->when($category == 'creator', function ($query) {
                $query->where('category', 'creator');
            })
            ->when($country == 'othercountry', function ($query) {
                $query->whereNotIn('country', ['gb', 'th', 'jp', 'tw', 'id']);
            })
            ->when($country == 'oversea', function ($query) {
                $query->whereNotIn('country', ['gb', 'th']);
            })
            ->when($country == 'th', function ($query) {
                $query->whereIn('country', ['gb', 'th']);
            })
            ->when($country == 'jp', function ($query) {
                $query->where('country', 'jp');
            })
            ->when($country == 'tw', function ($query) {
                $query->where('country', 'tw');
            })
            ->when($country == 'id', function ($query) {
                $query->where('country', 'id');
            })
            ->orderBy('id', 'desc')
            ->simplePaginate(30);

        return view('frontend.sticker.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'type'     => $type,
            'ogTags'   => $ogTags,
        ]);
    }

    public function themeMore($category = null, $country = null, $type = null)
    {
        $ogTags = config('opengraph.default');

        $rs = Theme::where('status', 1)
            ->when($category == 'official', function ($query) {
                $query->where('category', 'official');
            })
            ->when($category == 'creator', function ($query) {
                $query->where('category', 'creator');
            })
            ->when($country == 'othercountry', function ($query) {
                $query->whereNotIn('country', ['gb', 'th', 'jp', 'tw', 'id']);
            })
            ->when($country == 'oversea', function ($query) {
                $query->whereNotIn('country', ['gb', 'th']);
            })
            ->when($country == 'th', function ($query) {
                $query->whereIn('country', ['gb', 'th']);
            })
            ->when($country == 'jp', function ($query) {
                $query->where('country', 'jp');
            })
            ->when($country == 'tw', function ($query) {
                $query->where('country', 'tw');
            })
            ->when($country == 'id', function ($query) {
                $query->where('country', 'id');
            })
            ->orderBy('id', 'desc')
            ->simplePaginate(30);

        return view('frontend.theme.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'type'     => $type,
            'ogTags'   => $ogTags,
        ]);
    }

    public function emojiMore($category = null, $country = null, $type = null)
    {
        $ogTags = config('opengraph.default');

        $rs = Emoji::where('status', 1)
            ->when($category == 'official', function ($query) {
                $query->where('category', 'official');
            })
            ->when($category == 'creator', function ($query) {
                $query->where('category', 'creator');
            })
            ->when($country == 'othercountry', function ($query) {
                $query->whereNotIn('country', ['gb', 'th', 'jp', 'tw', 'id']);
            })
            ->when($country == 'oversea', function ($query) {
                $query->whereNotIn('country', ['gb', 'th']);
            })
            ->when($country == 'th', function ($query) {
                $query->whereIn('country', ['gb', 'th']);
            })
            ->when($country == 'jp', function ($query) {
                $query->where('country', 'jp');
            })
            ->when($country == 'tw', function ($query) {
                $query->where('country', 'tw');
            })
            ->when($country == 'id', function ($query) {
                $query->where('country', 'id');
            })
            ->orderBy('id', 'desc')
            ->simplePaginate(30);

        return view('frontend.emoji.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'type'     => $type,
            'ogTags'   => $ogTags,
        ]);
    }

    public function stickerDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('sticker', $id);

        $data['rs'] = Cache::rememberForever('stickers_' . $id, function () use ($id) {
            return Sticker::where('sticker_code', $id)->first();
        });

        $data['ogTags'] = [
            'og:title'       => 'สติกเกอร์ไลน์ ' . $data['rs']->title_th . ' | line2me.in.th',
            'og:description' => 'สติกเกอร์ไลน์' . $data['rs']->detail,
            'og:image'       => 'http://sdl-stickershop.line.naver.jp/products/0/0/' . $data['rs']->version . '/' . $data['rs']->sticker_code . '/LINEStorePC/main.png',
        ];

        return view('frontend.sticker.detail', $data);
    }

    public function themeDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('theme', $id);

        $data['rs'] = Cache::rememberForever('theme_' . $id, function () use ($id) {
            return Theme::find($id);
        });

        $data['ogTags'] = [
            'og:title'       => 'ธีมไลน์ ' . $data['rs']->title . ' | line2me.in.th',
            'og:description' => 'ธีมไลน์ ' . $data['rs']->detail,
            'og:image'       => generateThemeUrl($data['rs']->theme_code, @$data['rs']->section),
        ];

        return view('frontend.theme.detail', $data);
    }

    public function emojiDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('emoji', $id);

        $data['rs'] = Cache::rememberForever('emoji_' . $id, function () use ($id) {
            return Emoji::where('emoji_code', $id)->first();
        });

        $data['ogTags'] = [
            'og:title'       => 'อิโมจิไลน์ ' . $data['rs']->title . ' | line2me.in.th',
            'og:description' => 'อิโมจิไลน์' . $data['rs']->detail,
            'og:image'       => 'https://stickershop.line-scdn.net/sticonshop/v1/product/' . $data['rs']->emoji_code . '/iphone/main.png',
        ];

        return view('frontend.emoji.detail', $data);
    }

    public function search(Request $request)
    {
        $ogTags = config('opengraph.default');

        $query   = $request->input('query');
        $perPage = 30; // กำหนดจำนวนรายการต่อหน้า

        // ใช้ Full-Text Search พร้อมกับการแบ่งหน้า
        $rs_sticker = Sticker::whereRaw("MATCH(title_th, detail) AGAINST(? IN BOOLEAN MODE)", [$query])->take(12)->get();
        $rs_theme   = Theme::whereRaw("MATCH(title, detail) AGAINST(? IN BOOLEAN MODE)", [$query])->take(12)->get();
        $rs_emoji   = Emoji::whereRaw("MATCH(title, detail) AGAINST(? IN BOOLEAN MODE)", [$query])->take(12)->get();

        // ส่งผลลัพธ์การค้นหาไปยัง view พร้อมกับข้อมูลการแบ่งหน้า
        return view('frontend.search_results', compact('rs_sticker','rs_theme','rs_emoji', 'ogTags'));
    }

    public function recordProductView($type, $productCode)
    {
        $today = date('Y-m-d');

        $existingView = DB::table('product_views')
            ->where('product_code', $productCode)
            ->where('view_date', $today)
            ->first();

        if ($existingView) {
            DB::table('product_views')
                ->where('id', $existingView->id)
                ->increment('view_count');
        } else {
            DB::table('product_views')->insert([
                'product_code' => $productCode,
                'type'         => $type,
                'view_date'    => $today,
                'view_count'   => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }

    public function seriesMore()
    {
        $ogTags = config('opengraph.default');

        $page = !empty(request('page')) ? request('page') : 1;
        $rs   = Cache::remember('series_index_page_' . @$page, config('calculations.cache_time'), function () {
            return Series::select('*')->where('status', 1)->orderBY('hilight', 'desc')->orderBy('updated_at', 'desc')->simplePaginate(30);
        });

        return view('frontend.series.more', compact('rs', 'ogTags'));
    }

    public function seriesDetail($id)
    {
        $ogTags = config('opengraph.default');

        $rs = Cache::remember('series_' . $id, config('calculations.cache_time'), function () use ($id) {
            return Series::findOrFail($id);
        });
        $series_items = Cache::remember('series_items_' . $id . '_' . @$_GET['page'], config('calculations.cache_time'), function () use ($id) {
            return SeriesItem::where('series_id', $id)
                ->with(['sticker' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])
                ->with(['theme' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])
                ->with(['emoji' => function ($q) {
                    $q->orderBy('threedays', 'desc');
                }])->orderBy('order', 'asc')->simplePaginate(120);
        });

        return view('frontend.series.detail', @compact('rs', 'series_items', 'more_series', 'ogTags'));
    }

}
