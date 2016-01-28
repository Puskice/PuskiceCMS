@section('center')
<div class="row">
      <div class="col-md-12 content-container">
        @yield('banners')
        <div class="content">
          <div class="share_area">
            <div class="fb-share-button" data-href="{{Request::root()}}/2048" data-type="button_count"></div>
            <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{Request::root()}}/2048" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <?php 
              $media = "https://puskice.org/puskice-logo.jpg";
            ?>
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-width="50" data-href="{{Request::root()}}/2048"></div>
            <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root())}}/2048&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t("2048 FON"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>

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
          <div id="fix"></div>
          <div>
            <div class="heading">
              <h1 class="title thisistext">2048: <a style="color:blue" href="https://twitter.com/search?f=realtime&q=%23fonbg&src=typd" target="_blank">#fonbg</a> {{Trans::_t("издање")}}</h1>
                    <p id="credit">by Puškice</p>
              
              <div class="scores-container">
                <div class="score-container">0</div>
                <div class="best-container">0</div>
              </div>
            </div>

            <div class="game-container">
              <div class="game-message">
                <p></p>
                <div class="lower">
                  
        	        <a class="tweet" style="display: none;"></a>
        	        <a class="facebook" style="display: none;"></a>
                  <a class="retry-button">Ponovo?</a>
                  
                </div>

              </div>

              <div class="grid-container">
                <div class="grid-row">
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                </div>
                <div class="grid-row">
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                </div>
                <div class="grid-row">
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                </div>
                <div class="grid-row">
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                  <div class="grid-cell"></div>
                </div>
              </div>

              <div class="tile-container">

              </div>
            </div>
          </div>
 

          <script src="usvsth3m.co.uk/2048/js/glom.js"></script>
          

          <div class="preload">
          <img src="//www.puskice.org/i.imgur.com/mDPgBQT.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/AJCewo6.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/uYuZILz.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/rb9cBw7.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/a6OHkjt.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/StPZKlu.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/vjWJLmd.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/RThRV8V.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/tmQQswo.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/QsE9h31.gif" class="preload"><img src="//www.puskice.org/i.imgur.com/SfGbUDU.gif" class="preload">  </div>
          <p>&nbsp;</p>
          <p style="color: black;font-size:12px">{{Trans::_t("Драге колеге, представљамо вам ФОН верзију популарне игрице 2048 у којој уместо бројева можете пронаћи карикатуре професора са нашег факултета.")}}</p>
            <p style="color: black;font-size:12px">{{Trans::_t("Ово видимо као леп начин да се бруцоши упознају са ликовима професора који ће им предавати, али и да се старије колеге забаве кроз игру.")}}</p>
            <p style="color: black;font-size:12px">{{Trans::_t("Надамо се да се нико од професора неће увредити и да ће им се карикатуре свидети :)")}}</p>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/mDPgBQT.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("2. Проф. др Милан Мартић - Декан Факултета организационих наука. Поред тога предаје на катедри за операциона истраживања")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/AJCewo6.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("4. Доц. др Гордана Јакић - Професорка енглеског језика. Дружићете се са њом најмање 2 године и на три испита из енглеског.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/uYuZILz.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("8. Проф. др Дејан Симић - Један од првих професора који вас дочекају на ФОН-у у оквиру испита из Основа информационо-комуникационих технологија")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/rb9cBw7.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("16. Проф. др Драгана Крагуљ - Упознаћете је већ на предавањима из економије. ")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/a6OHkjt.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("32. Асистент Ђорђе Кривокапић - Асистент са којим ћете имати прилике да се дружите на Правним основама информационих система.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/StPZKlu.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("64. Проф. др Владан Девеџић - Колеге које се буду више интересовале за програмирање, много више ће се дружити са овим професором.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/vjWJLmd.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("128. Проф. др Весна Милићевић - Између осталог, код ове професорке ћете слушати Економику пословања и планирање.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/RThRV8V.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("256. Проф. др Ранко Орлић - Овај професор ће вам предавати Менаџмент људских ресурса. А можда постанете и члан Менсе.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/tmQQswo.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("512. Асистенткиња Светлана Јовановић - Сретаћете се са Светланом на Основама информационо-комуникационих технологија и на Правним основама информационих система.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/QsE9h31.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("1024. Асистент Ратимир Дракулић - Асистент на Уводу у информационе системе и основама информационо-комуникационих технологија.")}}</p> 
              <div style="clear:both"></div>
            </div>
            <div class="professor" style="margin-bottom:10px;">
              <img src="//puskice.org/i.imgur.com/SfGbUDU.gif" style="float:left;margin-right:20px" />
              <p style="color:#000;font-size:14px;margin-right:10px;">{{Trans::_t("2048. Проф. др Раде Лазовић - Један од неколико професора са катедре за математику. У другој години можете изабрати да се дружите са њим на Нумеричкој анализи.")}}</p> 
              <div style="clear:both"></div>
            </div>
          </div>
        </div>
</div>
@stop