<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('style')

<style>
/* Login */
.login-container {
    width: 65%;
    height: 100%;
    min-height: 300px;
    min-width: 496px;
    margin: auto auto auto auto;
    background: {{$settings['background_color']}};
    border: solid 1px {{$settings['border_color']}};
}
</style>
</head>
<body style="border: none;">
    <div class="login-container">
        <div class="grid-contents">
            <div class="w-50">
                <img
                    src="/images/login/{{$settings['login_file_name']}}"
                    style="width: 100%; object-fit: cover;" />
            </div>
            <div class="w-50">
                <div class="subject">{{$settings['site_name']}}</div>
                {{Form::open([
                    'url' => route('login'),
                    'method' => 'post',
                    'class' => 'user',
                ])}}
                    @csrf

                    <div class="vertical-contents">
                        <div class="vertical-contents">
                            {{Form::input('text', 'email', '', ['placeholder' => __('strings.email')])}}
                            <div class="text-danger">{{$errors->first('email') ?? ''}}</div>
                        </div>

                        <div class="vertical-contents">
                            {{Form::input('password', 'password', '', ['placeholder' => __('strings.password')])}}
                            <div class="text-danger">{{$errors->first('password') ?? ''}}</div>
                        </div>

                        <div class="text-danger">{{$faild ?? ''}}</div>

                        <div class="flex-contents">
                            <input name="remember" type="checkbox" id="customCheck" />
                            <label for="customCheck">@lang('auth.password_remember')</label>
                        </div>

                        <input type="hidden" name="redirect" value="{{session('redirect')}}" />
                        <input type="submit" value="@lang('auth.login')" />
                    </div>
                {{Form::close()}}
                <hr>
                <a class="small" href="/password/email">@lang('auth.forgot_password_link')</a><br>
                <a class="small" href="register.html">Create an Account!</a>

            </div>
        </div>
    </div>
</body>
</html>