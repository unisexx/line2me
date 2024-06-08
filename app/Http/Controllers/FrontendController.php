<?php

namespace App\Http\Controllers;

use App\Models\Emoji;
use App\Models\Page;
use App\Models\Series;
use App\Models\SeriesItem;
use App\Models\Sticker;
use App\Models\Theme;
use Cache;
use Carbon\Carbon;
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

    public function stickerMore($category = null, $country = null, $order = null)
    {
        $ogTags = config('opengraph.default');

        // ตรวจสอบกรณีที่มีเฉพาะ $order แต่ไม่มี $category และ $country
        if (in_array($category, ['new', 'top'])) {
            $order    = $category;
            $category = null;
            $country  = null;
        }

        $rs = Sticker::where('status', 1)
            ->when($category, function ($query) use ($category) {
                if ($category == 'official') {
                    $query->where('category', 'official');
                } elseif ($category == 'creator') {
                    $query->where('category', 'creator');
                } elseif ($category == 'all') {
                    $query->whereIn('category', ['official', 'creator']);
                }
            })
            ->when($country, function ($query) use ($country) {
                if ($country == 'oversea') {
                    $query->where('country', '!=', 'th');
                } elseif ($country != null) {
                    $query->where('country', $country);
                }
            })
            ->when($order, function ($query) use ($order) {
                if ($order == 'top') {
                    $query->orderBy('views_last_3_days', 'desc');
                } elseif ($order == 'new') {
                    $query->orderBy('id', 'desc');
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->simplePaginate(30);

        return view('frontend.sticker.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'order'    => $order,
            'ogTags'   => $ogTags,
        ]);
    }

    public function themeMore($category = null, $country = null, $order = null)
    {
        $ogTags = config('opengraph.default');

        // ตรวจสอบกรณีที่มีเฉพาะ $order แต่ไม่มี $category และ $country
        if (in_array($category, ['new', 'top'])) {
            $order    = $category;
            $category = null;
            $country  = null;
        }

        $rs = Theme::where('status', 1)
            ->when($category, function ($query) use ($category) {
                if ($category == 'official') {
                    $query->where('category', 'official');
                } elseif ($category == 'creator') {
                    $query->where('category', 'creator');
                } elseif ($category == 'all') {
                    $query->whereIn('category', ['official', 'creator']);
                }
            })
            ->when($country, function ($query) use ($country) {
                if ($country == 'oversea') {
                    $query->where('country', '!=', 'th');
                } elseif ($country != null) {
                    $query->where('country', $country);
                }
            })
            ->when($order, function ($query) use ($order) {
                if ($order == 'top') {
                    $query->orderBy('views_last_3_days', 'desc');
                } elseif ($order == 'new') {
                    $query->orderBy('id', 'desc');
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->simplePaginate(30);

        return view('frontend.theme.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'order'    => $order,
            'ogTags'   => $ogTags,
        ]);
    }

    public function emojiMore($category = null, $country = null, $order = null)
    {
        $ogTags = config('opengraph.default');

        // ตรวจสอบกรณีที่มีเฉพาะ $order แต่ไม่มี $category และ $country
        if (in_array($category, ['new', 'top'])) {
            $order    = $category;
            $category = null;
            $country  = null;
        }

        $rs = Emoji::where('status', 1)
            ->when($category, function ($query) use ($category) {
                if ($category == 'official') {
                    $query->where('category', 'official');
                } elseif ($category == 'creator') {
                    $query->where('category', 'creator');
                } elseif ($category == 'all') {
                    $query->whereIn('category', ['official', 'creator']);
                }
            })
            ->when($country, function ($query) use ($country) {
                if ($country == 'oversea') {
                    $query->where('country', '!=', 'th');
                } elseif ($country != null) {
                    $query->where('country', $country);
                }
            })
            ->when($order, function ($query) use ($order) {
                if ($order == 'top') {
                    $query->orderBy('views_last_3_days', 'desc');
                } elseif ($order == 'new') {
                    $query->orderBy('id', 'desc');
                }
            }, function ($query) {
                $query->orderBy('id', 'desc');
            })
            ->simplePaginate(30);

        return view('frontend.emoji.more', [
            'rs'       => $rs,
            'category' => $category,
            'country'  => $country,
            'order'    => $order,
            'ogTags'   => $ogTags,
        ]);
    }

    public function stickerDetail($id = null)
    {
        $data['rs'] = Cache::rememberForever('stickers_' . $id, function () use ($id) {
            return Sticker::where('sticker_code', $id)->first();
        });

        // บันทึก log การเข้าชม
        if (!empty($data['rs']->sticker_code)) {
            $this->recordProductView('sticker', $data['rs']->sticker_code);
        }

        $data['ogTags'] = [
            'og:title'       => 'สติกเกอร์ไลน์ ' . $data['rs']->title_th . ' | line2me.in.th',
            'og:description' => 'สติกเกอร์ไลน์' . $data['rs']->detail,
            'og:image'       => 'http://sdl-stickershop.line.naver.jp/products/0/0/' . $data['rs']->version . '/' . $data['rs']->sticker_code . '/LINEStorePC/main.png',
        ];

        return view('frontend.sticker.detail', $data);
    }

    public function themeDetail($id = null)
    {
        $data['rs'] = Cache::rememberForever('theme_' . $id, function () use ($id) {
            return Theme::find($id);
        });

        // บันทึก log การเข้าชม
        if (!empty($data['rs']->theme_code)) {
            $this->recordProductView('theme', $data['rs']->theme_code);
        }

        $data['ogTags'] = [
            'og:title'       => 'ธีมไลน์ ' . $data['rs']->title . ' | line2me.in.th',
            'og:description' => 'ธีมไลน์ ' . $data['rs']->detail,
            'og:image'       => generateThemeUrl($data['rs']->theme_code, @$data['rs']->section),
        ];

        return view('frontend.theme.detail', $data);
    }

    public function emojiDetail($id = null)
    {
        $data['rs'] = Cache::rememberForever('emoji_' . $id, function () use ($id) {
            return Emoji::where('emoji_code', $id)->first();
        });

        // บันทึก log การเข้าชม
        if (!empty($data['rs']->emoji_code)) {
            $this->recordProductView('emoji', $data['rs']->emoji_code);
        }

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
        return view('frontend.search.search_results', compact('rs_sticker', 'rs_theme', 'rs_emoji', 'ogTags'));
    }

    public function recordProductView($type, $productCode)
    {
        $ipAddress = request()->ip();
        $today     = Carbon::today();

        // ตรวจสอบว่ามี record ที่ตรงกับเงื่อนไขหรือไม่
        $viewExists = DB::table('product_views')
            ->where('product_code', $productCode)
            ->where('type', $type)
            ->where('ip_address', $ipAddress)
            ->whereDate('view_date', $today)
            ->exists();

        // ถ้าไม่มี ให้สร้าง record ใหม่
        if (!$viewExists) {
            DB::table('product_views')->insert([
                'product_code' => $productCode,
                'type'         => $type,
                'ip_address'   => $ipAddress,
                'view_date'    => $today,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            $threeDaysAgo = Carbon::now()->subDays(3);
            $viewsCount   = DB::table('product_views')->where('type', $type)->where('product_code', $productCode)
                ->where('view_date', '>=', $threeDaysAgo)
                ->count();

            // อัพเดทยอดวิวตาราง sticker
            if ($type == 'sticker') {
                Sticker::where('sticker_code', $productCode)->update(['views_last_3_days' => $viewsCount]);
            }

            // อัพเดทยอดวิวตาราง theme
            if ($type == 'theme') {
                Theme::where('theme_code', $productCode)->update(['views_last_3_days' => $viewsCount]);
            }

            // อัพเดทยอดวิวตาราง emoji
            if ($type == 'emoji') {
                Emoji::where('emoji_code', $productCode)->update(['views_last_3_days' => $viewsCount]);
            }

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
        $rs = Cache::remember('series_' . $id, config('calculations.cache_time'), function () use ($id) {
            return Series::findOrFail($id);
        });
        $series_items = Cache::remember('series_items_' . $id . '_' . @$_GET['page'], config('calculations.cache_time'), function () use ($id) {
            return SeriesItem::where('series_id', $id)
                ->with(['sticker' => function ($q) {
                    $q->orderBy('views_last_3_days', 'desc');
                }])
                ->with(['theme' => function ($q) {
                    $q->orderBy('views_last_3_days', 'desc');
                }])
                ->with(['emoji' => function ($q) {
                    $q->orderBy('views_last_3_days', 'desc');
                }])->orderBy('order', 'asc')->simplePaginate(120);
        });

        $ogTags = [
            'og:title'       => 'รวมสติกเกอร์ไลน์ชุด ' . $rs->title . ' | line2me.in.th',
            'og:description' => 'รวมสติกเกอร์ไลน์ชุด' . $rs->title,
            'og:image'       => $rs->image,
        ];

        return view('frontend.series.detail', @compact('rs', 'series_items', 'more_series', 'ogTags'));
    }

    public function getPageView($id)
    {
        // $data['rs'] = Page::find($id);
        return view('frontend.page.view');
    }

    public function getThemeSection()
    {
        return view('frontend.test.getThemeSection');
    }

}
