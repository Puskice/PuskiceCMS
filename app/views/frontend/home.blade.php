<!doctype html>
<html lang="sr">
<head>
	@yield('head')
</head>
<body>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '355697367892039',
	      xfbml      : true,
	      version    : 'v2.2'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));
	</script>
	<div id="fb-root"></div>
	<!-- <div class="white-container"> -->
	<div class="fixed_wall_banner banner_left">    	    
     	<!--    Soliter-levo-470x1080  -->
        <div id='div-gpt-ad-1377726727451-0'>
	        <script type='text/javascript'> 
	        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1377726727451-0'); });
	        </script>
        </div>
	</div>
    <div class="fixed_wall_banner banner_right">
      	<!--  Soliter-desno-470x1080 -->
        <div id='div-gpt-ad-1377726947400-0'>
	        <script type='text/javascript'>
	        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1377726947400-0'); });
	        </script>
        </div>
    </div>
	<div class="container top-menu">
		<div class="col-md-12">
			@yield('topMenu')
			@yield('errorReporting')
		</div>
	</div>
	<div class="container header">
		<div class="col-md-12 header-wrapper">
			@yield('carousel')
			@yield('header')
		</div>
	</div>
	<div class="container main-menu">
		<div class="row">
			<div class="col-md-12">
				@yield('megaMenu')
			</div>
		</div>
	</div>
	<!-- </div> -->
	<div class="container news-ticker">
		<div class="col-md-12">
			@yield('newsTicker')
		</div>
	</div>
	<div class="container main-content">
		<div class="row">
			<div class="col-md-8">
				@yield('slider')
				@yield('banners')
				@yield('boxes')

				<div class="center-content">
					<div class="col-md-8">
						@yield('allNews')
					</div>
					<div class="col-md-4">
						@yield('poll')
						@yield('twitter')
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="wide-sidebar">
					<div class="row">
						<div class="col-md-12">
							@yield('search')
							@yield('banner300')
							@yield('imageOfTheWeek')
							@yield('didYouKnow')
							@yield('facebook')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container footer">
		@yield('footer')
	</div>
	@yield('footer_script')
</body>
</html>


