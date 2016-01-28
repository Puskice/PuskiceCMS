<html>
<head>
	<title>Puškice anketa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<link rel="icon" href="https://www.puskice.org/repo/images/favicon.ico" type="image/x-icon">


	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap-glyphicons.css">
	<!-- Custom css -->
	<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-styles.css">
	<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-themes.css">

	<!-- Scripts -->
	<script src="{{Request::root()}}/assets/frontend/js/jquery.js"></script>	
	<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js"></script>	
	<script src="{{Request::root()}}/assets/frontend/js/survey-script.js"></script>	

	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-1599707-6', 'auto');
	ga('send', 'pageview');

	</script>
</head>
<body>	<div class="navbar">
	<div class="container">

		<a class="navbar-brand" href="/"><img src="{{Request::root()}}/assets/frontend/img/logo-beli-vodoravni.png" alt="Puskice logo"></a>
		<h2 class="navbar-text">Ocenjivanje predavača na FON-u 2015</h2>
	</div>
</div><!--end navbar-->
<header class="container">
	
</header>

<div class="container" id="main-content">
	{{ Form::open(array(null,null,'onsubmit'=> 'return validateRegistration();'))}}
	<div class="col-md-12" id="uputstvo">

		<h3>Uputstvo za popunjavanje</h3>

		<p id="uputstvoParagraf">Drage kolege, pomozite nam da ocenimo predavače! Na osnovu godine i smera koje ste izabrali, generisani su obavezni predmeti koje ste slušali u prethodnom semestru.<strong> Ocenjujete ukupan utisak o svim predavačima na pojedinačnim predmetima</strong>, jer ih je mnogo da bismo radili pojedinačne ankete.</p>

		<p> Ukoliko želite da nam kažete <strong>utisak o pojedinačnim predavačima</strong>, to možete učiniti na našem portalu izborom na <strong>"Moje mišljenje"</strong>. Sve što treba da uradite je da odete na predmet koji taj predavač drži, kliknete na karticu <strong>"Nastavno osoblje"</strong>, a potom nam date svoje mišljenje. </p>

		<p>Ukoliko niste slušali neki predmet, desno od naslova imate mogućnost da ga uklonite. <strong>NAPOMENA:</strong> Nemojte uklanjati predmete koje ste popunili, jer u tom slučaju, neće se proslediti odgovori na te predmete.</p>

		<p>	Molimo vas da budete realni i iskreno date odgovore na sva pitanja. HVALA!</p>

		<p id="ekipa">Vaša Ekipa Puškica</p>



	</div> <!--end objasnjenje ankete col md 12-->

	<div class="col-sm-3 col-sm-offset-3 front-pitanje">
		<p class="pitanje">Koja si godina?</p>
		<div class="odgovoriAngazman">
			<div class="ocena btn-group">
				<label >
					<input type="radio" id="q011" name="godina" value="1" /> Prva
				</label> 
				<label >
					<input type="radio" id="q012" name="godina" value="2" /> Druga
				</label> 
				<label >
					<input type="radio" id="q013" name="godina" value="3" /> Treća
				</label> 
				<label >
					<input type="radio" id="q014" name="godina" value="4" /> Četvrta/Apsolvent
				</label> 

			</div><!--end btn group-->
		</div><!--end pitanje za angazman-->
	</div>

	<div class="col-sm-6 front-pitanje">
		<p class="pitanje">Koji si smer</p>
		<div class="odgovoriAngazman">
			<div class="ocena btn-group" >
				<label >
					<input type="radio" id="q021" name="smer" value="1" /> Prva godina - Menadžment
				</label> 
				<label >
					<input type="radio" id="q021" name="smer" value="2" /> Prva godina - ISIT
				</label> 
				<label >
					<input type="radio" id="q022" name="smer" value="3" /> ISIT
				</label> 
				<label >
					<input type="radio" id="q023" name="smer" value="4" /> Menadžment
				</label> 
				<label >
					<input type="radio" id="q024" name="smer" value="5" /> Operacioni menadžment
				</label> 
				<label >
					<input type="radio" id="q025" name="smer" value="6" /> Upravljanje kvalitetom
				</label> 

			</div><!--end btn group-->
		</div><!--end pitanje za angazman-->
	</div>

	




	<div class="col-xs-12">
		<button type="submit" class="btn btn-primary submit-btn center-block">Nastavi<span class="glyphicon glyphicon-arrow-right pull-right" aria-hidden="true"></span></button>
		<div class="alert alert-danger" id="error-subm" role="alert"></div>
	</div>


	<!-- </form> -->
	{{Form::close()}}
	<!-- <div class="alert alert-danger" id="error-subm" role="alert"></div> -->
</div>

<footer>
	<p class="futer"> <strong> Powered by <a href="http://www.puskice.org">www.puskice.org</a></strong></p>
</footer>
</body>
</html>