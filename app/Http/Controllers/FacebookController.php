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
		DB::insert('insert into 
					users_data (`name`,`action`,action_text,profile_picture_url,`timestamp`) 
					values (?,?,?,?,?)',
					[$json->name, $json->action, $json->action_text, $json->profile_picture_url,$json->timestamp]
		);
		return new JsonResponse(json_decode($request->getContent(), true));
	}
}