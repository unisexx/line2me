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
        ]);
    }

    public function themeMore($category = null, $country = null, $type = null)
    {
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
        ]);
    }

    public function emojiMore($category = null, $country = null, $type = null)
    {
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
        ]);
    }

    public function stickerDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('sticker', $id);

        $data['rs'] = Cache::rememberForever('stickers_' . $id, function () use ($id) {
            return Sticker::where('sticker_code', $id)->first();
        });
        return view('frontend.sticker.detail', $data);
    }

    public function themeDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('theme', $id);

        $data['rs'] = Cache::rememberForever('theme_' . $id, function () use ($id) {
            return Theme::find($id);
        });
        return view('frontend.theme.detail', $data);
    }

    public function emojiDetail($id = null)
    {
        // บันทึกการเข้าชม
        $this->recordProductView('emoji', $id);

        $data['rs'] = Cache::rememberForever('emoji_' . $id, function () use ($id) {
            return Emoji::where('emoji_code', $id)->first();
        });
        return view('frontend.emoji.detail', $data);
    }

    public function search(Request $request)
    {
        $query   = $request->input('query');
        $perPage = 30; // กำหนดจำนวนรายการต่อหน้า

        // ใช้ Full-Text Search พร้อมกับการแบ่งหน้า
        $results = Sticker::whereRaw("MATCH(title_th, detail) AGAINST(? IN BOOLEAN MODE)", [$query])
            ->paginate($perPage);

        // ส่งผลลัพธ์การค้นหาไปยัง view พร้อมกับข้อมูลการแบ่งหน้า
        return view('frontend.search_results', compact('results'));
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

    public function seriesDetail($id)
    {
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

        return view('frontend.series.detail', @compact('rs', 'series_items', 'more_series'));
    }

}
