<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Goutte\Client;
use Illuminate\Http\Request;

class ScraperController extends Controller
{
    public function themeScrape($uuid)
    {
        $client  = new Client();
        $url     = 'https://store.line.me/themeshop/product/' . $uuid . '/th';
        $crawler = $client->request('GET', $url);

        try {
            // ดึง path รูปจากแอตทริบิวต์ src ของแท็ก <img>
            $imagePath = $crawler->filter('.mdCMN38Img img')->attr('src');

            // ใช้ Regular Expression ในการดึงเฉพาะเลข 234
            preg_match('/\/(\d+)\/WEBSTORE\/icon_198x278\.png$/', $imagePath, $matches);
            $imageNumber = $matches[1] ?? null;

            if ($imageNumber) {
                // ค้นหาและอัปเดต record ในฐานข้อมูล
                $theme = Theme::where('theme_code', $uuid)->first();
                if ($theme) {
                    $theme->section = $imageNumber;
                    $theme->ok      = 1;
                    $theme->save();
                }
            }

            return response()->json([
                'status'      => $theme ? 'success' : 'not_found',
                'imageNumber' => $imageNumber,
            ]);
        } catch (\InvalidArgumentException $e) {
            // ถ้าไม่พบโหนด, อัปเดตฟิลด์ ok เป็น 1
            $theme = Theme::where('theme_code', $uuid)->first();
            if ($theme) {
                $theme->ok = 1;
                $theme->save();
            }

            return response()->json([
                'status'      => $theme ? 'updated_ok' : 'not_found',
                'imageNumber' => null,
            ]);
        }
    }

    public function updateAllThemes()
    {
        $client     = new Client();
        $results    = [];
        $count      = 0;
        $maxUpdates = 30; // กำหนดจำนวนสูงสุดของการอัพเดท

        // ดึง 10 เรคคอร์ดแรกที่มีค่า ok เป็น null
        $themes = Theme::whereNull('ok')->where('category', 'official')->take($maxUpdates)->get();

        foreach ($themes as $theme) {
            $uuid    = $theme->theme_code;
            $url     = 'https://store.line.me/themeshop/product/' . $uuid . '/th';
            $crawler = $client->request('GET', $url);

            try {
                // ดึง path รูปจากแอตทริบิวต์ src ของแท็ก <img>
                $imagePath = $crawler->filter('.mdCMN38Img img')->attr('src');

                // ใช้ Regular Expression ในการดึงเฉพาะเลข 234
                preg_match('/\/(\d+)\/WEBSTORE\/icon_198x278\.png$/', $imagePath, $matches);
                $imageNumber = $matches[1] ?? null;

                if ($imageNumber) {
                    // อัปเดตฟิลด์ section ด้วยเลขที่ดึงมาได้
                    $theme->section = $imageNumber;
                    $theme->ok      = 1;
                }
            } catch (\InvalidArgumentException $e) {
                // ถ้าไม่พบโหนด, อัปเดตฟิลด์ ok เป็น 1
                $theme->ok = 1;
            }

            // บันทึกการเปลี่ยนแปลงในฐานข้อมูล
            $theme->save();

            // เก็บผลลัพธ์ของแต่ละการอัปเดต
            $results[] = [
                'uuid'        => $uuid,
                'status'      => isset($imageNumber) ? 'success' : 'updated_ok',
                'imageNumber' => $imageNumber ?? null,
            ];

            // เพิ่มตัวนับ
            $count++;
            if ($count >= $maxUpdates) {
                break; // หยุดการประมวลผลเมื่อถึงจำนวนที่กำหนด
            }
        }

        return response()->json($results);
    }
}
