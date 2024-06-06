<?php

use Carbon\Carbon;

if (!function_exists('clean_url')) {
    function clean_url($text)
    {
        setlocale(LC_ALL, "Thai");
        $text                  = strtolower($text);
        $code_entities_match   = [' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '='];
        $code_entities_replace = ['-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
        $text                  = str_replace($code_entities_match, $code_entities_replace, $text);
        $text                  = @ereg_replace('(--)+', '', $text);
        $text                  = @ereg_replace('(-)$', '', $text);

        return $text;
    }
}

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($title)
    {
        //and here you put all your logic that solve the problem
        $temp = clean_url($title, '-');
        if (!App\Models\Page::all()->where('slug', $temp)->isEmpty()) {
            $i       = 1;
            $newslug = $temp . '-' . $i;
            while (!App\Models\Page::all()->where('slug', $newslug)->isEmpty()) {
                $i++;
                $newslug = $temp . '-' . $i;
            }
            $temp = $newslug;
        }

        return $temp;
    }
}

if (!function_exists('getUrlFromText')) {
    function getUrlFromText($text)
    {
        // $text = 'width: 122px; height: 140px; background-image:url(https://stickershop.line-scdn.net/stickershop/v1/sticker/2428/android/sticker.png;compress=true); background-size: 122px 140px;';
        preg_match('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $matches);
        // print_r($matches);

        return $matches[0];
    }
}

if (!function_exists('deleteDuplicate')) {
    function deleteDuplicate()
    {
        DB::unprepared('delete n1
        from
            stickers n1,
            stickers n2
        where
            n1.id > n2.id
            and n1.sticker_code = n2.sticker_code');
    }
}

if (!function_exists('convert_line_coin_2_money_full')) {
    function convert_line_coin_2_money_full($coin)
    {
        $bath = ['250' => '179', '200' => '138', '150' => '99', '100' => '69', '85' => '59', '50' => '35', '10' => '10', '2' => '2'];

        return @$bath[$coin];
    }
}

if (!function_exists('convert_line_coin_2_money')) {
    function convert_line_coin_2_money($coin)
    {
        $bath = ['250' => '170', '200' => '130', '150' => '95', '100' => '65', '85' => '55', '50' => '35', '10' => '6', '2' => '1'];

        return @$bath[$coin];
    }
}

if (!function_exists('th_2_coin')) {
    function th_2_coin($bath)
    {
        $coin = ['1' => '2', '6' => '10', '30' => '50', '60' => '100', '59' => '85', '90' => '150', '120' => '200', '150' => '250'];

        return $coin[$bath];
    }
}

if (!function_exists('money2country')) {
    function money2country($currency)
    {
        $country = ['￥' => 'jp', 'THB' => 'th', 'NT$' => 'tw', 'Rp' => 'id', '$' => 'us'];

        return $country[$currency];
    }
}

if (!function_exists('get_sticker_img_url')) {
    function get_sticker_img_url($stickerresourcetype, $version, $sticker_code)
    {
        if ($stickerresourcetype == 'ANIMATION' || $stickerresourcetype == 'ANIMATION_SOUND') {
            $imgUrl = 'https://stickershop.line-scdn.net/stickershop/v' . $version . '/product/' . $sticker_code . '/IOS/main_animation@2x.png';
        } elseif ($stickerresourcetype == 'POPUP' || $stickerresourcetype == 'POPUP_SOUND') {
            $imgUrl = 'https://sdl-stickershop.line.naver.jp/stickershop/v' . $version . '/product/' . $sticker_code . '/IOS/main_popup.png';
        } else {
            $imgUrl = 'https://sdl-stickershop.line.naver.jp/products/0/0/' . $version . '/' . $sticker_code . '/LINEStorePC/main.png';
        }

        return $imgUrl;
    }
}

if (!function_exists('new_icon')) {
    function new_icon($created_at)
    {
        $created_at = Carbon::parse($created_at);
        $isNew      = $created_at->diffInDays(Carbon::now()) < 3;

        if ($isNew) {
            $txt = ' new-product-card ';
        } else {
            $txt = '';
        }

        return $txt;
    }
}

if (!function_exists('new_badge')) {
    function new_badge($created)
    {
        $end      = Carbon::parse($created);
        $now      = Carbon::now();
        $length   = $end->diffInDays($now);
        $new_icon = $length < 7 ? '<span class="badge badge-danger">New</span>' : '';

        return $new_icon;
    }
}

if (!function_exists('getStickerResourctTypeIcon')) {
    function getStickerResourctTypeIcon($resourceType = false)
    {
        if ($resourceType == "ANIMATION") {
            return "<div class='iconProperty iconAnimation positionBottomRight icon-size-20'>สติกเกอร์ดุ๊กดิ๊ก</div>";
        } elseif ($resourceType == "SOUND") {
            return "<div class='iconProperty iconSound positionBottomRight icon-size-20'>สติกเกอร์มีเสียง</div>";
        } elseif ($resourceType == "ANIMATION_SOUND") {
            return "<div class='iconProperty iconAnimationSound positionBottomRight icon-size-20'>สติกเกอร์ดุ๊กดิ๊กและมีเสียง</div>";
        } elseif ($resourceType == "POPUP") {
            return "<div class='iconProperty iconPopup positionBottomRight icon-size-20'>สติกเกอร์ป๊อปอัพ</div>";
        } elseif ($resourceType == "POPUP_SOUND") {
            return "<div class='iconProperty iconPopupSound positionBottomRight icon-size-20'>สติกเกอร์ป๊อปอัพและมีเสียง</div>";
        } elseif ($resourceType == "NAME_TEXT") {
            return "<div class='iconProperty iconNameText positionBottomRight icon-size-20'>สติกเกอร์เติมคำ</div>";
        } elseif ($resourceType == "PER_STICKER_TEXT") {
            return "<div class='iconProperty iconNameText positionBottomRight icon-size-20'>สติกเกอร์ข้อความ</div>";
        } elseif ($resourceType == "STATIC") {
        }
    }
}

if (!function_exists('getStickerResourctTypeName')) {
    function getStickerResourctTypeName($resourceType = false)
    {
        if ($resourceType == "ANIMATION") {
            return "(สติกเกอร์ดุ๊กดิ๊ก)";
        } elseif ($resourceType == "SOUND") {
            return "(สติกเกอร์มีเสียง)";
        } elseif ($resourceType == "ANIMATION_SOUND") {
            return "(สติกเกอร์ดุ๊กดิ๊กและมีเสียง)";
        } elseif ($resourceType == "POPUP") {
            return "(สติกเกอร์ป๊อปอัพ)";
        } elseif ($resourceType == "POPUP_SOUND") {
            return "(สติกเกอร์ป๊อปอัพและมีเสียง)";
        } elseif ($resourceType == "NAME_TEXT") {
            return "(สติกเกอร์เติมคำ)";
        } elseif ($resourceType == "PER_STICKER_TEXT") {
            return "(สติกเกอร์ข้อความ)";
        } elseif ($resourceType == "STATIC") {
        }
    }
}

if (!function_exists('getCountry')) {
    function getCountry($txt)
    {
        if (strpos($txt, 'THB') !== false) {
            return 'th';
        } elseif (strpos($txt, '￥') !== false) {
            return 'jp';
        } elseif (strpos($txt, 'NT') !== false) {
            return 'tw';
        } elseif (strpos($txt, 'Rp') !== false) {
            return 'id';
        }
    }
}

if (!function_exists('notify_message')) {
    function notify_message($message)
    {
        define('LINE_API', "https://notify-api.line.me/api/notify");
        $token         = "j0me5N8gkvfeq26A9ga7dJhALfzUOtBB6cd5eS9tJeR";
        $message       = "Hello"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        $queryData     = ['message' => $message];
        $queryData     = http_build_query($queryData, '', '&');
        $headerOptions = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
                . "Authorization: Bearer " . $token . "\r\n"
                . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData,
            ],
        ];
        $context = stream_context_create($headerOptions);
        $result  = file_get_contents(LINE_API, false, $context);
        $res     = json_decode($result);

        return $res;
    }
}

if (!function_exists('getCountryTh')) {
    function getCountryTh($txt)
    {
        $countryArray = [
            'th'      => 'ไทย',
            'jp'      => 'ญี่ปุ่น',
            'tw'      => 'ไต้หวัน',
            'id'      => 'อินโดนีเซีย',
            'oversea' => 'ต่างประเทศ',
        ];

        return @$countryArray[$txt];
    }
}

if (!function_exists('getProductCodeFromStoreUrl')) {
    function getProductCodeFromStoreUrl($url)
    {
        // $url = 'https://store.line.me/stickershop/product/7664414/th';
        // $url = 'https://store.line.me/emojishop/product/5bc843d0031a6704f8cff721/th';
        // $url = 'https://store.line.me/themeshop/product/7183fd71-6b22-414c-9873-d29c8e8393ed/th';

        // ถ้า $url ที่ส่งเข้ามาเป็น url จริงๆ
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $arr = explode('/', $url);

            return $arr[5];
        } else {
            return $url;
        }
    }
}

