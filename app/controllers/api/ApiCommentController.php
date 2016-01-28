<?php

class ApiCommentController extends BaseController {

	public function __construct(){
		Event::forget('router.filter: csrf');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->googleAnalytics('/comments');
		$comments = Comment::where('published', 1)->orderBy('created_at', 'desc')->paginate(20);
		return Response::json($comments);
	}

	public function getNewsComments($id){
		try {
			$this->googleAnalytics('/comments/news-comments/'.$id);
			$news = News::findOrFail($id);
			$comments = Comment::where('news_id', $id)->where('published', 1)->orderBy('created_at', 'desc')->paginate(20);
			return Response::json($comments);
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getThumbsUp($id){
		try {
			$this->googleAnalytics('/comments/thumbs-up/'.$id);
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 2)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$comment = Comment::findOrFail($id);
			$comment->thumbs_up ++;
			$comment->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $comment->id;
			$thumb->object_type = 2;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['comments'][$comment->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили овај коментар")));
				}
			}
			$thumbs['comments'][$comment->id] = 'up';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $comment->thumbs_up, 'thumbsDown' => $comment->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили овај коментар")));
		}
	}

	public function getThumbsDown($id){
		try {
			$this->googleAnalytics('/comments/thumbs-down/'.$id);
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 2)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$comment = Comment::findOrFail($id);
			$comment->thumbs_down ++;
			$comment->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $comment->id;
			$thumb->object_type = 2;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['comments'][$comment->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили овај коментар")));
				}
			}
			$thumbs['comments'][$comment->id] = 'down';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $comment->thumbs_up, 'thumbsDown' => $comment->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили овај коментар")));
		}
	}

	public function postCreate($id){
		try {
			$this->googleAnalytics('/comments/create/'.$id);
			$comment = new Comment;
			$news = News::findOrFail($id);
			if(Input::get('createdAt')){
    			$comment->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
    		}
    		else{
    			$comment->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
    		}
    		$comment->comment_content	= Input::get('commentContent');
    		$akismet = new Akismet('http://www.puskice.org/', '5fa6e0236f7b');
			$akismet->setCommentAuthor($comment->username);
			$akismet->setCommentAuthorEmail($comment->email);
			$akismet->setCommentAuthorURL("");
			$akismet->setCommentContent($comment->comment_content);
			$akismet->setPermalink('http://www.puskice.org/vest/'.Puskice::dateToUrl($news->created_at).'/'.$news->permalink);
			if($akismet->isCommentSpam()){
				$comment->deleted_at = date('Y-m-d H:i:s', strtotime('now'));
			}
    		if(Input::get('user_id')){
    			$comment->published 	= 1;	
    		}
    		else{
    			$comment->published 	= 0;	
    		}
    		if(Input::get('user_id')){
    			$user = User::find(Input::get('user_id'));
    			$comment->username 		= $user->username;
    			$comment->email 		= $user->email;
    		}
    		else{
    			$comment->username 		= Input::get('username');
    			$comment->email 		= Input::get('email');
    		}
    		if(Input::get('user_id')){
    			$comment->user_id		= Input::get('user_id');	
    		}
    		else{
    			$comment->user_id		= 0;
    		}
    		$comment->news_id 			= $id;
    		$comment->ip_address 		= Puskice::getIP();
    		$comment->save();

    		if($comment->deleted_at == null){
				$user = array(
				    'email'=>'info@puskice.org',
				    'name'=>'Info tim'
				);
				// the data that will be passed into the mail view blade template
				$data = array(
				    'url'=> "http://www.puskice.org/".Config::get('settings.admin_url')."/comments/edit/".$comment->id,
				    'approve_url' => "http://www.puskice.org/".Config::get('settings.admin_url')."/comments/publish/".$comment->id,
				    'delete_url' => "http://www.puskice.org/".Config::get('settings.admin_url')."/comments/trash/".$comment->id,
				    'username' => $comment->username,
				    'email' => $comment->email,
				    'title' => $news->title,
				    'news' => 1,
				    'news_id' => $news->id,
				    'content' => $comment->comment_content
				);
				 
				// use Mail::send function to send email passing the data and using the $user variable in the closure
				Mail::send('emails.new_comment', $data, function($message) use ($user)
				{
				  $message->from('info@puskice.org', "Puškice cenzura");
				  $message->to('info@puskice.org', 'Info tim Puškice')->subject('Novi komentar čeka moderaciju');
				});
			}
    		return Response::json(array('status' => 'success', 'message' => __("Ваш коментар је успешно прослеђен")));
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}


	public function postCreateMemeComment($id){
		try {
			$comment = new MemeComment;
			$news = MemeInstance::findOrFail($id);
			if(Input::get('createdAt')){
    			$comment->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
    		}
    		else{
    			$comment->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
    		}
    		$comment->comment_content	= Input::get('commentContent');
    		$akismet = new Akismet('http://www.puskice.org/', '5fa6e0236f7b');
			$akismet->setCommentAuthor($comment->username);
			$akismet->setCommentAuthorEmail($comment->email);
			$akismet->setCommentAuthorURL("");
			$akismet->setCommentContent($comment->comment_content);
			$akismet->setPermalink('http://www.puskice.org/meme/'.$news->id.'-'.$news->permalink);
			if($akismet->isCommentSpam()){
				$comment->deleted_at = date('Y-m-d H:i:s', strtotime('now'));
			}
    		if(Input::get('user_id')){
    			$comment->published 	= 1;	
    		}
    		else{
    			$comment->published 	= 0;	
    		}
    		if(Input::get('user_id')){
    			$user = User::find(Input::get('user_id'));
    			$comment->username 		= $user->username;
    			$comment->email 		= $user->email;
    		}
    		else{
    			$comment->username 		= Input::get('username');
    			$comment->email 		= Input::get('email');
    		}
    		if(Input::get('user_id')){
    			$comment->user_id		= Input::get('user_id');	
    		}
    		else{
    			$comment->user_id		= 0;
    		}
    		$comment->news_id 			= $id;
    		$comment->ip_address 		= Puskice::getIP();
    		$comment->save();
    		if($comment->deleted_at == null){
				$user = array(
				    'email'=>'info@puskice.org',
				    'name'=>'Info tim'
				);
				// the data that will be passed into the mail view blade template
				$data = array(
				    'url'=> "http://www.puskice.org//".Config::get('settings.admin_url')."/meme-comments/edit/".$comment->id,
				    'approve_url' => "http://www.puskice.org//".Config::get('settings.admin_url')."/meme-comments/publish/".$comment->id,
				    'delete_url' => "http://www.puskice.org//".Config::get('settings.admin_url')."/meme-comments/trash/".$comment->id,
				    'username' => $comment->username,
				    'email' => $comment->email,
				    'title' => $news->title,
				    'news' => 1,
				    'news_id' => $news->id,
				    'content' => $comment->comment_content
				);
				 
				// use Mail::send function to send email passing the data and using the $user variable in the closure
				Mail::send('emails.new_comment', $data, function($message) use ($user)
				{
				  $message->from('info@puskice.org', "Puškice cenzura");
				  $message->to('info@puskice.org', 'Info tim Puškice')->subject('Novi meme komentar čeka moderaciju');
				});
			}
    		return Response::json(array('status' => 'success', 'message' => __("Ваш коментар је успешно прослеђен")));
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}


}
