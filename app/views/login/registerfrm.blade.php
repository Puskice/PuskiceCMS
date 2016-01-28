@section('form')    
    <div class="form-box" id="login-box">
        <div class="header">{{__(Lang::get('login.register'))}}</div>
        <form action="{{_l(URL::action('LoginController@postRegister'))}}" method="post">
            <div class="body bg-gray">
                @yield('errorReporting')
                <div class="form-group">
                    <input type="text" name="firstName" class="form-control" placeholder="{{__(Lang::get('login.firstName'))}}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="lastName" class="form-control" placeholder="{{__(Lang::get('login.lastName'))}}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="{{__(Lang::get('login.username'))}}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="{{__(Lang::get('login.email'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{__(Lang::get('login.password'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="repeatPassword" class="form-control" placeholder="{{__(Lang::get('login.repeatPassword'))}}"/>
                </div>
            </div>
            <div class="footer">                    
                <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
                <button type="submit" class="btn bg-olive btn-block">{{__(Lang::get('login.register'))}}</button>

                <a href="{{URL::action('LoginController@getIndex')}}" class="text-center">{{__(Lang::get('login.alreadyMember'))}}</a>
            </div>
        </form>
    </div>
@stop