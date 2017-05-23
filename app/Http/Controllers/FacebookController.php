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
		return new JsonResponse(json_decode($request->getContent(), true));
	}
}