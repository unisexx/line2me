<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class AjaxController extends Controller
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

    function changestatus()
	{
		$statusArray = array("true"=>"1", "false"=>"0");
        $status = $statusArray[$_GET['status']];
        DB::table($_GET['table'])->where('id', $_GET['id'])->update(['status' => $status]);
    }
    
    function changecountry()
	{
        DB::table($_GET['table'])->where('id', $_GET['id'])->update(['country' => $_GET['country']]);
    }
    
    function changecategory()
    {
        DB::table($_GET['table'])->where('id', $_GET['id'])->update(['category' => $_GET['category']]);
    }
}
