<?php

namespace App\Providers;

use App\Models\Promote;
use App\Models\Series;
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
        Schema::defaultStringLength(191);

        View::share('sticker_promote',
            Cache::remember('sticker_promote', config('calculations.cache_time'), function () {
                return Promote::where('product_type', '=', 'sticker')->where('end_date', '>=', Carbon::now()->toDateString())->with('sticker')->orderBy('id', 'desc')->get();
            })
        );

        View::share('theme_promote',
            Cache::remember('theme_promote', config('calculations.cache_time'), function () {
                return Promote::where('product_type', '=', 'theme')->where('end_date', '>=', Carbon::now()->toDateString())->with('theme')->orderBy('id', 'desc')->get();
            })
        );

        View::share('emoji_promote',
            Cache::remember('emoji_promote', config('calculations.cache_time'), function () {
                return Promote::where('product_type', '=', 'emoji')->where('end_date', '>=', Carbon::now()->toDateString())->with('emoji')->orderBy('id', 'desc')->get();
            })
        );

        View::share('serie_promote',
            Cache::remember('editor_pick', now()->addMinutes(3), function () {
                return Series::where('status', 1)->take(6)->inRandomOrder()->get();
            })
        );

    }
}
