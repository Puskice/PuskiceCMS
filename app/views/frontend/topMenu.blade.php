@section('topMenu')
<div class="white-wrapper">
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</button>
		      	<a class="navbar-brand" href="{{Request::root()}}"><span class="glyphicon glyphicon-home"></span></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      	<ul class="nav navbar-nav">
		        	<li class="dropdown">
		          		<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Пушкице")}} <span class="caret"></span></a>
				        <ul class="dropdown-menu" role="menu">
				            <li><a href="{{_l(Request::root().'/stranica/puskice')}}">{{__("О Пушкицама")}}</a></li>
				            <li><a href="{{_l(Request::root().'/stranica/uslovi-koriscenja')}}">{{__("Услови коришћења")}}</a></li>
				            <li><a href="{{_l(Request::root().'/stranica/vremeplov')}}">{{__("Времеплов")}}</a></li>
				            <li><a href="{{_l(Request::root().'/konverzija')}}">Ћирилица / Latinica</a></li>
				            <li><a href="{{_l(Request::root().'/stranica/posaljite-materijal')}}">{{__("Пошаљите материјал")}}</a></li>
				            <li><a href="https://plus.google.com/+puskice" rel="publisher">{{__("Гугл +")}}</a></li>
				        </ul>
		        	</li>
			        <li><a href="{{_l(Request::root().'/stranica/marketing')}}">{{__("Маркетинг")}}</a></li>
			        <li><a href="{{_l(Request::root().'/stranica/kontakt')}}">{{__("Контакт")}}</a></li>
			        <li><a href="{{_l(Request::root().'/2048')}}">{{__("2048")}}</a></li>
			        <li class="dropdown">
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Додаци")}} <span class="caret"></span></a>
				        <ul class="dropdown-menu" role="menu">
				        	<li><a href="https://api.puskice.org" target="_blank">{{__("API")}}</a></li>
				            <li><a target="_blank" href="https://chrome.google.com/webstore/detail/pu%C5%A1kice-fon-andergraund/cbgelakcjcfdcikmofaohcfpafnbojpk">{{__("Екстензија за Гугл Chrome")}}</a></li>
				            <li><a target="_blank" href="https://addons.mozilla.org/en-US/firefox/addon/pu%C5%A1kice-fon/">{{__("Екстензија за Mozilla Firefox")}}</a></li>
				        </ul>
		        	</li>
			        <!-- <li class="dropdown">
		          		<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Огласи")}} <span class="caret"></span></a>
				        <ul class="dropdown-menu" role="menu">
				        	<li><a href="#">{{__("Постави оглас")}}</a></li>
				            <li><a href="#">{{__("Уџбеници")}}</a></li>
				            <li><a href="#">{{__("Часови")}}</a></li>
				            <li><a href="#">{{__("Становање")}}</a></li>
				            <li><a href="#">{{__("Опрема")}}</a></li>
				            <li><a href="#">{{__("Разно")}}</a></li>
				        </ul>
		        	</li> -->
			        <li><a href="http://bazaznanja.puskice.org" target="_blank">{{__("База знања")}}</a></li>
			        <li><a href="{{_l(Request::root().'/novi-clanovi')}}">{{__("Постани члан")}}</a></li>
			    </ul>
		      	<ul class="nav navbar-nav navbar-right">
		      		@if(!Session::get('facebook_id') && !Session::get('id'))
		      			<li>{{LoginController::facebookLoginLink()}}</li>
		      		@endif
		      		@if(Session::get('trans') == "lat")
			        	<li><a href="{{Request::root().sq($_SERVER["REQUEST_URI"])}}?l=cyr">Ћирилица</a></li>
			        @else
			        	<li><a href="{{Request::root().sq($_SERVER["REQUEST_URI"])}}?l=lat">Latinica</a></li>
			        @endif
			        <li><a href="https://www.facebook.com/puskice" target="_blank"><i class="fa fa-facebook"></i></a></li>
			        <li><a href="https://twitter.com/puskice" target="_blank"><i class="fa fa-twitter"></i></a></li>
			        <li><a href="https://plus.google.com/+puskice" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			        <li><a href="{{Request::root()}}/rss" target="_blank"><i class="fa fa-rss"></i></a></li>
			        @if(!Session::get('username'))
			        <li class="dropdown">
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Пријави се")}} <span class="caret"></span></a>
			          	<ul class="dropdown-menu login-form" role="menu">
				            <form action="{{URL::action('LoginController@postSignin')}}" method="post">
							  	<div class="form-group">
								    <label for="username1">{{__("Корисничко име")}}</label>
								    <input type="text" class="form-control" id="username1" name="username" placeholder="{{__("Корисничко име")}}">
								</div>
							  	<div class="form-group">
								    <label for="password">{{__("Лозинка")}}</label>
								    <input type="password" class="form-control" id="password" name="password" placeholder="{{__("Лозинка")}}">
								</div>
								<div class="form-group">
									<input id="user_remember_me" style="float: left; margin-right: 10px;" type="checkbox" name="remember" value="1" />
									<input type="hidden" name="_token" value="{{Session::get('_token')}}">
								  	<label class="string optional" for="user_remember_me"> {{__("Запамти ме")}}</label>
								 
								  	<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="{{__("Пријави се")}}" /> <br/>
								</div>
							  	<div class="form-group">
								  	<a class="btn btn-info" href="{{_l(URL::action('LoginController@getRegister'))}}">{{__("Региструј се")}}</a>
								  	<a class="btn btn-default pull-right" href="{{_l(URL::action('LoginController@getResetPassword'))}}">{{__("Ресетуј лозинку")}}</a>
								</div>
							</form>
			          	</ul>
			        </li>
			        @else 
			        <li class="dropdown">
			        	@if(Session::get('facebook_id'))
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{LoginController::facebookLoginLink()}} <span class="caret"></span></a>
			        	@else
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Session::get('username')}} <span class="caret"></span></a>
			        	@endif
			        	<ul class="dropdown-menu" role="menu">
				        	<li><a href="{{URL::action('LoginController@getSignout')}}">{{__("Одјави се")}}</a></li>
				        	<li><a href="{{URL::action('LoginController@getMyProfile')}}">{{__("Моје Пушкице")}}</a></li>
				        	@if(Session::get('user_level') > Config::get('cms.accessAdminPanel'))
				        		<li><a href="{{URL::action('AdminHomeController@getIndex')}}">{{__("Управа :)")}}</a></li>
				        	@endif
				        </ul>
			        </li>
			        @endif
		      	</ul>
		    </div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="clearfix"></div>
</div>
@stop