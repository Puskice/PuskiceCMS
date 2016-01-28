@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="https://plus.google.com/+puskice"></span>
    <div class="content" itemscope itemtype="http://schema.org/Person">
      <div class="title">
        <h1>{{__($contact->title." ".$contact->first_name." ".$contact->last_name)}}</h1>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{Request::root()}}/ljudi/{{$contact->id}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{Request::root()}}/ljudi/{{$contact->id}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php if($contact->image == "")
          $media = "http://puskice.org/puskice-logo.jpg";
          else $media = $contact->image;
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{Request::root()}}/ljudi/{{$contact->id}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/ljudi/'.$contact->id)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($contact->title." ".$contact->first_name." ".$contact->last_name))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
      @if(!Session::get('id'))
        {{LoginController::getFacebookLoginFormLink()}}   
      @endif
      <div role="tabpanel" class="subjects">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">{{__("Подаци о предавачу")}}</a></li>
          <li role="presentation"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">{{__("Оцени предавача")}}</a></li>
          <li role="presentation"><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">{{__("Оцене")}}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active" id="description">
            <meta itemprop="url" content="{{Request::root()}}/ljudi/{{$contact->id}}">
            <meta itemprop="jobtitle" content="{{__($contact->title)}}">
            <meta itemprop="name" content="{{$contact->first_name}} {{__($contact->last_name)}}">
            <div itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="{{__("Факултет организационих наука")}}"></div>
            @if($contact->image != "")
              <img src="{{$contact->image}}" style="float:left;margin-right:10px;"/>
            @endif
            @if($contact->email != "")
              <p><strong>{{__("E-mail: ")}}</strong><span itemprop="email">{{$contact->email}}</span></p> 
            @endif
            @if($contact->webpage != "") 
              <p><strong>{{__("Веб сајт: ")}}</strong><a href="{{$contact->webpage}}" target="_blank">{{$contact->webpage}}</a></p> 
            @endif
            @if($contact->address) 
              <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <p><strong>{{__("Адреса: ")}}</strong><span itemprop="streetAddress">{{__($contact->address)}}</span></p> 
              </div>
            @endif
            @if($contact->phone) <p><strong>{{__("Телефон: ")}}</strong><span itemprop="telephone">{{$contact->phone}}</span></p> @endif
            <span itemprop="description">{{__($contact->description)}}</span>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="files">
            <p><small><em>{{__("Сервис за оцењивање предавача замишљен је као вид повратне информације предавачима у погледу квалитета наставе и могућности за унапређење исте.")}}</small></em></p>
            <p><small><em>{{__("Да бисте оцењивали предаваче потребно је да се улогујете, али је сам поступак оцењивања анониман. Напомињемо да увредљиви коментари неће бити објављивани.")}}</small></em></p>
            <form role="form" action="{{Request::root()}}/oceni/{{$contact->id}}" method="post">
              <div class="form-group">
                <label for="uskladjenost">{{__("Градиво за испит је усаглађено са оним што професор представи на предавању")}}</label><br/>
                <input type="text" class="form-control" id="uskladjenost" name="uskladjenost" data-slider-id='uskladjenost' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="jasnost">{{__("Предавач јасно представља градиво")}}</label><br/>
                <input type="text" class="form-control" id="jasnost" name="jasnost" data-slider-id='jasnost' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="interakcija">{{__("Предавач подстиче студенте да размишљају и коментаришу градиво")}}</label><br/>
                <input type="text" class="form-control" id="interakcija" name="interakcija" data-slider-id='interakcija' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="komunikacija">{{__("Предавач је доступан и редован ван наставе (консулатиције, е-мејлови)")}}</label><br/>
                <input type="text" class="form-control" id="komunikacija" name="komunikacija" data-slider-id='komunikacija' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="konflikt">{{__("Предавач често улази у конфликте са студентима")}}</label><br/>
                <input type="text" class="form-control" id="konflikt" name="konflikt" data-slider-id='konflikt' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="odnos">{{__("Предавач се опходи према студенту са поштовањем и уважавањем")}}</label><br/>
                <input type="text" class="form-control" id="odnos" name="odnos" data-slider-id='odnos' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="literatura">{{__("Квалитет предложене литературе")}}</label><br/>
                <input type="text" class="form-control" id="literatura" name="literatura" data-slider-id='literatura' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="inspiracija">{{__("Предавања из овог предмета су ме инспирисала да научим више о овој области")}}</label><br/>
                <input type="text" class="form-control" id="inspiracija" name="inspiracija" data-slider-id='inspiracija' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <label for="aktivnost">{{__("Активно сам учествовао  на предавањима")}}</label><br/>
                <input type="text" class="form-control" id="aktivnost" name="aktivnost" data-slider-id='aktivnost' type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="5">
              </div>
              <div class="form-group">
                <span>{{Trans::_t("Коментар (није обавезно)")}} </span>
                <br>
                <textarea id="komentar" tabindex="2" name="komentar" class="form-control" rows="5"></textarea>
              </div> 
              <script type="text/javascript">
                $('#uskladjenost').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#jasnost').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#interakcija').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#komunikacija').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#konflikt').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#odnos').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#literatura').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#inspiracija').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
                $('#aktivnost').slider({
                  formatter: function(value) {
                    return '{{__("Оцена")}}: ' + value;
                  }
                });
              </script>
              <input type="hidden" name="_token" value="{{Session::get('_token')}}" />
              <input type="submit" name="submit" class="btn btn-primary" value="{{__("Оцени")}}">
            </form>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="contacts">
              <div class="file">
                  <div class="file-info">
                    <h3>{{__("Општи утисак: ".round($contact->total_impression,2))}}</h3>
                    <h4>{{__("Настава")}}</h4>
                    <table class="table table-striped">
                      <tr>
                        <td><strong>{{__("Усклађеност градива и предавања: ")}}</strong></td>
                        <td>{{round($contact->uskladjenost,2)}}</td>
                      </tr>
                      <tr>
                        <td><strong>{{__("Јасност у излагању: ")}}</strong></td>
                        <td>{{round($contact->jasnost,2)}}</td>
                      </tr>
                      <tr>
                        <td><strong>{{__("Подстицање интеракције: ")}}</strong></td>
                        <td>{{round($contact->interakcija,2)}}</td>
                      </tr>
                      <tr>
                        <td><strong>{{__("Комуникација ван наставе (мејл, консултације): ")}}</strong></td>
                        <td>{{round($contact->komunikacija,2)}}</td>
                      </tr>  
                    </table>
                    <h4>{{__("Ангажман студената")}}</h4>
                    <table class="table table-striped">
                      <tr>
                        <td><strong>{{__("Активност студената на предавању: ")}}</strong></td>
                        <td>{{round($contact->aktivnost,2)}}</td>
                      </tr>
                      <tr>
                        <td><strong>{{__("Инспирисаност предавањима за даље учење: ")}}</strong></td>
                        <td>{{round($contact->inspiracija,2)}}</td>
                      </tr>
                    </table>
                    <h4>{{__("Однос са студентима")}}</h4>
                    <table class="table table-striped">
                      <tr>
                        <td><strong>{{__("Чести конфликти са студентима: ")}}</strong></td>
                        <td>{{round($contact->konflikt,2)}}</td>
                      </tr>
                      <tr>
                        <td><strong>{{__("Поштовање и уважавање студената: ")}}</strong></td>
                        <td>{{round($contact->student_relations,2)}}</td>
                      </tr>
                    </table>
                    <h4>{{__("Евалуација материјала")}}</h4>
                    <table class="table table-striped">
                      <tr>
                        <td><strong>{{__("Квалитет приложене литературе: ")}}</strong></td>
                        <td>{{round($contact->kvalitet_literature,2)}}</td>
                      </tr>
                    </table>
                  </div>
                  <div class="clearfix"></div>
              </div>
          </div>
        </div>
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