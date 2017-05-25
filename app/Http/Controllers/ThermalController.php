<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ThermalController extends Controller {
	public function index(Request $request) {
		return new JsonResponse([
			[
				'sender_id' => '10156160031998989',
				'name' => 'Jonathan Berger',
				'action' => 'page_like',
				'timestamp' => '1495480999',
				'profile_public_url' => 'https://scontent.xx.fbcdn.net/v/t1.0-1/p480x480/1926855_10152679111558989_489741242_n.jpg?oh=60eedad63dc03b6824b398c078d55e4e&oe=59A80419'
			],
			[
				'sender_id' => '10156160031998989',
				'name' => 'Dominique Nimous',
				'action' => 'post_comment',
				'timestamp' => '1495480999',
				'profile_public_url' => 'https://scontent.xx.fbcdn.net/v/t1.0-1/p480x480/1926855_10152679111558989_489741242_n.jpg?oh=60eedad63dc03b6824b398c078d55e4e&oe=59A80419'
			],
			[
				'sender_id' => '10156160031998989',
				'name' => 'Jonathan Berger',
				'action' => 'post_share',
				'timestamp' => '1495480999',
				'profile_public_url' => 'https://scontent.xx.fbcdn.net/v/t1.0-1/p480x480/1926855_10152679111558989_489741242_n.jpg?oh=60eedad63dc03b6824b398c078d55e4e&oe=59A80419'
			],
			[
				'sender_id' => '10156160031998989',
				'name' => 'Jerome K',
				'action' => 'page_like',
				'timestamp' => '1495480999',
				'profile_public_url' => 'https://scontent.xx.fbcdn.net/v/t1.0-1/p480x480/1926855_10152679111558989_489741242_n.jpg?oh=60eedad63dc03b6824b398c078d55e4e&oe=59A80419'
			],
		]);
	}
}