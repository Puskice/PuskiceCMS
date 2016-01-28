@section('form')    
    <div class="form-box" id="login-box">
        <div class="header">{{__(Lang::get('login.signin'))}}</div>
        <form action="{{_l(URL::action('LoginController@postSignin'))}}" method="post">
            <div class="body bg-gray">
                @yield('errorReporting')
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="{{__(Lang::get('login.username'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{__(Lang::get('login.password'))}}"/>
                </div>          
                <div class="form-group">
                    <input type="checkbox" name="remember" value="1"/> {{__(Lang::get('login.rememberMe'))}}
                    <input type="hidden" name="_token" value="{{Session::get('_token')}}">
                    <input type="hidden" name="subdomain" value="{{Input::get('subdomain', "")}}">
                </div>
            </div>
            <div class="footer">                                                               
                <button type="submit" class="btn bg-olive btn-block">{{__(Lang::get('login.signin'))}}</button>  
                
                <a class="btn btn-warning" href="{{URL::action('LoginController@getResetPassword')}}">{{__(Lang::get('login.forgotPassword'))}}</a>
                
                <a class="btn btn-success pull-right" href="{{URL::action('LoginController@getRegister')}}" class="text-center">{{__(Lang::get('login.register'))}}</a>
            </div>
        </form>
    </div>
@stop