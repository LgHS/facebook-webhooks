<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 23/05/17
 * Time: 00:52
 */

namespace App\Http\Controllers;


use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Monolog\Logger;

class FacebookController extends Controller {
	public function verifyUrl(Request $request) {
		// If Facebook is asking for challenge, return it
		if($request->query->get('hub_challenge')) {
			return new Response($request->query->get('hub_challenge'));
		} else {
			return null;
		}
	}

	public function webhook(Request $request) {

		$json = json_decode($request->getContent(), true);
		/**
		 * TODO :
		 *  - validate request in mmiddleware (hmac)
		 *  - retrieve data from payload (user_id etc.)
		 *  - request to FB Graph API with user_id
		 */

		Log::info($request->getContent());

		// {"changes":[{"field":"feed","value": {"item":"like","verb":"add","sender_id":"739017722955825"}}],"id":"1936253853323830","time":1495480999}

		if(!$json)
			return null;

		foreach($json['entry'][0]['changes'] as $change) {
			$userData = $this->_getFbUserData($change['value']['sender_id']);

			if(!$userData)
				return null;

			$action =  $change['value']['verb'] . '_' . $change['value']['item'];

			DB::insert('insert into 
					users_data (`name`,`action`,`timestamp`) 
					values (?,?,?)',
				[$userData['name'], $action,$json['time']]
			);
		}

		return new JsonResponse(json_decode($request->getContent(), true));
	}
	public function test(Request $req){


	}
	private function _getFbUserData($userId) {
		$fb = app( Facebook::class );
		try {
			$response = $fb->get( '/' .$userId, env( 'APP_ACCESS_TOKEN' ) );
		} catch ( FacebookResponseException $e ) {
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch ( FacebookSDKException $e ) {
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
		$user = $response->getGraphUser();

		return $user;
	}
}