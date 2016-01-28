<?php 

	function __($string){
		return Trans::_t($string);
	}

	function dots($string, $length=null){
		if($length == null) $length = Config::get('cms.3dots');
		return Puskice::add3dots($string, $length);
	}

	function userStatus($user){
		switch ($user->published) {
			case 1:
				return "<span class=\"label label-success\">".__(Lang::get('admin.active'))."</span>";
				break;
			
			case 0:
				return "<span class=\"label label-warning\">".__(Lang::get('admin.inactive'))."</span>";
				break;

			default:
				return "<span class=\"label label-danger\">".__(Lang::get('admin.error'))."</span>";
				break;				
		}
	}

	function userLevel($user){
		switch ($user->user_level) {
			case 10:
				return "<span class=\"label label-success\">".__(Lang::get('admin.administrator'))."</span>";
				break;
			
			case 9:
				return "<span class=\"label label-warning\">".__(Lang::get('admin.editor'))."</span>";
				break;

			case 1: 
				return "<span class=\"label label-info\">".__(Lang::get('admin.ordinaryuser'))."</span>";
				break;
		}
	}

	function newsStatus($news){
		switch ($news->published) {
			case 2:
				return "<span class=\"label label-success\">".__(Lang::get('admin.published'))."</span>";
				break;
			
			case 1:
				return "<span class=\"label label-warning\">".__(Lang::get('admin.adminOnly'))."</span>";
				break;

			case 0:
				return "<span class=\"label label-danger\">".__(Lang::get('admin.unpublished'))."</span>";
				break;

			default:
				return "<span class=\"label label-danger\">".__(Lang::get('admin.error'))."</span>";
				break;				
		}
	}

	function commentCount($news){
		return $commentCount = $news->comments()->count();
	}

	function getAdminUrl(){
		return Request::root()."/".Config::get('settings.admin_url');
	}

	function slugify($string){
		return Puskice::url_slug($string);
	}

	function _l($url){
		if(Session::get('trans') == 'cyr'){
			return $url."?l=cyr";
		}
		else{
			return $url."?l=lat";
		}
	}

	function amres($ip){
		if(strpos($ip, "147.91.") !== FALSE){
			return true;
		}
		return false;
	}

	function sq($url){
		return preg_replace('/\?.*/', '', $url);
	}

	function firstImage($post, $thumbs=false){
		return Puskice::firstImage($post, $thumbs);
	}

	function dateToUrl($date){
		return Puskice::dateToUrl($date);
	}

	function urlToDate($url){
		return Puskice::urlToDate($url);
	}

	function getFeed($url, $howmany=5){
		try {
			$content = file_get_contents($url);
			$content = str_replace('&nbsp;', '&#160;', $content);
		    $feed = new SimpleXmlElement($content);
		    $items = array();
		    foreach ($feed->channel->item as $key => $item) {
	    		if(sizeof($items) < $howmany){
		    		$items[] = $item;
	    		}

		    }
		    return $items;
			
		} catch (Exception $e) {
			return ;
		}
	}


