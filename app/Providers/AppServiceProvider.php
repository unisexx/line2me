<?php

namespace App\Providers;

use App\Http\View\Composers\SidebarComposer;
use App\Models\Promote;
use App\Models\Series;
use App\Models\Sticker;
use Cache;
use Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ระยะเวลาที่จะเก็บ cache (ในนาที)
        $cacheTime = config('calculations.cache_time');

        // ใช้ Cache::remember เพื่อดึงและเก็บข้อมูลใน cache
        $stickerPromote = Cache::remember('sticker_promote', $cacheTime, function () {
            // ดึงข้อมูล product_code โดยมีเงื่อนไขและเรียงลำดับ
            $productCodeArray = Promote::where('product_type', 'sticker')
                ->where('end_date', '>=', Carbon::now()->toDateString())
                ->orderBy('id', 'desc')
                ->pluck('product_code')
                ->toArray();

            // ดึงข้อมูล sticker โดยใช้ product_code ที่ได้มา
            return Sticker::whereIn('sticker_code', $productCodeArray)->get();
        });

        // แชร์ข้อมูล sticker_promote ไปยังทุกๆ View
        View::share('sticker_promote', $stickerPromote);

        // series
        // View::share('serie_promote',
        //     Cache::remember('editor_pick', now()->addMinutes(3), function () {
        //         return Series::where('status', 1)->take(6)->inRandomOrder()->get();
        //     })
        // );
        View::share('serie_promote', Series::where('status', 1)->take(6)->inRandomOrder()->get());

        // Schema::defaultStringLength(191);

        // View::share('sticker_promote',
        //     // Cache::remember('sticker_promote', config('calculations.cache_time'), function () {
        //     //     return Promote::with('sticker')->where('product_type', '=', 'sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->orderBy('id', 'desc')->get();
        //     // })

        //     return Promote::with('sticker')
        //     ->where('product_type', '=', 'sticker')
        //     ->where('end_date', '>=', Carbon::now()->toDateString())
        //     ->orderBy('id', 'desc')->get();
        // );

        // View::share('sticker_promote', Cache::remember('sticker_promote', config('calculations.cache_time'), function () {
        //     return Promote::with('sticker')
        //         ->where('product_type', '=', 'sticker')
        //         ->where('end_date', '>=', Carbon::now()->toDateString())
        //         ->orderBy('id', 'desc')
        //         ->get();
        // }));

        // View::share('theme_promote',
        //     Cache::remember('theme_promote', config('calculations.cache_time'), function () {
        //         return Promote::where('product_type', '=', 'theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->orderBy('id', 'desc')->get();
        //     })
        // );

        // View::share('emoji_promote',
        //     Cache::remember('emoji_promote', config('calculations.cache_time'), function () {
        //         return Promote::where('product_type', '=', 'emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->orderBy('id', 'desc')->get();
        //     })
        // );
    }
}
