@section('center')
<div class="row">
  <div class="col-md-12 content-container" itemscope itemtype="http://schema.org/Article">
    @yield('banners')
    <div class="content">
      <div class="title">
        <h1 itemprop="name">{{__($page->title)}} @if(Session::get('user_level') >= Config::get('cms.editNews')) <small><a href="{{URL::action('NewsController@getEdit').'/'.$page->id}}">{{__("Измени")}}</a></small> @endif</h1>
      </div>
      <div class="meta">
        <small><span itemprop="datePublished" content="{{date("Y-m-d H:i", strtotime($page->created_at))}}">{{date("d.m.Y H:i", strtotime($page->created_at))}}</span> // {{__("Категорије: ")}} <span itemprop="articleSection">@foreach($page->newsCategories as $c) <a href="{{Request::root()}}/{{$c->category->permalink}}">{{__($c->category->title)}}</a> | @endforeach </span></small>
        <meta itemprop="url" content="{{Request::root()}}/vest/{{dateToUrl($page->created_at)}}/{{$page->permalink}}">
        <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="https://plus.google.com/+puskice"></span>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink)}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink)}}" data-via="puskice" data-related="puskice" @if($page->fonbg == 1) data-hashtags="fonbg" @endif>Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php if($page->featured_image == "")
          $media = "http://puskice.org/puskice-logo.jpg";
          else $media = $page->featured_image;
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink)}}"></div>
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
              lang: en_US
            </script>
            <script type="IN/Share" data-counter="right"></script>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/vest/'.dateToUrl($page->created_at).'/'.$page->permalink)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($page->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
      <div role="tabpanel" class="subjects">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" @if(!Input::get('page') || Input::get('page') == 1) class="active" @endif><a href="#text" aria-controls="text" role="tab" data-toggle="tab">{{__("Текст")}}</a></li>
          <li role="presentation" @if(Input::get('page') && Input::get('page') > 1) class="active" @endif><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">{{__("Коментари (".$page->comments()->count().")")}}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade @if(!Input::get('page') || Input::get('page') == 1) in active @endif" id="text">
            @if($page->featured_image != "") 
              <div class="featured-image">
                @if($page->image_caption != "") 
                  <div class="image-caption">
                    <p>{{__($page->image_caption)}}</p> 
                  </div>
                @endif
                <img itemprop="image" src="{{$page->featured_image}}"/>
              </div>
            @endif
            <div class="text-content" itemprop="articleBody">
              {{__($page->long_content)}}
            </div>
          </div>
          <div role="tabpanel" class="tab-pane fade @if(Input::get('page') && Input::get('page') > 1) in active @endif" id="comments">
            @if($page->comments()->where('published', '=', 1)->count() == 0)
              {{__("Тренутно нема коментара. Будите први који ће поставити коментар!")}}
            @endif
            @foreach ($comments as $key => $comment) 
              @if($comment->published == 1)
                <div class="file">
                  <div class="file-info">
                    <div>{{__($comment->comment_content)}}</div><br/>
                    <p><small><strong>{{__("Објављено: ")}}</strong>{{date("d.m.Y H:i", strtotime($comment->created_at))}} - ({{__($comment->username)}}) @if(amres($comment->ip_address)) {{_(" - Послато са академске мреже")}} @endif</small></p><br/>
                  </div>
                  <div class="thumbs">
                    <div id="thumbsresponse{{$comment->id}}"></div>
                      <div class="thumbs_down{{$comment->id}} thumbsdown" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <a href="javascript:void(0)" class="thmb_link" onclick="commentThumbsDown({{$comment->id}})">
                            <i class="fa fa-thumbs-o-down fa-2x"></i>
                        </a>
                        <span id="downvote{{$comment->id}}" itemprop="ratingCount">
                            {{$comment->thumbs_down}}
                        </span>
                      </div>
                      <div class="thumbs_up{{$comment->id}} thumbsup" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                        <a href="javascript:void(0)" class="thmb_link" onclick="commentThumbsUp({{$comment->id}})">
                            <i class="fa fa-thumbs-o-up fa-2x"></i>
                        </a>
                        <span id="upvote{{$comment->id}}" itemprop="ratingCount">
                            {{$comment->thumbs_up}}
                        </span>
                      </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                @endif
              @endforeach 
              {{$comments->links()}}
          </div>
        </div>
      </div>
      <div class="thumbs-news">
        <div id="thumbsresponse"></div>
        <div class="thumbsup">
          <a href="javascript:void(0)" class="thmb_link" onclick="newsThumbsUp({{$page->id}})">
            <i class="fa fa-thumbs-o-up fa-2x"></i>
          </a>
          <span id="upvote">
            {{$page->thumbs_up}}
          </span>
        </div>
        <div class="thumbsdown">
          <a href="javascript:void(0)" class="thmb_link" onclick="newsThumbsDown({{$page->id}})">
            <i class="fa fa-thumbs-o-down fa-2x"></i>
          </a>
          <span id="downvote">
            {{$page->thumbs_down}}
          </span>
        </div>
        <div style="clear:both"></div>
      </div>
      <div class="follow_buttons">
        <a href="https://twitter.com/puskice" class="twitter-follow-button" data-show-count="false">Follow @puskice</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="fb-like" data-href="http://www.facebook.com/puskice" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="segoe ui"></div>
        
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/106103133810705694757" data-rel="publisher"></div>
      </div>
      <div class="outbrains">
        <div data-src="{{_l(Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink)}}" class="OUTBRAIN" ></div>
        <script type="text/javascript">(function(){window.OB_platformType=8;window.OB_langJS="http://widgets.outbrain.com/lang_sr.js";window.OBITm="1416699623536";window.OB_recMode="brn_strip";var ob=document.createElement("script");ob.type="text/javascript";ob.async=true;ob.src="http"+("https:"===document.location.protocol?"s":"")+"://widgets.outbrain.com/outbrainLT.js";var h=document.getElementsByTagName("script")[0];h.parentNode.insertBefore(ob,h);})();</script>
      </div>
      <div class="comment-form">
        <h2>{{Trans::_t("Постави коментар")}}</h2>
        <div class="comment_editor">
          <form name="post_comment" id="post_comment" action="https://api.puskice.org/comments/create/{{$page->id}}" method="POST">
            @if(Session::get("id") == null)
            <div class="form-group">
              <label>{{Trans::_t("Псеудоним")}}: </label>
              <input tabindex="1" name="username" class="form-control" id="username" type="text" />
            </div>
             <div class="form-group">
              <span>E-mail: </span>
              <br />
              <input id="email" tabindex="2" name="email" class="form-control" type="text" />
            </div>
            @else
              <p><strong>{{Trans::_t("Пријављени сте као")}}: <i>{{Session::get("username")}}</i></strong></p>
              <input tabindex="1" name="username" class="form-control" id="username" type="hidden" value="{{Session::get('username')}}" />
              <input id="email" tabindex="2" name="email" class="form-control" type="hidden" />
              <input id="id" tabindex="2" name="id" class="form-control" type="hidden" value="{{Session::get('id')}}" />
            @endif
            <div class="form-group">
              <span>{{Trans::_t("Коментар")}}: </span>
              <br />
              <textarea id="comment_content" tabindex="3" name="comment_content" class="form-control"></textarea>
            </div> 
            <div class="form-group">
              <span>{{Trans::_t("Антиспам")}}: </span>
              <br />
              <p><strong id="num1">{{rand(0,20)}}</strong> + <strong id="num2">{{rand(0,20)}}</strong></p>
              <input id="antibot" type="text" name="antibot" class="form-control" tabindex="4">
            </div>   
            <div class="form-group">
              <input type="hidden" name="_token" value="{{Session::get('_token')}}" id="token" />
              <a class="btn btn-primary" href="javascript:void(0)" id="postbutton" onclick="postComment({{$page->id}})"><span>{{Trans::_t("Постави коментар")}}</span></a>
              <div style="clear:both"></div>
            </div>
            <div><strong id="response"></strong></div>
            <div><p><small>{{Trans::_t("Коментари пролазе модерацију, зато што смо тако у могућности")}}</small></p></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop