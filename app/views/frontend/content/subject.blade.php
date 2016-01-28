@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1>{{__($page->title)}}</h1>
      </div>
      <div class="meta">
        <small>{{date("d.m.Y H:i", strtotime($page->created_at))}}</small>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/".Puskice::getYear($sub->semester)."/".Puskice::getDepartment($sub->department)."/".$page->permalink)}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/".Puskice::getYear($sub->semester)."/".Puskice::getDepartment($sub->department)."/".$page->permalink)}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php if($page->featured_image == "")
          $media = "http://puskice.org/puskice-logo.jpg";
          else $media = $page->featured_image;
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/".Puskice::getYear($sub->semester)."/".Puskice::getDepartment($sub->department)."/".$page->permalink)}}"></div>
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-counter="right"></script>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/'.Puskice::getYear($sub->semester).'/'.Puskice::getDepartment($sub->department).'/'.$page->permalink)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($page->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
      @if($page->featured_image != "") 
        <div class="featured-image">
          @if($page->image_caption != "") 
            <div class="image-caption">
              <p>{{$page->image_caption}}</p> 
            </div>
          @endif
          <img src="{{$page->featured_image}}"/>
        </div>
      @endif
      <div role="tabpanel" class="subjects">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">{{__("Информације о предмету")}}</a></li>
          <li role="presentation"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">{{__("Материјали за учење")}}</a></li>
          <li role="presentation"><a href="#contacts" aria-controls="contacts" role="tab" data-toggle="tab">{{__("Наставно особље")}}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active" id="description">
            {{__($page->long_content)}}
          </div>
          <div role="tabpanel" class="tab-pane fade" id="files">
            @if(sizeof($page->files) > 0)
             @foreach ($page->files as $key => $file) 
                <div class="file">
                  <div class="file-info">
                    <a class="file-title" href="https://api.puskice.org/files/show/{{$file->id}}" target="_blank"><strong>{{$file->title}}</strong></a><br/>
                    @if($file->description != "") <p><strong>{{__("Опис: ")}}</strong>{{$file->description}}</p><br/> @endif
                    <p><strong>{{__("Објављено: ")}}</strong>{{date("d.m.Y", strtotime($file->created_at))}}</p><br/>
                    <p><strong>{{__("Број преузимања: ")}}</strong>{{$file->download_count}}</p><br/>
                  </div>
                  <div class="thumbs">
                    <div id="thumbsresponse{{$file->id}}"></div>
                      <div class="thumbs_down{{$file->id}} thumbsdown">
                        <a href="javascript:void(0)" class="thmb_link" onclick="fileThumbsDown({{$file->id}})">
                            <i class="fa fa-thumbs-o-down fa-2x"></i>
                        </a>
                        <span id="downvote{{$file->id}}">
                            {{$file->thumbs_down}}
                        </span>
                      </div>
                      <div class="thumbs_up{{$file->id}} thumbsup">
                        <a href="javascript:void(0)" class="thmb_link" onclick="fileThumbsUp({{$file->id}})">
                            <i class="fa fa-thumbs-o-up fa-2x"></i>
                        </a>
                        <span id="upvote{{$file->id}}">
                            {{$file->thumbs_up}}
                        </span>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              @endforeach 
            @endif
          </div>
          <div role="tabpanel" class="tab-pane fade" id="contacts">
            @if(sizeof($page->newsContacts) > 0)
              @foreach ($page->newsContacts as $key => $newsContact) 
                @if($newsContact->contact)
                  <div class="file">
                      <div class="file-info">
                          <a href="{{Request::root()}}/ljudi/{{$newsContact->contact->id}}"><strong>{{$newsContact->contact->title." ".$newsContact->contact->first_name." ".$newsContact->contact->last_name}}</strong></a><br/>
                          <span><strong>{{__("Утисак колега: ")}}</strong>{{$newsContact->contact->total_impression}}</span> - <em><a href="{{Request::root()}}/ljudi/{{$newsContact->contact->id}}">{{__("Моје мишљење")}}</a></em>
                      </div>
                      <div class="clearfix"></div>
                  </div>
                @else
                  {{$newsContact->contact_id}}
                @endif
              @endforeach
            @endif
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