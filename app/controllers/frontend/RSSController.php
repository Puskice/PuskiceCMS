<?php

class RSSController extends BaseController {

	public function index()
	{
		
		$news = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(10);
		return Response::make(RSSGenerator::rss($news), 200, array('Content-type'=> 'text/xml'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function category($permalink = "")
	{
		$category = Category::where('permalink', '=', $permalink)->firstOrFail();
		$news = News::inCategories(array($category->id))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(10);
		return Response::make(RSSGenerator::rss($news), 200, array('Content-type'=> 'text/xml'));
	}

	public function sitemap(){
		$sitemap = App::make("sitemap");

	    // set item's url, date, priority, freq
	    $sitemap->add(Request::root(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
	    $sitemap->add(Request::root()."/marketing", '2013-08-20T20:20:00+02:00', '1.0', 'monthly');
	    $sitemap->add(Request::root()."/puskice", '2013-08-20T20:20:00+02:00', '1.0', 'monthly');

	    if (Cache::has('posts_query'))
	    {
	        $posts = Cache::get('posts_query');
	    }
	    else{
	    	$posts = News::get();
	    	Cache::put('posts_query', $posts, 10080);
	    }

	    foreach ($posts as $post)
	    {
	    	if($post->post_type == 1){
	    		$sitemap->add(Request::root()."/vest/".Puskice::dateToUrl($post->created_at)."/".$post->permalink, $post->updated_at, '1.0', 'daily');	
	    	}
	   		if($post->post_type == 2){
	    		$sitemap->add(Request::root()."/stranica/".$post->permalink, $post->updated_at, '1.0', 'daily');	
	    	}     
	    	if($post->post_type == 3){
	   			$subject = Subject::where('news_id', '=', $post->id)->first();
	   			if($subject != null){
	   				$sitemap->add(Request::root()."/".Puskice::getYear($subject->semester)."/".Puskice::getDepartment($subject->department)."/".$post->permalink, $post->updated_at, '1.0', 'monthly');	
	   			}
	   			else{
	   				Log::info('Predmet za vest: '.$post->id.' nije definisan');
	   			}
	    		
	    	}
	    }

	    if (Cache::has('meme_query'))
	    {
	        $memes = Cache::get('meme_query');
	    }
	    else{
	    	$memes = MemeInstance::get();
	    	Cache::put('meme_query', $memes, 10080);
	    }

	    foreach($memes as $meme){
	    	$sitemap->add(Request::root()."/meme/".$meme->id."-".$meme->permalink, $meme->updated_at, '1.0', 'daily');
	    }

	    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
	    return $sitemap->render('xml');
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}