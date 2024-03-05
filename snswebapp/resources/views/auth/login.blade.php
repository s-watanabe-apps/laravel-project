<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('style')

<style>
/* Login */
.login-container {
    width: 644px;
    height: 100%;
    min-height: 300px;
    margin: auto auto auto auto;
    border-radius: 5px;
    background: {{$settings['background_color']}};
    border: solid 1px {{$settings['border_color']}};
}

form {
    padding: 5px 0 5px 0;
    display: grid;
}

input {
    margin: 5px;
}

.text-danger {
    margin: 0 5px 0 5px;
}

.subject {
    text-align: center;
    border: 0px;
}

input[type = "submit"] {
    margin: 10px 0 0 0;
}
</style>
</head>
<body style="border: none;">
    <div class="login-container">
        <div class="grid-contents">
            <div class="w-50 pc">
                <img
                    src="/images/login/{{$settings['login_file_name']}}"
                    style="width: 100%; object-fit: cover;" />
            </div>
            <div class="w-50">
                <div class="subject">{{$settings['site_name']}}</div>
                {{Form::open([
                    'url' => route('login'),
                    'method' => 'post',
                    'name' => 'login',
                ])}}
                    @csrf

                    {{Form::input('text', 'email', '', ['placeholder' => __('strings.email')])}}
                    <div class="text-danger">{{$errors->first('email') ?? ''}}</div>

                    {{Form::input('password', 'password', '', ['placeholder' => __('strings.password')])}}
                    <div class="text-danger">{{$errors->first('password') ?? ''}}</div>

                    <div class="text-danger">{{$faild ?? ''}}</div>

                    <div>
                        <input name="remember" type="checkbox" id="customCheck" />
                        <label for="customCheck"><small>@lang('auth.password_remember')</small></label>
                    </div>

                    <div class="flex-contents">
                        <input type="hidden" name="redirect" value="{{session('redirect')}}" />
                        <input type="submit" value="@lang('auth.login')" />
                    </div>
                {{Form::close()}}
                <hr>
                <div><small><a href="/password/email">@lang('auth.forgot_password_link')</a></small></div>
                <div><small><a href="/register">@lang('auth.create_account')</a></div>

            </div>
        </div>
    </div>
</body>
</html>