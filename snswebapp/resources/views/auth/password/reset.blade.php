<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
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
                <div class="subject">@lang('auth.forgot_password_title')</div>
                {{Form::open([
                    'url' => '/password/reset',
                    'method' => 'post',
                ])}}
                    @csrf

                    <div class="text">@lang('auth.forgot_password_message')</div>
                    {{Form::input('text', 'email', '', ['placeholder' => __('strings.email')])}}
                    <div class="text-danger">{{$errors->first('email') ?? ''}}</div>

                    <div class="text-primary">{{$result_message ?? ''}}</div>

                    <div class="flex-contents">
                        <input type="submit" value="@lang('strings.send')" />
                    </div>
                {{Form::close()}}
                <hr>
                <div><small><a href="/password/reset">@lang('auth.forgot_password_link')</a></small></div>
                <div><small><a href="/register">@lang('auth.create_account')</a></div>
            </div>
        </div>
    </div>
</body>
</html>