@section('head')
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<link rel="icon" href="https://www.puskice.org/repo/images/favicon.ico" type="image/x-icon">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap.min.css">

<!-- Puskice CSS -->
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/puskice.css">

<!-- Yamm Megamenu http://geedmo.github.io/yamm3/ -->
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/yamm.css">

<!-- Slider: http://pgwjs.com/pgwslider/ -->
<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/pgwslider.min.css">

<link href="{{Request::root()}}/assets/frontend/css/font-awesome.min.css" rel="stylesheet">

<!-- Slick: http://kenwheeler.github.io/slick/ -->
<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/frontend/slick/slick.css"/>

<!-- Jquery 1.11.1 -->
<script src="{{Request::root()}}/assets/frontend/js/jquery.js"></script>	

<!-- Slider: http://seiyria.github.io/bootstrap-slider/ -->
<link rel="stylesheet" type="text/css" href="{{Request::root()}}/assets/frontend/slider/bootstrap-slider.css"/>
<script type="text/javascript" src="{{Request::root()}}/assets/frontend/slider/bootstrap-slider.js"></script>
<link "href=https://plus.google.com/+puskice" rel="publisher" />

@if(isset($meta)) {{$meta}} @endif

<title>{{__($title)}}</title>
<script type='text/javascript'>
	var googletag = googletag || {};
	googletag.cmd = googletag.cmd || [];
	(function() {
	var gads = document.createElement('script');
	gads.async = true;
	gads.type = 'text/javascript';
	var useSSL = 'https:' == document.location.protocol;
	gads.src = (useSSL ? 'https:' : 'http:') + 
	'//www.googletagservices.com/tag/js/gpt.js';
	var node = document.getElementsByTagName('script')[0];
	node.parentNode.insertBefore(gads, node);
	})();
</script>

<script type='text/javascript'>
	googletag.cmd.push(function() {
		googletag.defineSlot('/9396912/Puskice-728x90', [728, 90], 'div-gpt-ad-1372453927793-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/Puskice-468-60', [468, 60], 'div-gpt-ad-1372454619082-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/Puskice-1god-1poz160x60', [160, 60], 'div-gpt-ad-1377077182496-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/puskice-2god-1poz160x60', [160, 60], 'div-gpt-ad-1377077287535-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/puskice-3god-1poz160x60', [160, 60], 'div-gpt-ad-1377077349988-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/puskice-4god-1poz', [160, 60], 'div-gpt-ad-1377077423333-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/puskice-druga-desno', [160, 60], 'div-gpt-ad-1377030437246-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/Puskice-300x250', [300, 250], 'div-gpt-ad-1372454997327-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/Soliter-levo-470x1080', [470, 1080], 'div-gpt-ad-1377726727451-0').addService(googletag.pubads());
		googletag.defineSlot('/9396912/Soliter-desno-470x1080', [470, 1080], 'div-gpt-ad-1377726947400-0').addService(googletag.pubads());
		googletag.pubads().enableSingleRequest();
		googletag.enableServices();
	});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1599707-6', 'auto');
  ga('send', 'pageview');

</script>
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '731367050304281']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=731367050304281&amp;ev=PixelInitialized" /></noscript>
@stop