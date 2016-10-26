<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DisplayController extends Controller
{

	/**
	 * Shows the dashboard
	 *
	 */
	public function showDashboard()
	{
		$all = \DB::table('answers')->count();
		$correct = \DB::table('answers')->where('correct', 1)->count();
		$stats = [$all, $correct, $all - $correct];

		return view('dash', ['stats' => $stats]);
	}

	/**
	 * Shows the users
	 *
	 */
	public function showUsers()
	{
		$all = \DB::table('answers')->get();
		$out = array();
		foreach($all AS $answer)
		{
			@$out[$answer->number]['e']++;
			if ($answer->correct == 1) {
				@$out[$answer->number]['c']++;				
			}
		}

		return view('users', ['out' => $out]);
	}

	/**
	 * Gets specific number
	 *
	 * @param  number
	 */
	public function showUser(Request $request)
	{
		$all = \DB::table('answers')->where('number', $request->number)->get();
		return view('user', ['out' => $all, 'number' => $request->number]);
	}

	/**
	 * SHow all correct answers
	 *
	 */
	public function showCorrect()
	{
		$correct = \DB::table('answers')->where('correct', 1)->get();
		return view('correct', ['correct' => $correct]);
	}


}