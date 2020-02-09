<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Http\Controllers\Controller;
use App\Models\Subscribe;

class JobController extends Controller
{

	/**
	 * 
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Symfony\Component\HttpKernel\Exception\HttpException
	 */
	public function enqueue(Request $request)
	{
		$rs = Subscribe::all()->take(10);
		foreach($rs as $key => $row){
			$details = ['email' => $row->email];
			$emailJob = (new SendEmail($details))->delay(Carbon::now()->addMinutes($key*2)); // แต่ละ job รันห่างกัน 2 นาที
			dispatch($emailJob);

			dump('add job to email '.$row->email.' next '.($key*2).' Minute');
		}

		// SendEmail::dispatch($details);

		// SendEmail::dispatchNow($details);


		// $emailJob = (new SendEmail($details))->delay(Carbon::now()->addMinutes(5));
        // dispatch($emailJob);


		// SendEmail::withChain([
		// 	new VerificationEmail,
		// 	new WelcomeEmail
		// ])->dispatch();
	}

}