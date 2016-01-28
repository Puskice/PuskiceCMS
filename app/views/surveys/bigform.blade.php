<!DOCTYPE html>



<html>

<head>

	<head>

		<title>Puškice anketa</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">



		<link rel="icon" href="https://www.puskice.org/repo/images/favicon.ico" type="image/x-icon">





		<!-- Bootstrap -->

		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap.min.css">

		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/bootstrap-glyphicons.css">





		<!-- Custom css	-->

		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-styles.css">

		<link rel="stylesheet" href="{{Request::root()}}/assets/frontend/css/survey-themes.css">



		<!-- Scripts-->

		<script src="{{Request::root()}}/assets/frontend/js/jquery.js"></script>	

		<script src="{{Request::root()}}/assets/frontend/js/bootstrap.min.js"></script>	

		<script src="{{Request::root()}}/assets/frontend/js/survey-script.js"></script>	





	<!-- {{ HTML::style('includes/css/bootstrap.min.css'); }}

	{{ HTML::style('includes/css/bootstrap-glyphicons.css'); }}

	{{ HTML::style('includes/css/survey-styles.css'); }}

	{{ HTML::style('includes/css/survey-themes.css'); }}

	// <script src="http://code.jquery.com/jquery.js"></script>

	{{ HTML::script('bootstrap/js/jquery-1.11.1.min.js'); }}

	{{ HTML::script('bootstrap/js/bootstrap.min.js'); }}

	{{ HTML::script('includes/js/survey-script.js'); }}	 -->


	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-1599707-6', 'auto');
	ga('send', 'pageview');

	</script>
</head>

<body>

	<div class="navbar">

		<div class="">

			<a class="navbar-brand" href="/"><img src="{{Request::root()}}/assets/frontend/img/logo-beli-vodoravni.png" alt="Puskice logo"></a>

			<h2 class="navbar-text">Ocenjivanje predavača na FON-u 2015</h2>

		</div>

	</div><!--end navbar-->



	<div class="container" id="main">



		<div class="col-md-12" id="uputstvo">

			<h3>Uputstvo za popunjavanje</h3>

			<p id="uputstvoParagraf">Drage kolege, pomozite nam da ocenimo predavače! Na osnovu godine i smera koje ste izabrali, generisani su obavezni predmeti koje ste slušali u prethodnom semestru.<strong> Ocenjujete ukupan utisak o svim predavačima na pojedinačnim predmetima</strong>, jer ih je mnogo da bismo radili pojedinačne ankete.</p>

			<p> Ukoliko želite da nam kažete <strong>utisak o pojedinačnim predavačima</strong>, to možete učiniti na našem portalu izborom na <strong>"Moje mišljenje"</strong>. Sve što treba da uradite je da odete na predmet koji taj predavač drži, kliknete na karticu <strong>"Nastavno osoblje"</strong>, a potom nam date svoje mišljenje. </p>

			<p>Ukoliko niste slušali neki predmet, desno od naslova imate mogućnost da ga uklonite. <strong>NAPOMENA:</strong> Nemojte uklanjati predmete koje ste popunili, jer u tom slučaju, neće se proslediti odgovori na te predmete.</p>

			<p>	Molimo vas da budete realni i iskreno date odgovore na sva pitanja. HVALA!</p>

			<p id="ekipa">Vaša Ekipa Puškica</p>



		</div> <!--end objasnjenje ankete col md 12-->



		{{ Form::open(array('route'=>'bigform',null,'id'=>'bigf')) }}

		<!-- hidden field for department -->

		<input name="department" type="hidden" value="{{$department}}">

		<input name="semester" type="hidden" value="{{$semester}}">



		<?php  $index = 0;

		?>



		@foreach ($predmeti as $predmet)

		

		<?php $index+=1;?>



		<div class="col-md-12 predmet{{ $index }}">





			<div class="panel panel-primary">

				<div class="panel-heading">

					<h3 class="panel-title col-xs-12">{{$predmet->title}} <span id="close{{$predmet->id}}" class="pull-right glyphicon glyphicon-remove show-hide-target" aria-hidden="true"></span></h3> 

					<p class="spisak-predavaca">&nbsp;<span class="pull-right">Ukloni/Prikaži predmet</span></p>



				</div><!--end div heading-->

				<div class="panel-body">



					<div class="nastavneMetode">

						<div class="zaglavlje">

							<h3 class="podele">Nastavne metode</h3>

						</div><!--end zaglavlje-->



						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][1]">1. Profesori/Asistenti dolaze na predavanja pripremljen i na taj način olakšava učenje<span class="pull-right" id="ans_{{$predmet->id}}_1"></span></p>



							<!-- <p class="neSlazem"><span class="glyphicon glyphicon-arrow-down td-arrow" aria-hidden="true"></span> Uopšte se ne slažem</p> -->



							<div class="odgovor btn-group" >
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="1" /> Uopšte se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="2" /> Delimično se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="3" /> Niti se slažem, niti se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="4" /> Delimično se slažem

								</label>
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="5" /> U potpunosti se slažem
								</label> 
