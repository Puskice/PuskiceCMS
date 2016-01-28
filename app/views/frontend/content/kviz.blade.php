@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h2>{{__("Да ли си спреман да будеш тајни агент Пушкица?")}}</h2>
      </div>
      <div class="meta">

      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/kviz/")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/kviz/")}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = "http://puskice.org/puskice-logo.jpg";
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/kviz/")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/kviz/')}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t("Квиз | Пушкице"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
          <form action="{{Request::root()}}/kviz/" method="post" accept-charset="utf-8">
            <div class="form-group">
              <label>{{__("Када си први пут чуо/ла за Пушкице *")}}</label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"Пре него што сам уписао/ла факултет"}}"> {{__("Пре него што сам уписао/ла факултет")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"У првој години"}}"> {{__("У првој години")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"У другој години"}}"> {{__("У другој години")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"У трећој години"}}"> {{__("У трећој години")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"У четвртој години"}}"> {{__("У четвртој години")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="kadsuculi" value="{{"Никад до сад јер немам интернет"}}"> {{__("Никад до сад јер немам интернет")}}
              </label>
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Ко тренутно влада судбином студената ФОН-а *<br/><small>
              Можда постоји више тачних одговора, можда не постоји, можда има негативних поена, можда нема. Какав ролеркостер правила, зар не?</small>")}}</label>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Мартић из сенке"}}"> {{__("Мартић из сенке")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Матић и Шаулић"}}"> {{__("Матић и Шаулић")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Милија Сукновић"}}"> {{__("Милија Сукновић")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Сале из вероватноће"}}"> {{__("Сале из вероватноће")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Сви заједно у талу"}}"> {{__("Сви заједно у талу")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="vladar[]" value="{{"Неко трећи"}}"> {{__("Неко трећи")}}
              </label>
              <br/>
              <label>{{__("Друго:")}}</label>
              <input type="text" class="form-control" name="vladar[]" />
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Како се зове нови део зграде ФОН-а? *")}}</label>
              <br/>
              <label>
                <input type="radio" name="zgrada" value="{{"Стакленик"}}"> {{__("Стакленик")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="zgrada" value="{{"Ентерпрајз"}}"> {{__("Ентерпрајз")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="zgrada" value="{{"Вила Милија"}}"> {{__("Вила Милија")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="zgrada" value="{{"BG-H2fOn"}}"> {{__("BG-H2fOn")}}
              </label>
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Ко највише воли Пушкице? *")}}</label>
              <br/>
              <label>
                <input type="checkbox" name="konasvoli[]" value="{{"Интерфон"}}"> {{__("Интерфон")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="konasvoli[]" value="{{"Студентски парламент у пуном саставу"}}"> {{__("Студентски парламент у пуном саставу")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="konasvoli[]" value="{{"Жакили"}}"> {{__("Жакили")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="konasvoli[]" value="{{"Клик клак"}}"> {{__("Клик клак")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="konasvoli[]" value="{{"Гоца и њена три презимена"}}"> {{__("Гоца и њена три презимена")}}
              </label>
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Никад ниси: * <br/><small>
              Сви знамо за игру. </small>")}}</label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Пао Мату 1"}}"> {{__("Пао Мату 1")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Сликао се на поларном медведу"}}"> {{__("Сликао се на поларном медведу")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Чуо Салета како каже 'Значи оно како се зове'"}}"> {{__("Чуо Салета како каже 'Значи оно како се зове'")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Истеран из читаонице на ФПН-у"}}"> {{__("Истеран из читаонице на ФПН-у")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Чекао 2 сата испред студентске службе"}}"> {{__("Чекао 2 сата испред студентске службе")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="nikadniste[]" value="{{"Попио литар кафе током испитног рока"}}"> {{__("Попио литар кафе током испитног рока")}}
              </label>
              <br/>
              <label>{{__("Друго:")}}</label>
              <input type="text" class="form-control" name="nikadniste[]" />
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Шта ти се не свиђа на нашем факултету, тј. шта би променио/ла? * <br/><small>
              (Одговор мора имати минимум 8 милиона карактера, једно мали и једно велико слово). </small>")}}</label>
              <textarea class="form-control" name="promene" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label>{{__("Шта највише волиш код нашег факултета? *")}}</label>
              <br/>
              <label>
                <input type="checkbox" name="stavoli[]" value="{{"Медведа прљаве њушке"}}"> {{__("Медведа прљаве њушке")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="stavoli[]" value="{{"Наранџаста врата"}}"> {{__("Наранџаста врата")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="stavoli[]" value="{{"Докторат Синише Малог"}}"> {{__("Докторат Синише Малог")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="stavoli[]" value="{{"Статуу из Аранђеловца"}}"> {{__("Статуу из Аранђеловца")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="stavoli[]" value="{{"Редове испред студентске"}}"> {{__("Редове испред студентске")}}
              </label><br/>
              <label>{{__("Друго:")}}</label>
              <input type="text" class="form-control" name="stavoli[]" />
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Шта је епсилон околина тачке? *")}}</label>
              <textarea class="form-control" name="epsilon" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label>{{__("На кога сумњате да је члан Екипе Пушкица? *")}}</label>
              <br/>
              <label>
                <input type="checkbox" name="clan[]" value="{{"Чак Норис"}}"> {{__("Чак Норис")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="clan[]" value="{{"Тета из скриптарнице"}}"> {{__("Тета из скриптарнице")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="clan[]" value="{{"Деки Симић"}}"> {{__("Деки Симић")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="clan[]" value="{{"Милија главом и брадом"}}"> {{__("Милија главом и брадом")}}
              </label>
              <br/>
              <label>
                <input type="checkbox" name="clan[]" value="{{"Матић - Само се фолира"}}"> {{__("Матић - Само се фолира")}}
              </label><br/>
              <label>{{__("Друго:")}}</label>
              <input type="text" class="form-control" name="clan[]" />
              <br/>
            </div>
            <div class="form-group">
              <label>{{__("Да ли би се пријавио/ла да будеш члан Екипе Пушкица? *")}}</label>
              <br/>
              <label>
                <input type="radio" name="biliclan" value="{{"Дабоме"}}"> {{__("Дабоме")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="biliclan" value="{{"Дакако"}}"> {{__("Дакако")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="biliclan" value="{{"Не бих"}}"> {{__("Не бих")}}
              </label>
              <br/>
              <label>
                <input type="radio" name="biliclan" value="{{"Јел дајете сендвиче? Не? Онда ништа."}}"> {{__("Јел дајете сендвиче? Не? Онда ништа.")}}
              </label>
              <br/>
            </div>
            <div class="form-group">             
              <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
              <input type="submit" class="btn btn-primary" value="{{__("Сазнај одговоре")}}" />
            </div>
          </form>
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
</div>
@stop