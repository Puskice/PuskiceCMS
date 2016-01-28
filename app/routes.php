<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::controller('apinews', 'ApiNewsController');
//Route::controller('apicomments', 'ApiCommentController');
Route::controller('apipages', 'ApiPageController');
Route::controller('apipolls', 'ApiPollController');

//TO-DO
Route::controller('apisubjects', 'ApiSubjectController');
Route::controller('apicontacts', 'ApiContactController');
Route::controller('apifiles', 'ApiFileController');

Route::controller('login', 'LoginController');
Route::get('novi-clanovi', 'HomeController@newMembers');
Route::post('novi-clanovi/prijava', 'HomeController@apply');
Route::get('konverzija', 'HomeController@conversion');
Route::get('rss', 'RSSController@index');
Route::get('{permalink}/rss', 'RSSController@category')->where('permalink', '([A-Za-zА-Ша-ш0-9\-\_]+)');
Route::get('sitemap', 'RSSController@sitemap');
Route::get('2048', 'HomeController@function2048');
Route::get('pacman', 'HomeController@pacman');
Route::get('kviz', 'HomeController@kviz');
Route::post('kviz', 'HomeController@postKviz');

Route::group(array('before' => 'auth.admin', 'prefix' => Config::get('settings.admin_url')), function()
{

	Route::get('/', array('as' => 'adminHome', 'uses' => 'AdminHomeController@getIndex'));
	Route::controller('comments', 'CommentController');
	Route::controller('users', 'UserController');
	Route::controller('news', 'NewsController');
	Route::controller('pages', 'PageController');
	Route::controller('files', 'FileController');
	Route::controller('categories', 'CategoryController');
	Route::controller('menus', 'MenuController');
	Route::controller('polls', 'PollController');

	//puskice specific routes
	Route::controller('subjects', 'SubjectController');	
	Route::controller('contacts', 'ContactController');	
	Route::controller('marks', 'MarkController');	
	Route::controller('memes', 'MemeController');	
	Route::controller('memes-comments', 'MemeCommentController');
	/*Route::controller('surveys','Ps_surveys');	*/
	//end puskice specific routes

	//web shop routes
	Route::controller('products', 'ProductController');
	Route::controller('events', 'EventController');
	Route::controller('product-categories', 'ProductCategoryController');
	Route::controller('tickets', 'TicketController');
	
	//end webshop routes

});

Route::group(array('domain' => 'bazaznanja.puskice.org'), function()
{
	Route::get('/', function(){

	});

	Route::post('/', function(){
		
	});
	
	
});

Route::group(array('domain' => 'testovi.puskice.org'), function()
{
	Route::get('/', function(){

	});

	Route::post('/', function(){
		
	});

	Route::put('/', function(){
		
	});

	Route::delete('/', function(){
		
	});
	
	
});

// Public API
Route::group(array('domain' => 'api.puskice.org'), function()
{
	Route::get('/', 'ApiNewsController@homePage');
	//Route::controller('comments', 'ApiCommentController');
	Route::controller('news', 'ApiNewsController');
	Route::controller('pages', 'ApiPageController');
	Route::controller('polls', 'ApiPollController');

	//TO-DO
	Route::controller('subjects', 'ApiSubjectController');
	Route::controller('contacts', 'ApiContactController');
	Route::controller('files', 'ApiFileController');
});


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'));

Route::get('memes/new', 'PublicMemeController@newMeme');
Route::post('memes/add', 'PublicMemeController@store');
Route::get('memes/{slug?}/{per_page?}', 'PublicMemeController@memes')->where('slug', '([A-Za-zА-Ша-ш0-9\-\_]+)')->where('per_page', '[0-9]+');
Route::get('meme/{id}', 'PublicMemeController@singleMeme')->where('id', '([A-Za-zА-Ша-ш0-9\-\_]+)');
Route::get('meme/decoder/{data}/{news_id}/{first_line}/{second_line}', 'PublicMemeController@memedecode');

Route::get('ankete', array('as' => 'ankete', 'uses' => 'PublicPollController@index'));
Route::get('{permalink}', array('as' => 'home', 'uses' => 'PublicNewsController@singleCategory'))->where('permalink', '([A-Za-zА-Ша-ш0-9\-\_]+)');

Route::get('stranica/{permalink}', array('as' => 'singlePage', 'uses' => 'PublicNewsController@singlePage'))->where('permalink', '([A-Za-zА-Ша-ш0-9\-\_]+)');
Route::get('vest/{date}/{permalink}', array('as' => 'singleNews', 'uses' => 'PublicNewsController@singleNews'))->where('permalink', '([A-Za-zА-Ша-ш0-9\-\_]+)')->where('date', '([0-9]+)');
Route::get('{year}/{department}/{permalink}', array('as' => 'singleSubject', 'uses' => 'PublicNewsController@singleSubject'))->where('year', '([A-Za-zА-Ша-ш0-9\-\_]+)')->where('department', '([A-Za-zА-Ша-ш0-9\-\_]+)')->where('permalink', '([A-Za-zА-Ша-ш0-9\-\_]+)');
Route::get('ljudi/{id}', array('as' => 'ljudi', 'uses' => 'PublicContactController@show'))->where('id', '[0-9]+');
Route::post('oceni/{id}', array('as' => 'oceni', 'uses' => 'PublicContactController@oceni'))->where('id', '[0-9]+');

Route::get('ankete/{id}', array('as' => 'anketa', 'uses' => 'PublicPollController@singlePoll'))->where('id', '[0-9]+');


//Routes for (big) surveys <added by Devetar, 14.3.2015.>

/*Route::get('survey/{id}',array(	'uses'=>'Ps_surveys@startform', 'as'=>'startform'))->where('id', '[0-9]+');
Route::post('survey/{id}',array(	'uses'=>'Ps_surveys@preparebig','as'=>'preparebigform'))->where('id', '[0-9]+');
Route::post('surveyentry/done',array('uses'=>'Ps_surveys@submited','as'=>'bigform'));
Route::post('/surveyentry/checkpost',array('uses'=>'Ps_surveys@checkpost','as'=>'checkpost'));*/
