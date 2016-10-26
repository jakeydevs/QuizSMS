<?php

namespace app\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Pusher\Facades\Pusher;

class NexmoController extends Controller
{

	/**
	 * If we are debugging, we'll send debug info to the
	 * browser
	 *
	 * @param  boolean
	 */
	public $debug = false;

	/**
	 * Match debug with system wide debug rules
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->debug = env('APP_DEBUG', false);
	}

	/**
	 * Webhook recieved from server
	 *
	 * @param  POST request
	 */
	public function webhook(Request $request)
	{

		//-- Check out response to make sure its from Nexmo
		$msgID = $request->input('messageId', '');
		if ($msgID == '') { return response()->json(['bad' => true]); }

		$this->logDebug("Message ID: " . $msgID);
		//-- Lets gather information from the text
		$message 	= $request->input('text');
		$from 		= $request->input('msisdn'); 

		Pusher::trigger('main', 'new-sms', ['date' => date("d/m H:i:s"), 'from' => $from, 'message' => $message]);

		$this->logDebug("From: " . $from);
		$this->logDebug("Message: " . $message);

		//-- Lets parse the answer and the question number. First we will
		//-- lowercase the message
		$message = strtolower($message);

		//-- Split the text message, as it should have a space between the answer, and
		//-- the question number
		$split = explode(" ", $message);
		if (count($split) < 2)
		{
			$this->logDebug("Message doesn't contain an answer to a question");
			exit();
		}

		$answer = $split[0];
		$question = intval($split[1]);

		//-- Basic validation - removed to allow for 
		//-- a better range of questions and answers
		/*
		if (!in_array($answer, ['a', 'b', 'c'])) {
			$this->logDebug("Answer is not allowed [" . $answer . "]");
			exit();
		}

		if (!in_array($question, range(1, 12))) {
			$this->logDebug("Question is not allowed [" . $question . "]");
			exit();
		}
		*/

		//-- Check if this user has answered before
		$check = \DB::table('answers')->where('number', $from)->where('question', $question)->first();
		if ($check == null) {
			$this->logDebug("Checking if answer is correct");
			$answerSheet = config('answers');

			$correct = 0;
			if (@$answerSheet[$question] == $answer) {
				//-- Woop
				$this->logDebug("Answer correct");
				$correct = 1;
			}

			//-- Save
			$insert = array();
			$insert['number'] = $from;
			$insert['question'] = $question;
			$insert['answer'] = $answer;
			$insert['correct'] = $correct;
			$insert['created_at'] = date("Y-m-d H:i:s");
			\DB::table('answers')->insert($insert);
			$this->logDebug("Answer saved");

			//-- Pusher
			Pusher::trigger('main', 'new-entry', ['stats' => $this->getStats()]);

			exit();

		} else {
			$this->logDebug("Number already entered");
			exit();
		}

		
	}

	/**
	 * Debug
	 *
	 * @param  log
	 */
	private function logDebug($log)
	{
		if ($this->debug)
		{
			echo "[" . date("Y-m-d H:i:s") . "] " . $log . "<BR>";
		}
	}

	/**
	 * Get Stats
	 *
	 */
	public function getStats()
	{
		$all = \DB::table('answers')->count();
		$correct = \DB::table('answers')->where('correct', 1)->count();
		return [$all, $correct, $all - $correct];
	}

}