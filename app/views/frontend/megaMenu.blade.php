@section('megaMenu')
<div class="navbar navbar-default yamm">
	<div class="navbar-header">
    	<button type="button" data-toggle="collapse" data-target="#navbar-collapse-2" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
  	</div>
  	<div id="navbar-collapse-2" class="navbar-collapse collapse">
    	<ul class="nav navbar-nav">
      		<li class="dropdown yamm-fw">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Прва")}}<b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<li>
	               		<div class="yamm-content">
		                    <div class="row">
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Информациони системи и технологије")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/prva/zajednicke-osnove/ekonomija">{{__("Економија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/matematika-1">{{__("Математика 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/matematika-2">{{__("Математика 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/menadzment">{{__("Менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/osnove-informaciono-komunikacionih-tehnologija">{{__("Основе информационо комуникационих технологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/sociologija">{{__("Социологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/psihologija">{{__("Психологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/strani-jezik-1">{{__("Страни језик 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/strani-jezik-2">{{__("Страни језик 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/osnovi-organizacije">{{__("Основи организације")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/proizvodni-sistemi">{{__("Производни системи")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/uvod-u-informacione-sisteme">{{__("Увод у информационе системе")}}</a></li> <!-- Fali programiranje 1 -->
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/prva/zajednicke-osnove/ekonomija">{{__("Економија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/matematika-1">{{__("Математика 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/matematika-2">{{__("Математика 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/menadzment">{{__("Менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/osnove-informaciono-komunikacionih-tehnologija">{{__("Основе информационо комуникационих технологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/sociologija">{{__("Социологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/psihologija">{{__("Психологија")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/strani-jezik-1">{{__("Страни језик 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/strani-jezik-2">{{__("Страни језик 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/osnovi-organizacije">{{__("Основи организације")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/proizvodni-sistemi">{{__("Производни системи")}}</a></li>
					                    <li><a href="{{Request::root()}}/prva/zajednicke-osnove/uvod-u-informacione-sisteme">{{__("Увод у информационе системе")}}</a></li>
		                      	</ul>
		                     		                      	
		                    </div>
		                </div>
	           		</li>
	         	</ul>
	        </li>
	        <li class="dropdown yamm-fw">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Друга")}}<b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<li>
	               		<div class="yamm-content">
		                    <div class="row">
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Информациони системи и технологије")}}</strong></p>
			                        </li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/arhitektura-racunara-i-operativni-sistemi">{{__("Архитектура рачунара и оперативни системи")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/diskretne-matematicke-strukture">{{__("Дискретне математичке структуре")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/finansijski-menadzment-i-racunovodstvo">{{__("Финансијски менаџмент и рачуноводство")}}</a></li>
									<li><a href="{{Request::root()}}/druga/menadzment/marketing">{{__("Маркетинг")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/matematika-3">{{__("Математика 3")}}</a></li>
									<li><a href="{{Request::root()}}/druga/menadzment/menadzment-tehnologije-i-razvoja">{{__("Менаџмент технологије и развоја")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/numericka-analiza">{{__("Нумеричка анализа")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/principi-programiranja">{{__("Принципи програмирања")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/statistika">{{__("Статистика")}}</a></li>
									<li><a href="{{Request::root()}}/druga/zajednicke-osnove/strani-jezik-3">{{__("Страни језик 3")}}</a></li>
									<li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/strukture-podataka-i-algoritmi">{{__("Структуре података и алгоритми")}}</a></li>
									<li><a href="{{Request::root()}}/druga/zajednicke-osnove/teorija-verovatnoce">{{__("Теорија вероватноће")}}</a></li>
		                      	</ul>
		                     	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/druga/menadzment/ekonomika-poslovanja-i-planiranje">{{__("Економика пословања и планирање")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/finansijski-menadzment">{{__("Финансијски менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/marketing">{{__("Маркетинг")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-ljudskih-resursa">{{__("Менаџмент људских ресурса")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-tehnologije-i-razvoja">{{__("Менаџмент технологије и развоја")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/racunovodstvo/">{{__("Рачуноводство")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/statistika">{{__("Статистика")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/strani-jezik-3">{{__("Страни језик 3")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/teorija-verovatnoce">{{__("Теорија вероватноће")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/upravljanje-kvalitetom/">{{__("Управљање квалитетом")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/upravljanje-troskovima/">{{__("Управљање трошковима")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Операциони менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/druga/menadzment/ekonomika-poslovanja-i-planiranje">{{__("Економика пословања и планирање")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/finansijski-menadzment-i-racunovodstvo">{{__("Финансијски менаџмент и рачуноводство")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/marketing">{{__("Маркетинг")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/matematika-3">{{__("Математика 3")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-ljudskih-resursa">{{__("Менаџмент људских ресурса")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-tehnologije-i-razvoja">{{__("Менаџмент технологије и развоја")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/operacioni-menadzment/osnove-industrijskog-inzenjerstva">{{__("Основе индустријског инжењерства")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/statistika">{{__("Статистика")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/strani-jezik-3">{{__("Страни језик 3")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/teorija-verovatnoce">{{__("Теорија вероватноће")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/upravljanje-kvalitetom/">{{__("Управљање квалитетом")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент квалитета и стандардизација")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/finansijski-menadzment-i-racunovodstvo">{{__("Финансијски менаџмент и рачуноводство")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/inzenjering-procesa">{{__("Инжењеринг процеса")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/marketing">{{__("Маркетинг")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-ljudskih-resursa">{{__("Менаџмент људских ресурса")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/operacioni-menadzment/osnove-industrijskog-inzenjerstva">{{__("Основе индустријског инжењерства")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/osnove-kvaliteta">{{__("Основе квалитета")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-tehnologije-i-razvoja">{{__("Менаџмент технологије и развоја")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/informacioni-sistemi-i-tehnologije/statistika">{{__("Статистика")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/strani-jezik-3">{{__("Страни језик 3")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/zajednicke-osnove/teorija-verovatnoce">{{__("Теорија вероватноће")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/upravljanje-kvalitetom/">{{__("Управљање квалитетом")}}</a></li>
		                      	</ul>
		                      	
		                    </div>
		                </div>
	           		</li>
	         	</ul>
	        </li>
	        <li class="dropdown yamm-fw">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Трећа")}}<b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<li>
	               		<div class="yamm-content">
		                    <div class="row">
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Информациони системи и технологије")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/baze-podataka">{{__("Базе података")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/elektronsko-poslovanje">{{__("Електронско пословање")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/linearni-statisticki-modeli">{{__("Линеарни статистички модели")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-ljudskih-resursa">{{__("Менаџмент људских ресурса")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/modelovanje-poslovnih-procesa">{{__("Моделовање пословних процеса")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-1">{{__("Операциона истраживања 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-2">{{__("Операциона истраживања 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/pravne-osnove-informacionih-sistema">{{__("Правне основе информационих система")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/programski-jezici">{{__("Програмски језици")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/racunarske-mreze-i-telekomunikacije">{{__("Рачунарске мреже и телекомуникације")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/teorija-odlucivanja">{{__("Теорија одлучивања")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/teorija-sistema">{{__("Теорија система")}}</a></li>
		                      	</ul>
		                     	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/treca/menadzment/ekoloski-menadzment">{{__("Еколошки менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/ekonometrijske-metode">{{__("Економетријске методе")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/elektronsko-poslovanje">{{__("Електронско пословање")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/integrisana-softverska-resenja">{{__("Интегрисана софтверска решења")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/odnosi-sa-javnoscu">{{__("Односи са јавношћу")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-1">{{__("Операциона истраживања 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-2">{{__("Операциона истраживања 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/simulacija-u-poslovnom-odlucivanju">{{__("Симулација у пословном одлучивању")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/strateski-marketing">{{__("Стратешки маркетинг")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/teorija-odlucivanja">{{__("Теорија одлучивања")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/upravljacko-racunovodstvo">{{__("Управљачко рачуноводство")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/upravljanje-investicijama">{{__("Управљање инвестицијама")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/upravljanje-projektima">{{__("Управљање пројектима")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/upravljanje-promenama">{{__("Управљање променама")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Операциони менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/treca/menadzment/ekoloski-menadzment">{{__("Еколошки менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/kontrola-kvaliteta">{{__("Контрола квалитета")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/logistika">{{__("Логистика")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/lokacija-i-raspored-objekata">{{__("Локација и распоред објеката")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/menadzment-inovacija">{{__("Менаџмент иновација")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-1">{{__("Операциона истраживања 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-2">{{__("Операциона истраживања 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/osnove-programiranja-1">{{__("Основе програмирања")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/teorija-odlucivanja">{{__("Теорија одлучивања")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/upravljacki-sistemi">{{__("Управљачки системи")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/menadzment/upravljanje-projektima">{{__("Управљање пројектима")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент квалитета и стандардизација")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/inzenjerske-komunikacije-i-logistika">{{__("Инжењерске комуникације и логистика")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/kontrola-kvaliteta">{{__("Контрола квалитета")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-ljudskih-resursa">{{__("Менаџмент људских ресурса")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/menadzment/menadzment-tehnologije-i-razvoja">{{__("Менаџмент технологије и развоја")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/metroloski-sistem">{{__("Метролошки систем")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/normativno-regulisanje-kvaliteta">{{__("Нормативно регулисање квалитета")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-1">{{__("Операциона истраживања 1")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/operacioni-menadzment/operaciona-istrazivanja-2">{{__("Операциона истраживања 2")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/sistem-kvaliteta">{{__("Систем квалитета")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/standardizacija">{{__("Стандардизација")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/informacioni-sistemi-i-tehnologije/teorija-odlucivanja">{{__("Теорија одлучивања")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/tehnologija-upravljanja-kvalitetom">{{__("Технологија управљања квалитетом")}}</a></li>
					                    <li><a href="{{Request::root()}}/treca/upravljanje-kvalitetom/upravljanje-kvalitetom-dokumentacije">{{__("Управљање квалитетом документације")}}</a></li>
		                      	</ul>
		                      	
		                    </div>
		                </div>
	           		</li>
	         	</ul>
	        </li>
	        <li class="dropdown yamm-fw">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Четврта")}}<b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<li>
	               		<div class="yamm-content">
		                    <div class="row">
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Информациони системи и технологије")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/projektovanje-informacionih-sistema">{{__("Пројектовање информационих система")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/internet-tehnologije">{{__("Интернет технологије")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/simulacija-i-simulacioni-jezici">{{__("Симулација и симулациони језици")}}</a></li>
					                    <li><a href="{{Request::root()}}/druga/upravljanje-kvalitetom/upravljanje-kvalitetom">{{__("Управљање квалитетом")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/projektovanje-softvera">{{__("Пројектовање софтвера")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/inteligentni-sistemi">{{__("Интелигентни системи")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/informacioni-sistemi-i-tehnologije/izborni-predmeti-isit">{{__("Изборни предмети ИСИТ")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/zajednicke-osnove/zavrsni-rad">{{__("Завршни рад")}}</a></li>
		                      	</ul>
		                     	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/cetvrta/menadzment/poslovno-pravo">{{__("Пословно право")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/finansijska-trzista">{{__("Финансијска тржишта")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/informacioni-sistemi-za-podrsku-menadzmentu">{{__("Информациони системи за подршку менаџменту")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/medjunarodni-menadzment">{{__("Међународни менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/strateski-menadzment">{{__("Стратешки менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/projektovanje-organizacije">{{__("Пројектовање организације")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/menadzment/izborni-predmeti-men">{{__("Изборни предмети менаџмент")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/zajednicke-osnove/zavrsni-rad">{{__("Завршни рад")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Операциони менаџмент")}}</strong></p>
			                        </li>
				                        <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/informacioni-sistemi-proizvodnje">{{__("Информациони системи производње")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/planiranje-proizvodnje-i-usluga">{{__("Планирање производње и услуга")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/racunarski-integrisana-proizvodnja">{{__("Рачунарски интегрисана производња")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/menadzment-proizvodnje-i-usluga">{{__("Менаџмент производње и услуга")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/projektovanje-proizvodnih-sistema">{{__("Пројектовање производних система")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/operacioni-menadzment/izborni-predmeti-om">{{__("Изборни предмети ОМ")}}</a></li>
					                    <li><a href="{{Request::root()}}/cetvrta/zajednicke-osnove/zavrsni-rad">{{__("Завршни рад")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Менаџмент квалитета и стандардизација")}}</strong></p>
			                        </li>
					                        <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/inzenjering-kvaliteta">{{__("Инжењеринг квалитета")}}</a></li>
						                    <li><a href="{{Request::root()}}/treca/menadzment/upravljanje-projektima">{{__("Управљање пројектима")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/poslovni-informacioni-sistemi">{{__("Пословни информациони системи")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/metode-i-tehnike-upravljanja-kvalitetom">{{__("Методе и технике управљања")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/sistemi-kvaliteta-zivotne-sredine">{{__("Системи квалитета животне средине")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/sistem-zastite-na-radu">{{__("Систем заштите на раду")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/menadzment/projektovanje-organizacije">{{__("Пројектовање организације")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/ocena-kvaliteta-poslovnog-sistema">{{__("Оцена квалитета пословног система")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/upravljanje-kvalitetom/izborni-predmeti-uk">{{__("Изборни предмети УК")}}</a></li>
						                    <li><a href="{{Request::root()}}/cetvrta/zajednicke-osnove/zavrsni-rad">{{__("Завршни рад")}}</a></li>
		                      	</ul>
		                      	
		                    </div>
		                </div>
	           		</li>
	         	</ul>
	        </li>
	        <li class="dropdown yamm-fw">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{__("Факултет")}}<b class="caret"></b></a>
	        	<ul class="dropdown-menu">
	        		<li>
	               		<div class="yamm-content">
		                    <div class="row">
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Важне информације")}}</strong></p> 
			                        </li>
			                        <li><a href="{{Request::root()}}/stranica/fakultet-organizacionih-nauka">{{__("Факултет организационих наука")}}</a></li>
			                        <li><a href="{{Request::root()}}/stranica/brojevi-lokala-fakulteta-organizacionih-nauka">{{__("Бројеви локала")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/studentska-sluzba-potrebna-dokumenta">{{__("Потребна документа")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/termini-konsultacija">{{__("Термини консултација")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/cenovnik-usluga">{{__("Ценовник услуга")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/upis-i-obnova-godine">{{__("Упис и обнова године")}}</a></li>
		                      	</ul>
		                     	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Студентске организације")}}</strong></p>
			                        </li>
			                        <li><a href="{{Request::root()}}/stranica/fonis">{{__("ФОНИС")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/sportfon">{{__("СпортФОН")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/aiesec">{{__("АИЕСЕЦ")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/savez-studenata">{{__("Савез студената")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/estiem">{{__("ЕСТИЕМ")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/centar-za-razvoj-karijere">{{__("Центар за развој каријере")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/ekofon">{{__("ЕкоФОН")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>{{__("Стипендије")}}</strong></p>
			                        </li>
			                        <li><a href="{{Request::root()}}/stranica/stipendija-republicke-fondacije-za-razvoj-naucnog-i-umetnickog-podmlatka">{{__("Стипендија Републичке фондације за развој научног и уметничког подмлатка")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/studentski-kredit-ministarstva-prosvete">{{__("Студентски кредит Министарства просвете")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/studentska-stipendija-ministarstva-prosvete">{{__("Студентска стипендија Министарства просвете")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/stipendija-srpskog-poslovnog-kluba-privrednika">{{__("Стипендија српског пословног клуба „Привредник“")}}</a></li>
		                      	</ul>
		                      	<ul class="col-sm-3 list-unstyled">
			                        <li>
			                          <p><strong>&nbsp;</strong></p>
			                        </li>
			                      	<li><a href="{{Request::root()}}/stranica/stipendija-zaduzbine-studenica">{{__("Стипендија задужбине Студеница")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/eurobank-efg-skolarina">{{__("Еуробанк ЕФГ Школарина")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/Coca-cola-talenti">{{__("Coca-cola Таленти")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/stipendija-fonda-srpske-narodne-odbrane-u-americi-mihailo-pupin">{{__("Стипендија Фондa српске народне одбране у Америци “Михаило Пупин”")}}</a></li>
	                				<li><a href="{{Request::root()}}/stranica/projekat-budi-vip-student">{{__("Пројекат Буди Вип студент")}}</a></li>
		                      	</ul>
		                    </div>
		                </div>
	           		</li>
	         	</ul>
	        </li>
	        <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{__("Пријатељи")}}<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
	                <li><a href="{{Request::root()}}/stranica/kontekst">{{__("Kontext школа страних језика")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/fotokopirnica-star">{{__("Фотокопирница Стар")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/kisobran-organizacija">{{__("Кишобран организација")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/streljacki-klub-target">{{__("Стрељачки клуб Таргет")}}</a></li>
	                <li><a href="{{Request::root()}}/dom-kulture-studentski-grad">{{__("Дом културе Студентски град")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/bioskop-fontana">{{__("Биоскоп Фонтана")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/pokret-za-okupaciju-bioskopa">{{__("Биоскоп Звезда")}}</a></li>
	                <li><a href="http://edukacija.rs/">{{__("Портал \"Едукација\"")}}</a></li>
	                <li><a href="{{Request::root()}}/vest/19022015/mikser-house?l=lat">{{__("Mikser House")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/agencija-student-adventures?l=cyr">{{__("Агенција Student Adventures")}}</a></li>
	            </ul>
          	</li>
          	<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{__("Меме")}}<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
	                <li><a href="{{Request::root()}}/memes">{{__("Сви постери")}}</a></li>
	                <li><a href="{{Request::root()}}/memes/new">{{__("Направи свој меме")}}</a></li>
	                <li><a href="javascript:void(0);">{{__("Предложи нови лик - Ускоро!")}}</a></li>
	            </ul>
          	</li>
          	<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{__("Категорије")}}<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
	                <!-- Sta da radimo s ovim? -->
	                <li><a href="{{Request::root()}}/medjunarodne-prilike-by-aiesec">{{__("Међународне прилике by AИЕСЕЦ")}}</a></li>
	                <li><a href="{{Request::root()}}/gde-su-sta-rade">{{__("Где су, шта раде?")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/vremeplov">{{__("Времеплов")}}</a></li>
	                <li><a href="{{Request::root()}}/novi-clanovi">{{__("Пријава за нове чланове")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/posaljite-materijal">{{__("Пошаљите материјал")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/linkovi">{{__("Корисни линкови")}}</a></li>
	                <li><a href="{{Request::root()}}/konverzija">{{__("Конверзија - ћирилица/латиница")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/uslovi-koriscenja">{{__("Услови коришћења")}}</a></li>
	                <li><a href="{{Request::root()}}/daljinac">{{__("Даљинац")}}</a></li>
	            </ul>
          	</li>
          	<!-- <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{__("Резултати")}}<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
	                <li><a tabindex="-1" href="#"> Prva godina </a></li>
	                <li><a tabindex="-1" href="#"> Druga godina </a></li>
	                <li><a tabindex="-1" href="#"> Treca godina </a></li>
	                <li><a tabindex="-1" href="#"> Cetvrta godina </a></li>
	                <li class="divider"></li>
	                <li><a tabindex="-1" href="#"> Svi rezultati </a></li>
	            </ul>
          	</li> -->
    	</ul>
    	<ul class="nav navbar-nav navbar-right">
      		<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">{{__("Водич за бруцоше")}}<b class="caret"></b></a>
                <ul role="menu" class="dropdown-menu">
	                <li><a href="{{Request::root()}}/stranica/vodic-za-brucose-informacije-o-studiranju">{{__("Информације о студирању")}}</a></li>
	               	<li><a href="{{Request::root()}}/stranica/vodic-za-brucose-studentski-zivot">{{__("Студентски живот")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/vodic-za-brucose-studentski-parlament">{{__("Студентски парламент")}}</a></li>
					<li><a href="{{Request::root()}}/stranica/vodic-za-brucose-student-prodekan" target="_blank">{{__("Студент продекан")}}</a></li>
					<li>
			        	<a href="javascript:void(0)"><strong>{{__("Смерови")}}</strong></a>
			        </li>
					<li><a href="{{Request::root()}}/stranica/vodic-za-brucose-operacioni-menadzment">{{__("Операциони менаџмент")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/vodic-za-brucose-upravljanje-kvalitetom">{{__("Менаџмент квалитета и стандардизација")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/vodic-za-brucose-menadzment">{{__("Менаџмент")}}</a></li>
	                <li><a href="{{Request::root()}}/stranica/vodic-za-brucose-informacioni-sistemi-i-tehnologije">{{__("Информациони системи и технологије")}}</a></li>
	            </ul>
          	</li>
    	</ul>
  	</div>
</div>
@stop