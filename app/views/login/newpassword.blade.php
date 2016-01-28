@section('form')    
    <div class="form-box" id="login-box">
        <div class="header">{{__(Lang::get('login.resetPass'))}}</div>
        <form action="{{_l(URL::action('LoginController@postChangePassword'))}}" method="post">
            <div class="body bg-gray">
                @yield('errorReporting')
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{__(Lang::get('login.password'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="repeatPassword" class="form-control" placeholder="{{__(Lang::get('login.repeatPassword'))}}"/>
                </div>
            </div>
            <div class="footer">                    
                <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
                <input type="hidden" value="{{$hash}}" name="hash" />
                <button type="submit" class="btn bg-olive btn-block">{{__(Lang::get('login.resetPass'))}}</button>

                <a href="{{_l(URL::action('LoginController@getIndex'))}}" class="text-center">{{__(Lang::get('login.alreadyMember'))}}</a>
            </div>
        </form>
    </div>
@stop