if (!function_exists('getProductTypeFromStoreUrl')) {
    function getProductTypeFromStoreUrl($url)
    {
        // $url = 'https://store.line.me/stickershop/product/7664414/th';
        // $url = 'https://store.line.me/emojishop/product/5bc843d0031a6704f8cff721/th';
        // $url = 'https://store.line.me/themeshop/product/7183fd71-6b22-414c-9873-d29c8e8393ed/th';

        // ถ้า $url ที่ส่งเข้ามาเป็น url จริงๆ
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $arr = explode('/', $url);

            if ($arr[3] == 'stickershop') {
                return 'sticker';
            } elseif ($arr[3] == 'emojishop') {
                return 'emoji';
            } elseif ($arr[3] == 'themeshop') {
                return 'theme';
            }
        } else {
            return $url;
        }
    }
}

if (!function_exists('deleteDuplicateSeriesItem')) {
    function deleteDuplicateSeriesItem($series_id)
    {
        DB::unprepared('DELETE n1
            FROM
                series_items n1,
                series_items n2
            WHERE
                n1.id > n2.id
            AND n1.product_code = n2.product_code
            AND n1.series_id = ' . $series_id . '
            AND n2.series_id = ' . $series_id);
    }
}

if (!function_exists('countryName')) {
    function countryName($txt)
    {
        $countryArray = [
            'jp' => 'ญี่ปุ่น',
            'gb' => 'ทั่วไป',
            'kr' => 'เกาหลี',
            'es' => 'สเปน',
            'in' => 'อินเดีย',
            'tw' => 'ไต้หวัน',
            'us' => 'สหรัฐอเมริกา',
            'cn' => 'จีน',
            'th' => 'ไทย',
            'br' => 'บราซิล',
            'my' => 'มาเลเซีย',
            'ph' => 'ฟิลิปปินส์',
            'mx' => 'เม็กซิโก',
            'id' => 'อินโดนีเซีย',
            'hk' => 'ฮ่องกง',
        ];

        return @$countryArray[$txt];
    }
}

// if (!function_exists('countryFlag')) {
//     function countryFlag($txt)
//     {
//         $countryArray = array(
//             'jp' => '<img src="/image/countrys-flags/svg/japan.svg" width="24" alt="ญี่ปุ่น">',
//             'gb' => '',
//             'kr' => '<img src="/image/countrys-flags/svg/south-korea.svg" width="24" alt="เกาหลีใต้">',
//             'es' => '<img src="/image/countrys-flags/svg/spain.svg" width="24" alt="สเปน">',
//             'in' => '<img src="/image/countrys-flags/svg/india.svg" width="24" alt="อินเดีย">',
//             'tw' => '<img src="/image/countrys-flags/svg/taiwan.svg" width="24" alt="ไต้หวัน">',
//             'us' => '<img src="/image/countrys-flags/svg/united-states-of-america.svg" width="24" alt="สหรัฐอเมริกา">',
//             'cn' => '<img src="/image/countrys-flags/svg/china.svg" width="24" alt="จีน">',
//             'th' => '',
//             'br' => '<img src="/image/countrys-flags/svg/brazil.svg" width="24" alt="บราซิล">',
//             'my' => '<img src="/image/countrys-flags/svg/malaysia.svg" width="24" alt="มาเลเซีย">',
//             'ph' => '<img src="/image/countrys-flags/svg/philippines.svg" width="24" alt="ฟิลิปปินส์">',
//             'mx' => '<img src="/image/countrys-flags/svg/mexico.svg" width="24" alt="เม็กซิโก">',
//             'id' => '<img src="/image/countrys-flags/svg/indonesia.svg" width="24" alt="อินโดนีเซีย">',
//             'hk' => '<img src="/image/countrys-flags/svg/hong-kong.svg" width="24" alt="ฮ่องกง">',
//         );

//         return @$countryArray[$txt];
//     }
// }

if (!function_exists('countryFlag')) {
    function countryFlag($txt)
    {
        $countryArray = [
            'jp' => '<span class="flag flag-jp" alt="ญี่ปุ่น"></span>',
            'gb' => '',
            'kr' => '<span class="flag flag-kr" alt="เกาหลี"></span>',
            'es' => '<span class="flag flag-es" alt="สเปน"></span>',
            'in' => '<span class="flag flag-in" alt="อินเดีย"></span>',
            'tw' => '<span class="flag flag-tw" alt="ไต้หวัน"></span>',
            'us' => '<span class="flag flag-us" alt="สหรัฐอเมริกา"></span>',
            'cn' => '<span class="flag flag-cn" alt="จีน"></span>',
            'th' => '',
            'br' => '<span class="flag flag-br" alt="บราซิล"></span>',
            'my' => '<span class="flag flag-my" alt="มาเลเซีย"></span>',
            'ph' => '<span class="flag flag-ph" alt="ฟิลิปปินส์"></span>',
            'mx' => '<span class="flag flag-mx" alt="เม็กซิโก"></span>',
            'id' => '<span class="flag flag-id" alt="อินโดนีเซีย"></span>',
            'hk' => '<span class="flag flag-hk" alt="ฮ่องกง"></span>',
        ];

        return @$countryArray[$txt];
    }
}

if (!function_exists('viewCounter')) {
    function viewCounter()
    {
        $productType = Request::segment(1);
        $productID   = Request::segment(2);

        // Sticker
        if (Session::get('stickerArray')) {
            if (Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\StickerController@getProduct') {
                if (!in_array($productID, Session::get('stickerArray')) && $productType == 'sticker') {
                    Session::push('stickerArray', $productID);
                    DB::table('stickers')->where('sticker_code', $productID)->increment('threedays', 1);
                }
            }
        } else {
            Session::push('stickerArray', Session::getId());
        }

        // Theme
        if (Session::get('themeArray')) {
            if (Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\ThemeController@getProduct') {
                if (!in_array($productID, Session::get('themeArray')) && $productType == 'theme') {
                    Session::push('themeArray', $productID);
                    DB::table('themes')->where('id', $productID)->increment('threedays', 1);
                }
            }
        } else {
            Session::push('themeArray', Session::getId());
        }

        // Emoji
        if (Session::get('emojiArray')) {
            if (Route::getCurrentRoute()->getActionName() == 'App\Http\Controllers\EmojiController@getProduct') {
                if (!in_array($productID, Session::get('emojiArray')) && $productType == 'emoji') {
                    Session::push('emojiArray', $productID);
                    DB::table('emojis')->where('id', $productID)->increment('threedays', 1);
                }
            }
        } else {
            Session::push('emojiArray', Session::getId());
        }

        // dump(Session::get('stickerArray'));
        // dump(Session::get('themeArray'));
        // dump(Session::get('emojiArray'));
    }

    function generateThemeUrl($uuid, $section = false)
    {
        $section      = !empty($section) ? $section : 1;
        $baseUrl      = 'https://shop.line-scdn.net/themeshop/v1/products/';
        $formattedUrl = $baseUrl . substr($uuid, 0, 2) . '/' . substr($uuid, 2, 2) . '/' . substr($uuid, 4, 2) . '/' . $uuid . '/' . $section . '/WEBSTORE/icon_198x278.png';

        return $formattedUrl;
    }

    function generateThemeUrlDetail($uuid, $imgOrder, $section = false)
    {
        $section      = !empty($section) ? $section : 1;
        $baseUrl      = 'https://shop.line-scdn.net/themeshop/v1/products/';
        $formattedUrl = $baseUrl . substr($uuid, 0, 2) . '/' . substr($uuid, 2, 2) . '/' . substr($uuid, 4, 2) . '/' . $uuid . '/' . $section . '/ANDROID/th/preview_00' . $imgOrder . '_720x1232.png';

        return $formattedUrl;
    }
}
