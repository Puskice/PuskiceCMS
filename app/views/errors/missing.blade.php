<!DOCTYPE html>
<html>
<head>
	<title>404 - Žao nam je, nešto je pogrešno ovde</title>
	<meta charset="utf-8">
	<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-1599707-6']);
		  _gaq.push(['_setDomainName', 'puskice.org']);
		  _gaq.push(['_setAllowLinker', true]);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

	</script>
</head>
<body>
	<header>
		<style>
		body {background-color:#0001ab;}
		#container{width: 450px;}
		#content{width: 60%;margin: 0 auto;}
		#generated_content{font-size: 38px;} 
		#static_content{font-size: 18px;margin-bottom: 30px;}
		#information{font-size: 13px;}
		p{margin-top: 20px;margin-bottom: 20px;}
		div{font background-size: 10px; font-family: consolas; color: #fff;}
		h1 {font-size: 80px;color:#fff;}
		</style>

		<?php $error = Errormsg::where('level', '=', 1)->orderBy(DB::raw('RAND()'))->take(1)->get(); ?>
		<?php $advices = Errormsg::where('level', '=', 2)->where('parent', '=', $error[0]->id)->orderBy(DB::raw('RAND()'))->get(); ?>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />

		<script type="text/javascript" src="jquery.js"></script>
		<script src="https://code.jquery.com/jquery-1.9.1.js"></script>

	</header>
	<body>
		<div id="containter">
			<div id="content">
				<div id="404">
					<h1>Greška 404<h1>
					</div>
					<div id="generated_content">
						{{$error[0]->message}}
					</div>

					<div id="static_content">
						@foreach($advices as $advice)
						<p>{{$advice->message}}
						</p>
						@endforeach
					</div>
					<div id="information">
						<p>Technical information</p>
						<p>***STOP: 0x{{substr(md5(rand()), 0, 8)}} (0x{{substr(md5(rand()), 0, 8)}},0x{{substr(md5(rand()), 0, 8)}},0x{{substr(md5(rand()), 0, 8)}}, 0x{{substr(md5(rand()), 0, 8)}})</p>
						<p>Beginning dump of physical memory</p>
						<p>Physical memory dump complete</p>
						<p>Ako ste pročitali sve dovde kontaktirajte Ekipu Puškica da vidimo zašto nema ove stranice. Adresa info@puskice.org </p>
					</div>
				</div>
			</div>
		</div>
	</body>
	<footer></footer>
</body>
</html>