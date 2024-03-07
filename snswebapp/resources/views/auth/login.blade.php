<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$settings['site_name']}}</title>

    @include('style')
    @include('auth.style', compact('settings'))
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
                @if ($settings['user_create_any'] == 1)
                <div><small><a href="/register">@lang('auth.create_account')</a></div>
                @endif

            </div>
        </div>
    </div>
</body>
</html>