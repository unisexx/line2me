<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "line2me.in.th", // set false to total remove
            'description'  => 'อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆกว่า 2,250,000 ลาย ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak1234', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => ['line, sticker, theme, creator, animation, sound, popup, ไลน์, สติ๊กเกอร์, ธีม, ครีเอเทอร์, ดุ๊กดิ๊ก, มีเสียง, ป๊อปอัพ, โปรโมทสติ๊กเกอร์ไลน์, โปรโมท line, สติ๊กเกอร์ไลน์, สติ๊กเกอร์ไลน์ น่ารัก, ขายสติ๊กเกอร์ไลน์ของแท้, สติ๊กเกอร์ไลน์, ธีมไลน์, อิโมจิไลน์, ขายธีมไลน์ของแท้, ขายอิโมจิไลน์ของแท้, สติ๊กเกอร์ไลน์ชื่อ, สติ๊กเกอร์ไลน์ราคาถูก, สติ๊กเกอร์ไลน์ลดราคา, sticker line, theme line, emoji line, promote line'],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'line2me.in.th', // set false to total remove
            'description' => 'อัพเดทสติ๊กเกอร์ไลน์ใหม่ๆกว่า 2,250,000 ลาย ของแท้ ถูกลิขสิทธิ์ ไม่มีหาย เชื่อถือได้ 100% ติดต่อไอดีไลน์ ratasak1234', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          'card'        => 'summary',
          'site'        => '@line2me_th',
        ],
    ],
];
