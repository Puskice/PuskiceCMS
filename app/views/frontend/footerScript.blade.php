@section('footer_script')

<!-- Custom compiled bootstrap -->
<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js"></script>

<!-- Ticker: http://www.aakashweb.com/demos/jquery-easy-ticker/index.php -->
<script src="{{Request::root()}}/assets/frontend/js/jquery.easy-ticker.min.js"></script>

<!-- Slider: http://pgwjs.com/pgwslider/ -->
<script src="{{Request::root()}}/assets/frontend/js/pgwslider.min.js"></script>

<!-- Slick: http://kenwheeler.github.io/slick/ -->
<script type="text/javascript" src="{{Request::root()}}/assets/frontend/slick/slick.min.js"></script>

<script src="{{Request::root()}}/assets/frontend/js/puskice.js"></script>

<script type="text/javascript">
	$(function() {
	  $('#ticker').easyTicker({
		direction: 'up',
		easing: 'swing',
		speed: 'slow',
		interval: 2000,
		height: 'auto',
		visible: 1,
		mousePause: 1,
		controls: {
			up: 'Gore',
			down: 'Dole',
			toggle: '',
			playText: 'Play',
			stopText: 'Stop'
		}
		});
	});
</script>
@stop