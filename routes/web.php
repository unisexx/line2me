<?php

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

Auth::routes();

// home
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

// ajax
Route::get('ajax/updateviewcount', 'AjaxController@getUpdateviewcount');

// aboutus
Route::get('aboutus', 'HomeController@aboutus');

// page
Route::get('page/view/{id}', 'PageController@getView');

// search
Route::get('search', 'HomeController@search');
Route::get('search/{param}', 'HomeController@search');

// new arrival
Route::get('new_arrival', 'HomeController@new_arrival');
Route::get('new_arrival/{param}', 'HomeController@new_arrival');

// sticker
Route::get('sticker/{id}', 'StickerController@getProduct');
Route::get('sticker/official/{country}/{type}', 'StickerController@getOfficial');
Route::get('sticker/creator/{type}', 'StickerController@getCreator');

// theme
Route::get('theme/{id}', 'ThemeController@getProduct');
Route::get('theme/official/{country}/{type}', 'ThemeController@getOfficial');
Route::get('theme/creator/{type}', 'ThemeController@getCreator');

// emoji
Route::get('emoji/{id}', 'EmojiController@getProduct');
Route::get('emoji/official/{country}/{type}', 'EmojiController@getOfficial');
Route::get('emoji/creator/{type}', 'EmojiController@getCreator');


// admin
Route::namespace('Admin')->prefix('admin')->group(function () {

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
});
