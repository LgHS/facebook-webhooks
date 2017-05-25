<?php
namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ThermalController extends Controller {
	public function index(Request $request) {

		$data  = DB::select('SELECT * FROM users_data');
		$json = [];
		foreach ($data as $d){
			$json[] =
				[
					'name' => $d->name,
					'action' => $d->action,
					'sender_id' => $d->sender_id,
					'timestamp' => $d->timestamp,
					'profile_public_url' => $d->profile_picture_url
				];
//			DB::delete('DELETE from users_data WHERE id = ?', [$d->id]);
		}

		return new JsonResponse($json);
	}
}