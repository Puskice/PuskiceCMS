@section('form')    
    <div class="form-box" id="login-box">
        <div class="header">{{__(Lang::get('login.resetPass'))}}</div>
        <form action="{{_l(URL::action('LoginController@postSendReset'))}}" method="post">
            <div class="body bg-gray">
                @yield('errorReporting')
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="{{__(Lang::get('login.email'))}}"/>
                </div>
            </div>
            <div class="footer">                    
                <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
                <button type="submit" class="btn bg-olive btn-block">{{__(Lang::get('login.resetPass'))}}</button>

                <a href="{{_l(URL::action('LoginController@getIndex'))}}" class="text-center">{{__(Lang::get('login.alreadyMember'))}}</a>
            </div>
        </form>
    </div>
@stop