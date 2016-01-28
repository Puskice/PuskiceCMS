<?php

// added in v4.0.5
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;
 
// added in v4.0.0
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;

class BaseController extends Controller {

	public function __construct()
	{
		session_start();
		FacebookSession::setDefaultApplication('355697367892039', '4e86edc58e5798b253dd55c164504512');
	    $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
	    $fbuser = User::where('facebook_id', '=', Session::get('facebook_id'))->where('facebook_id', '<>', '')->first();
	    if(isset($fbuser->id)){
	    	Session::put('username', $fbuser->username);
			Session::put('user_level', $fbuser->user_level);
			Session::put('id', $fbuser->id);
	    }elseif(Cookie::get('ps_login') && !Session::get('id')){
			$user = unserialize(Cookie::get('ps_login'));
			if(isset($user->id)){
				Session::put('username', $user['username']);
				Session::put('user_level', $user['user_level']);
				Session::put('id', $user['id']);
			}
			else{
				Cookie::forget('ps_login');
			}
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function googleAnalytics($uri){
		$url = 'https://ssl.google-analytics.com/collect';
		$data = array('v' => '1', 'tid' => 'UA-1599707-6', 'cid' => '2015', 't' => 'pageview', 'dp' => urlencode($uri));

		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data),
		    ),
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
	}

}
