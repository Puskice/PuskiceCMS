@section('center')
<div class="row">
  <div class="col-md-12">
    <div class="content">
      <form>
        <div class="form-group">
          <span>{{Trans::_t("Унесите текст")}} </span>
          <br>
          <textarea id="original" tabindex="1" name="original" class="form-control" rows="10"></textarea>
        </div> 
        <div class="form-group">
          <span>{{Trans::_t("Резултат")}} </span>
          <br>
          <textarea id="transliterated" tabindex="2" name="transliterated" class="form-control" rows="10"></textarea>
        </div> 
        <div>
          <input type="hidden" name="_token" value="{{Session::get('_token')}}" id="token" />  
          <a class="btn btn-primary" href="javascript:void(0)" onclick="toLat()"><span>U latinicu</span></a>
          <a class="btn btn-primary" style="float:right" href="javascript:void(0)" onclick="toCir()"><span>У ћирилицу</span></a>
          <p></p>
          <div style="clear:both"></div>
        </div>
      </form>
    </div>
  </div>
</div>
@stop