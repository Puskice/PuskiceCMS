@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1>{{__("Постаните део Екипе Пушкица")}}</h1>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/novi-clanovi")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/novi-clanovi")}}" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = Config::get('settings.defaultImage');
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/novi-clanovi")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(_l(Request::root().'/novi-clanovi'))}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(__("Нови чланови | Пушкице | Тачка спајања студената ФОН-а"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
        <!-- Place this tag after the last +1 button tag. -->
        <script type="text/javascript">
          window.___gcfg = {lang: 'sr'};
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
      </div>
      <div class="text-content">
        
        <p>
	        {{__("Са задовољством вас обавештавамо да Екипа Пушкица прима нове чланове. Уколико препознајеш себе у нашем тиму. Пријави се!<br/>")}}
	      </p>
	      <p>
	          {{__("Попуни упитник и изабери позицију за коју се пријављујеш. Уколико ниси сигуран/на шта је прави избор за тебе, прочитај описе позиција испод. Оно што од нас можеш очекивати је подршка у сваком тренутку, учење уз ментора, рад на практичним пројектима и веома веселу атмосферу у нашој Екипи!<br/>")}}
	      </p>
	     
	      <form action="{{Request::root()}}/novi-clanovi/prijava" method="post" accept-charset="utf-8">
	        <div class="form-group">
	          <label>{{__("Име и презиме")}}</label>
	          <input type="text" class="form-control" name="name" value="{{Input::old('name', '')}}"/>
	        </div>
	        <div class="form-group">
	          <label>{{__("E-mail")}}</label>
	          <input type="text" class="form-control" name="email" value="{{Input::old('email', '')}}" />
	        </div>
	        <div class="form-group">
	          <label>{{__("Година")}}</label>
	          <select name="godina" class="form-control">
	            <option @if(Input::old('godina') == "Прва година") selected="selected" @endif value="Прва година">{{__("Прва година")}}</option>
	            <option @if(Input::old('godina') == "Друга година") selected="selected" @endif value="Друга година">{{__("Друга година")}}</option>
	            <option @if(Input::old('godina') == "Трећа година") selected="selected" @endif value="Трећа година">{{__("Трећа година")}}</option>
	            <option @if(Input::old('godina') == "Четврта година") selected="selected" @endif value="Четврта година">{{__("Четврта година")}}</option>
	            <option @if(Input::old('godina') == "Мастер") selected="selected" @endif 
	vavalue="Мастер">{{__("Мастер")}}</option>
	            <option @if(Input::old('godina') == "Нешто друго") selected="selected" @endif 
	vavalue="Нешто друго">{{__("Нешто друго")}}</option>
	          </select>
	        </div>
	        <div class="form-group">
	          <label>{{__("Мотивација")}}</label>
	          <textarea class="form-control" name="motivacija">{{Input::old('motivacija', '')}}</textarea>
	        </div>
	        <div class="form-group">
	          {{__("Линк ка Фејсбук профилу")}}<br/>
	          <input type="text" class="form-control" name="fb" value="{{Input::old('fb', '')}}"/>
	        </div>
	        <div class="form-group">
	          {{__("Линк ка Linkedin профилу")}}<br/>
	          <input type="text" class="form-control" name="in" value="{{Input::old('in', '')}}"/>
	        </div>
	        <div class="form-group">
	          {{__("Линк ка Твитер профилу")}}<br/>
	          <input type="text" class="form-control" name="tw" value="{{Input::old('tw', '')}}"/>
	        </div>
	        <div class="form-group">
	          <label>{{__("Интересовање:")}}</label><br/>
	          <label>
	            <input type="checkbox" name="interesovanje[webdizajn]" value="{{__("Мали/а који зна с компјутерима (Dev Guru)")}}"> {{__("Мали/а који зна с компјутерима (Development Guru)")}}
	          </label>
	          <br/>
	          <label>
	            <input type="checkbox" name="interesovanje[webdev]" value="{{__("Уметничка душа (Графички дизајнер)")}}"> {{__("Уметничка душа (Графички дизајнер)")}}
	          </label>
	          <br/>
	          <label>
	            <input type="checkbox" name="interesovanje[write]" value="{{__("Писац (Аутор текстова)")}}"> {{__("Писац (Аутор текстова)")}}
	          </label>
	          <br/>
	          <label>
	            <input type="checkbox" name="interesovanje[edit]" value="{{__("Кеба Краба (Fund raising)")}}"> {{__("Кеба Краба (Fund raising)")}}
	          </label>
	          <br/>
	          <label>
	            <input type="checkbox" name="interesovanje[marketing]" value="{{__("Људски ресурс (HR менаџер)")}}"> {{__("Људски ресурс (HR менаџер)")}}
	          </label>
	          <br/>
	          <label>
	            <input type="checkbox" name="interesovanje[foto]" value="{{__("Менаџер утицаја (Social media менаџер)")}}"> {{__("Менаџер утицаја (Social media менаџер)")}}
	          </label>
	          <br/>
	          
	        </div>
	        <div class="form-group">             
	          <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
	          <input type="submit" class="btn btn-primary" value="{{__("Пријави се")}}" />
	        </div>
	      </form>
	      {{ __("<ol>
			<li>
				<p><strong>Мали/а који зна с компјутерима (Development Guru)</strong></p>
				<p>ИТ део Екипе је задужен за функционисање сајта, API-ја, екстензија за Google Chrome и Firefox, као и за разне друге ствари које се раде на Пушкицама, попут анкета, петиција, игрица као што су 2048 или Пакмен... У Екипи ћеш имати прилике да радиш са Вордпресом и то на развоју додатака и тема, Ларавел фрејмворком, JSON API-јем. Имаћеш прилику да користиш Гит за верзионисање кода, PHP Storm за развој, Google Analytics за праћење броја посета, DFP за управљање банерима, упознаш се са функционисањем дељеног хостинга и cloud сервера, сазнаш шта је Cloudflare. Биће ту и пројеката отвореног кода, које ћеш моћи да поставиш на свом GitHub налогу и тиме се хвалиш на интервјуима за посао.</p>
				<ul>
					<li><p><strong>Мали од палубе</strong></p>
						<p>Уколико ниси чуо за већину горе наведених ствари, али ти се баш свиђа идеја да научиш више о њима, нема препрека да се пријавиш. Сви смо ту да учимо и међусобно се помажемо. Од тебе се тражи добра воља, упорност и истрајност.</p>
					</li>
					<li><p><strong>ИТ капетан</strong></p>
						<p>Ако већ бараташ једном или већим бројем претходно наведних технологија и алата, ти си управо оно што нам треба. Наравно од тебе ће се очекивати да можеш самостално да решиш евентуалне проблеме на сајту или развијеш нову опцију. Ипак, ни овде подршка старијих неће изостати.</p>
					</li>
				</ul>
				
			</li>
			<li>
			<p><strong>Уметничка душа (Графички дизајнер)</strong></p>
			<p>За ову позицију тражимо колегу или колегиницу који/а има развијен смисао за естетику, а све остало ћемо заједно научити. Пожељно је најосновније знање из Adobe Photoshop-а или Illustratora. Но, ни то није превише битно уколико имаш жељу да научиш. Радићемо заједно на прављењу банера, разних промотивних материјала, слика за објаве на друштвеним мрежама и, наравно, смешних фотографија са нашим деканом. Обећавамо ти да ћеш за мање од годину дана солидно савладати и Photoshop&nbsp;и Illustrator, а можда и Adobe InDesign, а радове ћеш, уколико желиш, моћи да искористиш за свој портфолио.</p>
			</li>
			<li>
			<p><strong>Писац (Аутор текстова)</strong></p>
			<p>Најбитнији људи у нашој Екипи су аутори текстова и они имају велико поштовање целе дружине. Тражимо неког ко је довољно креативан да претвори занимљиве идеје свих чланова у мале причице које ће насмејати све колеге. Очекујемо добро познавање граматике и правописа, жељу за истраживањем чињеница и смисао за хумор. Помоћи ћемо ти да научиш да правилно аргументујеш ставове и да видиш како се речима, кроз шалу или озбиљне теме, ствари могу мењати на боље. Додатна мотивација: Од чланова Екипе редовно добијаш палачинке и слаткише.</p>
			</li>
			<li>
			<p><strong>Кеба Краба (Fund raising)</strong></p>
			<p>Иако смо непрофитна организација, одређени део трошкова одржавања сајта ипак морамо покрити. Такође, увек волимо да заједно идемо на дружења и тренинге. Због тога нам треба нови члан који ће помоћи у делу са финансијама. За почетак, потребно је само да си комуникативан/на, да си наоружан/на са много упорности и да желиш да научиш тајни занат продаје. Сигурни смо да би ти то и касније помогло у доста животних ситуација (преговарања, интервјуи, презентације). Заједно са ментором, научићеш како да правилно напишеш понуду за сарадњу, како да саставиш мејлове и уговориш састанак, како да се поставиш на састанку и представиш Екипу на прави начин.</p>
			</li>
			<li>
			<p><strong>Људски ресурс (HR менаџер)</strong></p>
			<p>Ово је један од занимљивијих послова са једним главним задатком &ndash; мотивација дружине. Очекујемо да, за почетак, само да знаш где можеш да нађеш најзанимљивија места за дружења и теамбуилдинг-е. Поред тога, научићеш да координираш рад тимова, да додељујеш задатке и одговорности и пратиш њихово испуњење.</p>
			</li>
			<li>
			<p><strong>Менаџер утицаја (Social media менаџер)</strong></p>
			<p>У ери развоја друштвених мрежа, и Пушкице морају редовно да комуницирају на истим. Као што знате, имамо Фејсбук и Твитер, а тражимо неког ко је упознат са обе. Креативност, смисао за хумор и познавање граматике и правописа су обавезни. За кратко време, са својим ментором ћеш савладати начин професионалног вођења налога на друштвеним мрежама који касније можеш искористити за било који други пројекат. Поред тога, лако ћеш савладати рад са спонзорисаним објавама и како се прати Фејсбук и Твитер аналитика.</p>
			</li>
		  </ol>") }}
      </div>
      <div class="follow_buttons">
        <a href="https://twitter.com/puskice" class="twitter-follow-button" data-show-count="false">Follow @puskice</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="fb-like" data-href="http://www.facebook.com/puskice" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="segoe ui"></div>
        
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/106103133810705694757" data-rel="publisher"></div>
      </div>
    </div>
  </div>
</div>
@stop