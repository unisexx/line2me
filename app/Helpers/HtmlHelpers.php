<?php
if (!function_exists('clean_url')) {
    function clean_url($text)
    {
        setlocale(LC_ALL, "Thai");
        $text = strtolower($text);
        $code_entities_match = array(' ', '--', '&quot;', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '{', '}', '|', ':', '"', '<', '>', '?', '[', ']', '\\', ';', "'", ',', '.', '/', '*', '+', '~', '`', '=');
        $code_entities_replace = array('-', '-', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
        $text = str_replace($code_entities_match, $code_entities_replace, $text);
        $text = @ereg_replace('(--)+', '', $text);
        $text = @ereg_replace('(-)$', '', $text);
        return $text;
    }
}

if (!function_exists('generateUniqueSlug')) {
    function generateUniqueSlug($title)
    {
        //and here you put all your logic that solve the problem
        $temp = clean_url($title, '-');
        if (!App\Models\Page::all()->where('slug', $temp)->isEmpty()) {
            $i = 1;
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

if (!function_exists('convert_line_coin_2_money')) {
    function convert_line_coin_2_money($coin)
    {
        $bath = array('250' => '150', '200' => '120', '150' => '90', '100' => '60', '50' => '30', '2' => '1');
        return @$bath[$coin];
    }
}

if (!function_exists('th_2_coin')) {
    function th_2_coin($bath)
    {
        $coin = array('1' => '2', '30' => '50', '60' => '100', '90' => '150', '120' => '200', '150' => '250');
        return $coin[$bath];
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
    function new_icon($created)
    {
        $end = Carbon::parse($created);
        $now = Carbon::now();
        $length = $end->diffInDays($now);
        $new_icon = $length < 7 ? '<div class="new-product">New</div>' : '';
        return $new_icon;
    }
}

if (!function_exists('getStickerResourctTypeIcon')) {
    function getStickerResourctTypeIcon($resourceType = false)
    {
        if ($resourceType == "ANIMATION") {
            return "<div class='iconProperty iconAnimation positionBottomRight icon-size-20'>ดุ๊กดิ๊ก</div>";
        } elseif ($resourceType == "SOUND") {
            return "<div class='iconProperty iconSound positionBottomRight icon-size-20'>มีเสียง</div>";
        } elseif ($resourceType == "ANIMATION_SOUND") {
            return "<div class='iconProperty iconAnimationSound positionBottomRight icon-size-20'>ดุ๊กดิ๊กและมีเสียง</div>";
        } elseif ($resourceType == "POPUP") {
            return "<div class='iconProperty iconPopup positionBottomRight icon-size-20'>ป๊อปอัพ</div>";
        } elseif ($resourceType == "POPUP_SOUND") {
            return "<div class='iconProperty iconPopupSound positionBottomRight icon-size-20'>ป๊อปอัพและมีเสียง</div>";
        } elseif ($resourceType == "NAME_TEXT") {
            return "<div class='iconProperty iconNameText positionBottomRight icon-size-20'>เติมคำ</div>";
        } elseif ($resourceType == "STATIC") {
        }
    }
}

if (!function_exists('getStickerResourctTypeName')) {
    function getStickerResourctTypeName($resourceType = false)
    {
        if ($resourceType == "ANIMATION") {
            return "(ดุ๊กดิ๊ก)";
        } elseif ($resourceType == "SOUND") {
            return "(มีเสียง)";
        } elseif ($resourceType == "ANIMATION_SOUND") {
            return "(ดุ๊กดิ๊กและมีเสียง)";
        } elseif ($resourceType == "POPUP") {
            return "(ป๊อปอัพ)";
        } elseif ($resourceType == "POPUP_SOUND") {
            return "(ป๊อปอัพและมีเสียง)";
        } elseif ($resourceType == "NAME_TEXT") {
            return "(เติมคำ)";
        } elseif ($resourceType == "STATIC") {
        }
    }
}

if (!function_exists('getCountry')) {
    function getCountry($txt)
    {
        if (strpos($txt, 'THB') !== false) {
            return 'thai';
        } elseif (strpos($txt, '￥') !== false) {
            return 'japan';
        } elseif (strpos($txt, 'NT') !== false) {
            return 'taiwan';
        } elseif (strpos($txt, 'Rp') !== false) {
            return 'indonesia';
        }
    }
}

if (!function_exists('notify_message')) {
    function notify_message($message,$token)
    {
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData,'','&');
        $headerOptions = array( 
                'http'=>array(
                'method'=>'POST',
                'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                        ."Authorization: Bearer ".$token."\r\n"
                        ."Content-Length: ".strlen($queryData)."\r\n",
                'content' => $queryData
                ),
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents(LINE_API,FALSE,$context);
        $res = json_decode($result);
        return $res;
    }
}