<!-- 
								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="1" /> 1

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="2" /> 2

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="3" /> 3

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="4" /> 4

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][1]" value="5" /> 5

								</label>  -->



							</div><!--end btn group-->



							<!-- <p class="slazem">U potpunosti se slažem <span class="glyphicon glyphicon-arrow-up td-arrow" aria-hidden="true"></span></p> -->



						</div><!--end div pitanje-->

						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][2]">2. Profesori/Asistenti podstiču studente da razmišljaju i učestvuju u diskusiji<span class="pull-right" id="ans_{{$predmet->id}}_2"></span></p>

							<!-- <p class="neSlazem"><span class="glyphicon glyphicon-arrow-down td-arrow" aria-hidden="true"></span> Uopšte se ne slažem</p> -->

							<div class="odgovor btn-group" >

								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="1" /> Uopšte se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="2" /> Delimično se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="3" /> Niti se slažem, niti se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="4" /> Delimično se slažem

								</label>
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="5" /> U potpunosti se slažem
								</label> 
<!-- 
								<label class=" btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="1" /> 1

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][2]" value="2" /> 2

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="3" /> 3

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="4" /> 4

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][2]" value="5" /> 5

								</label>  -->

							</div><!--end btn group-->

							<!-- <p class="slazem">U potpunosti se slažem <span class="glyphicon glyphicon-arrow-up td-arrow" aria-hidden="true"></span></p> -->

						</div><!--end div pitanje-->

					</div> <!--end nastavne metode-->

					<hr>



					<div class="angazman">

						<div class="zaglavlje">

							<h3>Angažman studenata</h3>

						</div><!--end div zaglavlje-->

						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][3]">3. Na vežbe i predavanja:<span class="pull-right" id="ans_{{$predmet->id}}_3"></span></p>

							<div class="odgovoriAngazman">

								<div class="ocena btn-group">

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][3]" value="1" /> Nisam dolazio (0-20% posete)

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][3]" value="2" /> Uglavnom nisam dolazio (21-40% posete)

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][3]" value="3" /> Povremeno sam dolazio (41- 60% posete)

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][3]" value="4" /> Uglavnom sam dolazio (61- 80% posete)

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][3]" value="5" /> Skoro uvek sam dolazio (81- 100% posete)

									</label> 

								</div><!--end btn group-->

							</div><!--end pitanje za angazman-->

						</div><!--end pitanje-->

						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][4]">4. Koliko si dana spremao ispit:<span class="pull-right" id="ans_{{$predmet->id}}_4"></span></p>

							<div class="odgovoriAngazman">

								<div class="ocena btn-group">

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][4]" value="1" /> Nisam spremao

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][4]" value="2" /> Do nedelju dana

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][4]" value="3" /> Do 2 nedelje

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][4]" value="4" /> Mesec dana

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][4]" value="5" /> Više od mesec dana

									</label> 

								</div><!--end btn group-->



							</div><!--end pitanja odgovoriAngazman-->

						</div><!--end divPitanje-->



						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][5]">5. Dolazio/la sam na predavanja pripremeljen/a i učestvovao/la sam u diskusiji<span class="pull-right" id="ans_{{$predmet->id}}_5"></span></p>

							<div class="odgovoriAngazman">

								<div class="ocena btn-group">

									<label >
										<input type="radio"  name="ans[{{$predmet->id}}][5]" value="1" /> Nisam dolazio  na predavanja
									</label> 
									<label >
										<input type="radio"  name="ans[{{$predmet->id}}][5]" value="2" /> Dolazio sam na predavanja, nepripremljen, nisam učestvovao u diskusiji
									</label> 
									<label >
										<input type="radio"  name="ans[{{$predmet->id}}][5]" value="3" /> Dolazio sam na predavanja, znao sam o materiji, ali nisam učestvovao u diskusiji
									</label> 
									<label >
										<input type="radio"  name="ans[{{$predmet->id}}][5]" value="4" /> Dolazio sam na predavanja nepripremljen, ali sam učestvovao u diskusiji
									</label>
									<label >
										<input type="radio"  name="ans[{{$predmet->id}}][5]" value="5" /> Dolazio sam na predavanja pripremljen i učestvovao sam u diskusiji
									</label> 

								</div><!--end btn group-->

							</div><!--end pitanje za angazman-->

						</div><!--end divPitanje-->



						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][6]">6. Pripremao sam ovaj ispit da bih:<span class="pull-right" id="ans_{{$predmet->id}}_6"></span></p>

							<div class="odgovoriAngazman">

								<div class="ocena btn-group">

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][6]" value="1" /> Samo da bih položio ispit

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][6]" value="2" /> Jer me interesuje tematika, ali naravno i da bih položio ispit

									</label> 

								</div><!--end btn group-->

							</div><!--end pitanje za angazman-->

						</div><!--end divPitanje-->

					</div><!--end sekcije angazman-->

					<hr>



					<div class="odnos">

						<div class="zaglavlje">

							<h3>Odnos profesora i studenta</h3>

						</div><!--end zaglavlje-->

						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][7]">7. Profesori/asistenti se odnose prema studentu:<span class="pull-right" id="ans_{{$predmet->id}}_7"></span></p>

							<div class="odgovoriAngazman">

								<div class="ocena btn-group">

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][7]" value="1" /> Svi profesori se ophode prema studentima sa poštovanjem i uvažavanjem

									</label> 

									<label>



										<input type="radio"  name="ans[{{$predmet->id}}][7]" value="2" /> Većina profesora se ophodi prema studentima sa poštovanjem i uvažavanjem

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][7]" value="3" /> Većina profesora ulazi u konflikte sa studentima

									</label> 

									<label >

										<input type="radio"  name="ans[{{$predmet->id}}][7]" value="4" /> Svi profesori ulaze u konflikte sa studentima

									</label> 

								</div><!--end btn group-->

							</div><!--end pitanje za angazman-->

						</div><!--end divPitanje-->



						<div class="divPitannje">

							<p class="pitanje" id="ans[{{$predmet->id}}][8]">8. Profesorima je stalo do studenata i aktivno se zalažu za studentski standard<span class="pull-right" id="ans_{{$predmet->id}}_8"></span></p>

							<!-- <p class="neSlazem"><span class="glyphicon glyphicon-arrow-down td-arrow" aria-hidden="true"></span> Uopšte se ne slažem</p> -->

							<div class="odgovor btn-group" >
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][8]" value="1" /> Uopšte se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][8]" value="2" /> Delimično se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][8]" value="3" /> Niti se slažem, niti se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][8]" value="4" /> Delimično se slažem

								</label>
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][8]" value="5" /> U potpunosti se slažem
								</label> 
								<!-- <label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][8]" value="1" /> 1

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][8]" value="2" /> 2

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][8]" value="3" /> 3

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][8]" value="4" /> 4

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][8]" value="5" /> 5

								</label>  -->

							</div><!--end btn group-->

							<!-- <p class="slazem">U potpunosti se slažem <span class="glyphicon glyphicon-arrow-up td-arrow" aria-hidden="true"></span></p> -->

						</div><!--end divPitanje-->

					</div><!--end odnos-->



					<hr>



					<div class="evaluacija">

						<div class="zaglavlje">

							<h3>Evaluacija nastavnog materijala predmeta</h3>

						</div><!--end zaglavlje-->

						<div class="divPitanje">



							<p class="pitanje" id="ans[{{$predmet->id}}][9]">9. Ocena sa kolokvijuma i ispita oslikava moje znanje<span class="pull-right" id="ans_{{$predmet->id}}_9"></span></p>



							<!-- <p class="neSlazem"><span class="glyphicon glyphicon-arrow-down td-arrow" aria-hidden="true"></span> Uopšte se ne slažem</p> -->

							<div class="odgovor btn-group" >
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="0" /> Nisam položio
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="1" /> Uopšte se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="2" /> Delimično se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="3" /> Niti se slažem, niti se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="4" /> Delimično se slažem

								</label>
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][9]" value="5" /> U potpunosti se slažem
								</label> 
							<!-- 	<label class="btn btn-primary" style="font-size:10px; padding-top:2px; padding-bottom:2px;">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="0" /> Nisam<br/>položio

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="1" /> 1

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="2" /> 2

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="3" /> 3

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="4" /> 4

								</label> 

								<label class="btn btn-primary">

									<input type="radio" name="ans[{{$predmet->id}}][9]" value="5" /> 5

								</label> --> 



							</div><!--end btn group-->

							<!-- <p class="slazem">U potpunosti se slažem <span class="glyphicon glyphicon-arrow-up td-arrow" aria-hidden="true"></span></p> -->

						</div><!--end div pitanje-->



						<div class="divPitanje">

							<p class="pitanje" id="ans[{{$predmet->id}}][10]"> 10. Profesori/asistenti imaju jasne i jednake kriterijume za ocenjivanje i dosledno ih primenjuju<span class="pull-right" id="ans_{{$predmet->id}}_10"></span></p>

							<!-- <p class="neSlazem"><span class="glyphicon glyphicon-arrow-down td-arrow" aria-hidden="true"></span> Uopšte se ne slažem</p> -->

							<div class="odgovor btn-group" >
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="1" /> Uopšte se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="2" /> Delimično se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="3" /> Niti se slažem, niti se ne slažem
								</label> 
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="4" /> Delimično se slažem

								</label>
								<label >
									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="5" /> U potpunosti se slažem
								</label> 

								<!-- <label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="1" /> 1

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="2" /> 2

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="3" /> 3

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="4" /> 4

								</label> 

								<label class="btn btn-primary">

									<input type="radio"  name="ans[{{$predmet->id}}][10]" value="5" /> 5

								</label>  -->

							</div><!--end btn group-->

							<!-- <p class="slazem">U potpunosti se slažem <span class="glyphicon glyphicon-arrow-up td-arrow" aria-hidden="true"></span></p> -->



						</div><!--end divPitanje-->



					</div><!--end evaluacija-->

				</div><!--end pannel body-->

			</div><!--end panel -->











		</div><!--end col sm 12 predmet-->

		@endforeach







		<div class="col-sm-12">
			<button type="button" class="btn btn-primary btn-lg btn-block" id="kraj">Kraj!</button>

		</div>
		



		{{Form::close()}}





	</div><!--end container-->



	<footer>

		<p class="futer"> <strong> Powered by <a href="http://www.puskice.org">www.puskice.org</a></strong></p>



	</footer>


	<!-- Modal ajax message -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background: rgba(2,2,2,0.75);">
		<div class="modal-dialog transp-modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="height:50px;">
					<button type="button" class="close pull-right primary" data-dismiss="modal" aria-label="Close" style="color:darkred; font-size:40px;"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body" id="modal-text" style="overflow:hidden;">
					<div id="spinner" class="center-block" style=" width:180px; height:auto;">
						<img src="{{Request::root()}}/assets/frontend/img/puskice.gif" alt="Puskice logo" style="width:100%; height:auto;">
					</div>
					<div class="col-sm-12" id="modal-message" style="height:450px; overflow-y:auto;">
						Provera podataka u toku...
					</div>
				</div>
			</div>
		</div>
	</div>


</body>

</html>



