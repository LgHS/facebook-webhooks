<?php
/**
 * Created by PhpStorm.
 * User: gberger
 * Date: 25/05/17
 * Time: 02:11
 */

namespace App\Providers;


use Facebook\Facebook;
use Facebook\FacebookApp;
use Illuminate\Support\ServiceProvider;

class FacebookServiceProvider extends ServiceProvider {


	public function register(){
		$this->app->singleton(Facebook::class, function ($app){
			return new Facebook([
				'app_id' => env('FACEBOOK_APP_ID'),
				'app_secret' => env('APP_SECRET'),
				'default_graph_version' => 'v2.2',
			]);
		});
	}

	public function boot(){

	}


}