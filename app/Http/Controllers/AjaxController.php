<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Sticker;
use App\Models\StickerView;

use DB;
use Session;
use Goutte;

class AjaxController extends Controller
{
    public function getUpdateviewcount()
	{

        if(is_numeric($_GET['productID'])){

            $sessionID = Session::getId();

            // หาแถวใน sticker_view เพื่อหาว่า session_id นี้มีแล้วหรือยัง
            $stickerView = new StickerView;
            $stickerView = $stickerView
                            ->select('id')
                            ->where('sticker_id',$_GET['productID'])
                            ->where('session_id',$sessionID)
                            ->where('type',$_GET['productType'])
                            ->first();
            
            // ถ้าไม่มีแถวนี้มาก่อนเลย ให้ insert เพิ่มเข้าไปอีก 1 แถวปัจจุบัน
            if (empty($stickerView->id))
            {
                DB::table('sticker_views')->insert(
                    [
                        'sticker_id' => $_GET['productID'], 
                        'session_id' => $sessionID,
                        'ip' => $_SERVER['REMOTE_ADDR'],
                        'type' => $_GET['productType'],
                        'created' => date("Y-m-d H:i:s"),
                    ]
                );
            }

            if($_GET['productType'] == 'sticker'){
                $column = 'sticker_code';
            }elseif($_GET['productType'] == 'theme'){
                $column = 'id';
            }elseif($_GET['productType'] == 'emoji'){
                $column = 'id';
            }

            // upated threedays ในเทเบิ้ล stickers
            DB::statement("UPDATE ".$_GET['productType']."s SET updated_at = '".date("Y-m-d H:i:s")."', threedays = (SELECT COUNT(id) total FROM sticker_views WHERE sticker_id =" . $_GET['productID'] . " AND created > NOW() - interval 3 DAY) where ".$column." = " . $_GET['productID']);

        }

    }
    
    public function getUpdatestamp()
	{

        if(is_numeric($_GET['sticker_code'])){
            
            $crawler = Goutte::request('GET','https://store.line.me/stickershop/product/'.$_GET['sticker_code'].'/th');
                
                // หา stamp_start & stamp_end
                for ($i = 0; $i < 40; $i++) {
                    // check node empty
                    if ($crawler->filter('.mdCMN09Image')->eq($i)->count() != 0) {
                        $imgTxt = $crawler->filter('.mdCMN09Image')->eq($i)->attr('style');
                        $image_path = explode("/", getUrlFromText($imgTxt));
                        $stamp_code = $image_path[6];
                        // dump($stamp_code);

                        $data[] = array(
                            'stamp_code' => $stamp_code,
                        );
                    }
                }

                if ($crawler->filter('.mdCMN09Image')->eq(0)->count() != 0) {
                    DB::statement("UPDATE stickers SET updated_at = '".date("Y-m-d H:i:s")."', stamp_start = ".@reset($data)['stamp_code'].", stamp_end = ".@end($data)['stamp_code']." where sticker_code = " . $_GET['sticker_code']);
                }

                unset ($data);
        }

    }
}
