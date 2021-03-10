<?php

use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// sitemap
Route::get('sitemap', function () {
    SitemapGenerator::create('https://line2me.in.th')
        ->setMaximumCrawlCount(500)
        ->writeToFile('sitemap.xml');

    return 'sitemap created';
});

Auth::routes();

Route::get('test-email', 'JobController@enqueue');

// home
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('xxx', 'HomeController@xxx');

// ajax
Route::get('ajax/updateviewcount', 'AjaxController@getUpdateviewcount');
Route::post('ajaxLinenotify', 'AjaxController@linenotify');
Route::get('ajaxChangeStatus', 'AjaxController@ajaxChangeStatus');

// aboutus
Route::get('aboutus', 'HomeController@aboutus');

// ดูไลน์ไอดี
Route::get('viewlineid', 'HomeController@viewlineid');
Route::get('viewlineqrcode', 'HomeController@viewlineqrcode');

// page
Route::get('page/view/{id}', 'PageController@getView');

// search
Route::get('search', 'HomeController@search');
Route::get('search/{param}', 'HomeController@search');

// Route::get('search2', 'HomeController@search2');

// new arrival
Route::get('new_arrival', 'NewArrivalController@getIndex');
Route::get('new_arrival/{param}', 'NewArrivalController@getDetail');
Route::get('new_arrival2/{param}', 'NewArrivalController@getDetail2');

// sticker
Route::get('sticker/{id}', 'StickerController@getProduct');
Route::get('sticker/official/{country}/{type}', 'StickerController@getOfficial');
Route::get('sticker/creator/{country}/{type}', 'StickerController@getCreator');

// theme
Route::get('theme/{id}', 'ThemeController@getProduct');
Route::get('theme/official/{country}/{type}', 'ThemeController@getOfficial');
Route::get('theme/creator/{type}', 'ThemeController@getCreator');

// emoji
Route::get('emoji/{id}', 'EmojiController@getProduct');
Route::get('emoji/official/{country}/{type}', 'EmojiController@getOfficial');
Route::get('emoji/creator/{type}', 'EmojiController@getCreator');

// series
Route::get('series', 'SeriesController@getIndex');
Route::get('series/{id}', 'SeriesController@getDetail');

//Crawler
Route::get('getsticker/{sticker_code}', 'CrawlerController@getsticker');
Route::get('gettheme/{theme_code}', 'CrawlerController@gettheme');
Route::get('getemoji/{emoji_code}', 'CrawlerController@getemoji');

Route::get('getstickerstore/{type}/{category}/{page}', 'CrawlerController@getstickerstore');
Route::get('getthemestore/{type}/{category}/{page}', 'CrawlerController@getthemestore');
Route::get('getemojistore/{type}/{category}/{page}', 'CrawlerController@getemojistore');

Route::get('getstickerstoresearch/{txtsearch}', 'CrawlerController@getstickerstoresearch');
Route::get('getthemestoresearch/{txtsearch}', 'CrawlerController@getthemestoresearch');
Route::get('getemojistoresearch/{txtsearch}', 'CrawlerController@getemojistoresearch');

// admin
Route::namespace ('Admin')->prefix('admin')->group(function () {

    Route::get('ajax/changestatus', 'AjaxController@changestatus')->name('changestatus');
    Route::get('ajax/changecountry', 'AjaxController@changecountry')->name('changecountry');
    Route::get('ajax/changecategory', 'AjaxController@changecategory')->name('changecategory');
    Route::get('home', 'HomeController@index')->name('home');

    Route::resource('page', 'PageController');
    Route::resource('sticker', 'StickerController');
    Route::resource('theme', 'ThemeController');
    Route::resource('emoji', 'EmojiController');
    Route::resource('promote', 'PromoteController');
    Route::resource('post', 'PostController');
    Route::resource('crawler', 'CrawlerController');
    Route::resource('series', 'SeriesController');

    //Crawler
    Route::get('getsticker/{sticker_code}', 'CrawlerController@getsticker');
    Route::get('gettheme/{theme_code}', 'CrawlerController@gettheme');
    Route::get('getemoji/{emoji_code}', 'CrawlerController@getemoji');

    Route::get('getstickerstore/{type}/{category}/{page}', 'CrawlerController@getstickerstore');
    Route::get('getthemestore/{type}/{category}/{page}', 'CrawlerController@getthemestore');
    Route::get('getemojistore/{type}/{category}/{page}', 'CrawlerController@getemojistore');

    Route::get('getstickerstoresearch/{txtsearch}', 'CrawlerController@getstickerstoresearch');
    Route::get('getthemestoresearch/{txtsearch}', 'CrawlerController@getthemestoresearch');
    Route::get('getemojistoresearch/{txtsearch}', 'CrawlerController@getemojistoresearch');

    // by author
    Route::get('get-sticker-by-author/{authorId}/{page}', 'CrawlerController@getStickerByAuthor');
    Route::get('get-theme-by-author/{authorId}/{page}', 'CrawlerController@getThemeByAuthor');

    // ปรับปรุงโค้ดใหม่ 2563
    Route::get('getstickerstore63/{type}/{category}/{page}', 'CrawlerController@getstickerstore63');

    // แบบจับทีละลิ้งค์
    Route::any('geteditorpick/{page}/{link_number}', 'CrawlerController@getEditorPick');
    // แบบจับทีละหน้า
    // Route::any('geteditorpick/{page}', 'CrawlerController@getEditorPick');
});

// cache flush
Route::get('cf', 'HomeController@cacheFlush');
