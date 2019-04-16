<?php
if ( ! function_exists('DateToDB'))
{
	function DateToDB($date = null, $time = null, $is_date_thai = TRUE)
	{
		if(!$date) {
			return null;
		}

		@list($d,$m,$y) = explode('/', $date);
		$y = ($is_date_thai) ? $y - 543 : $y;

		if($time){
			@list($H,$i) = explode(':', $time);
			return @$date ? $y.'-'.$m.'-'.$d.' '.$H.':'.$i.':00' : NULL;
		}

		return @$date ? $y.'-'.$m.'-'.$d : NULL;
	}
}

if ( ! function_exists('DBToDate'))
{
	function DBToDate($date = null, $is_date_thai = TRUE, $showTime = false)
	{
		if(
			!$date ||
			$date == '0000-00-00' ||
			$date == '0000-00-00 00:00:00'
		) {
			return null;
		}
		//year tyep (buddha or christ).
		$year = ($is_date_thai)?(date('Y', strtotime($date))+543):date('Y', strtotime($date));
		return ($showTime) ? date('d/m/', strtotime($date)).$year.' '.date('H:i:s', strtotime($date)) : date('d/m/', strtotime($date)).$year;
	}
}

if ( ! function_exists('DBToTime'))
{
	function DBToTime($date)
	{
		if(
			!$date ||
			$date == '0000-00-00' ||
			$date == '0000-00-00 00:00:00'
		) {
			return null;
		}

		return date('H:i', strtotime($date));
	}
}

if ( ! function_exists('ThaiDate'))
{
	function ThaiDate($thaidate)
	{
		@list($d,$m,$y) = explode('/', $thaidate);
		$y = $y - 543;
		$timestamp = strtotime($y.'-'.$m.'-'.$d);

		$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		$thai_month_arr=array(
		    "0"=>"",
		    "1"=>"มกราคม",
		    "2"=>"กุมภาพันธ์",
		    "3"=>"มีนาคม",
		    "4"=>"เมษายน",
		    "5"=>"พฤษภาคม",
		    "6"=>"มิถุนายน",
		    "7"=>"กรกฎาคม",
		    "8"=>"สิงหาคม",
		    "9"=>"กันยายน",
		    "10"=>"ตุลาคม",
		    "11"=>"พฤศจิกายน",
		    "12"=>"ธันวาคม"
		);

		// global $thai_day_arr,$thai_month_arr;
    $thai_date_return="วัน".$thai_day_arr[date("w",$timestamp)];
    $thai_date_return.= "ที่ ".date("j",$timestamp);
    $thai_date_return.=" ".$thai_month_arr[date("n",$timestamp)];
    $thai_date_return.= " พ.ศ. ".(date("Yํ",$timestamp)+543);
    // $thai_date_return.= "  ".date("H:i",$timestamp)." น.";
    return $thai_date_return;
	}
}

if ( ! function_exists('ThaiDate2'))
{
	function ThaiDate2($thaidate)
	{
		@list($d,$m,$y) = explode('/', $thaidate);
		$y = $y - 543;
		$timestamp = strtotime($y.'-'.$m.'-'.$d);

		$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		$thai_month_arr=array(
		    "0"=>"",
		    "1"=>"มกราคม",
		    "2"=>"กุมภาพันธ์",
		    "3"=>"มีนาคม",
		    "4"=>"เมษายน",
		    "5"=>"พฤษภาคม",
		    "6"=>"มิถุนายน",
		    "7"=>"กรกฎาคม",
		    "8"=>"สิงหาคม",
		    "9"=>"กันยายน",
		    "10"=>"ตุลาคม",
		    "11"=>"พฤศจิกายน",
		    "12"=>"ธันวาคม"
		);

		// global $thai_day_arr,$thai_month_arr;
    // $thai_date_return="วัน".$thai_day_arr[date("w",$timestamp)];
    $thai_date_return = "เมื่อวันที่ <label>".date("j",$timestamp)."</label>";
    $thai_date_return.=" เดือน <label>".$thai_month_arr[date("n",$timestamp)]."</label>";
    $thai_date_return.= " พ.ศ. <label>".(date("Yํ",$timestamp)+543)."</label>";
    // $thai_date_return.= "  ".date("H:i",$timestamp)." น.";
    return $thai_date_return;
	}
}

if ( ! function_exists('ThaiDate3'))
{
	function ThaiDate3($thaidate)
	{
		@list($d,$m,$y) = explode('/', $thaidate);
		$y = $y - 543;
		$timestamp = strtotime($y.'-'.$m.'-'.$d);

		$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
		$thai_month_arr=array(
		    "0"=>"",
		    "1"=>"มกราคม",
		    "2"=>"กุมภาพันธ์",
		    "3"=>"มีนาคม",
		    "4"=>"เมษายน",
		    "5"=>"พฤษภาคม",
		    "6"=>"มิถุนายน",
		    "7"=>"กรกฎาคม",
		    "8"=>"สิงหาคม",
		    "9"=>"กันยายน",
		    "10"=>"ตุลาคม",
		    "11"=>"พฤศจิกายน",
		    "12"=>"ธันวาคม"
		);

    $thai_date_return= date("j",$timestamp);
    $thai_date_return.=" ".$thai_month_arr[date("n",$timestamp)];
    $thai_date_return.= " พ.ศ. ".(date("Yํ",$timestamp)+543);
    return $thai_date_return;
	}
}

if ( ! function_exists('Excel2Date'))
{
	function Excel2Date($excel_date_format)
	{
		// convert 30/11/2015 14:24 to 2015-11-30 14:24
		@list($date,$time) = explode(' ', $excel_date_format);
		@list($d,$m,$y) = explode('/', $date);
		@list($H,$i) = explode(':', $time);
		
		return @$excel_date_format ? $y.'-'.$m.'-'.$d.' '.$H.':'.$i.':00' : NULL;
	}
}
