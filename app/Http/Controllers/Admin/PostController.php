<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emoji;
use App\Models\NewArrival;
use App\Models\Promote;
use App\Models\Sticker;
use App\Models\Theme;
use Carbon;
use DB;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
                                                                // ตั้งค่า default สำหรับ start_date และ end_date
        $defaultStartDate = date('Y-m-d');                      // วันนี้
        $defaultEndDate   = date('Y-m-d', strtotime('+1 day')); // พรุ่งนี้

        // รับค่าจากฟอร์ม หรือใช้ค่า default
        $startDate = $request->input('start_date', $defaultStartDate);
        $endDate   = $request->input('end_date', $defaultEndDate);

        // สร้าง query เพื่อกรองวันที่
        $stickerQuery = Sticker::where('category', 'official')
            ->where('status', 1)
            ->orderByRaw("FIELD(country,'th','jp','tw','id','hk') asc");

        $themeQuery = Theme::where('category', 'official')
            ->where('status', 1);

        $emojiQuery = Emoji::where('category', 'official')
            ->where('status', 1);

        // กรองข้อมูลโดยใช้ช่วงวันที่
        $stickerQuery->whereBetween('created_at', [$startDate, $endDate]);
        $themeQuery->whereBetween('created_at', [$startDate, $endDate]);
        $emojiQuery->whereBetween('created_at', [$startDate, $endDate]);

        // ดึงข้อมูลจาก query
        $data['sticker'] = $stickerQuery->take(10)->get();
        $data['theme']   = $themeQuery->take(10)->get();
        $data['emoji']   = $emojiQuery->take(10)->get();

        return view('admin.post.index', $data);
    }

}
