<?php
if(!function_exists('set_notify'))
{
	function set_notify($type,$msg, $sync_file = false)
	{
		Session::flash('js_notify', true);
		Session::flash('type', $type);
		Session::flash('msg', $msg);
		Session::flash('sync_file', $sync_file);
	}
}

if(!function_exists('notify'))
{
	function js_notify()
	{
		if(Session::get('js_notify'))
		{
			$js = '<link rel="stylesheet" href="js/notifyBar/jquery.jnotify.css" type="text/css" media="screen" />';
		    $js .= '<script type="text/javascript" src="js/notifyBar/jquery.jnotify.js"></script>';
		    $js .= '<script type="text/javascript">
		    				$(function () {
								$.jnotify("'.Session::get('msg').'",{
									type: "'.Session::get('type').'",
									delay: 2000,
								});';

			if (Session::get('sync_file')) {
				$js .= " $.get( '".url_int().Session::get('sync_file')."', function(data) { console.log('ok') } )";
			}

			$js .= '		});';
			$js .= '</script>';
			return $js;
		}
	}
}
