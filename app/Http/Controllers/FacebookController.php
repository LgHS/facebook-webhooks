<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 23/05/17
 * Time: 00:52
 */

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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

		$json = json_decode($request->getContent());
		/**
		 * TODO :
		 *  - validate request in mmiddleware (hmac)
		 *  - retrieve data from payload (user_id etc.)
		 *  - request to FB Graph API with user_id
		 */

		// {"changes":[{"field":"feed","value": {"item":"like","verb":"add","sender_id":"739017722955825"}}],"id":"1936253853323830","time":1495480999}

		if(!$json)
			return null;

		foreach($json['changes'] as $change) {
			$userData = $this->_getFbUserData($change['sender_id']);

			if(!$userData)
				return null;

			$action = $change['field'] . '-' . $change['value']['item'] . '-' . $change['value']['verb'];

			DB::insert('insert into 
					users_data (`name`,`action`,profile_picture_url,`timestamp`) 
					values (?,?,?,?,?)',
				[$userData->name, $action, $userData->profile_picture_url,$json->time]
			);
		}

		return new JsonResponse(json_decode($request->getContent(), true));
	}

	private function _getFbUserData($userId) {

	}
}