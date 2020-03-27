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

if ( ! function_exists('ThaiDate'))
{
	function ThaiDate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
		// return "$strDay $strMonthThai $strYear $strHour:$strMinute";
	}
}
