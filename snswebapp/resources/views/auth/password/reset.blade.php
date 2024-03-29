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
                <div class="subject">@lang('auth.reset_password_title')</div>
                {{Form::open([
                    'url' => '/password/reset',
                    'method' => 'post',
                ])}}
                    @csrf

                    <div class="text">@lang('auth.reset_password_message')</div>
                    {{Form::input('password', 'password', '', ['placeholder' => __('auth.new_password')])}}
                    <div class="text-danger">{{$errors->first('password') ?? ''}}</div>

                    {{Form::input('password', 'password_confirm', '', ['placeholder' => __('auth.confirm_password')])}}
                    <div class="text-danger">{{$errors->first('password_confirm') ?? ''}}</div>

                    @if ($result)
                        <div class="text-primary">@lang('auth.reset_password_success')</div>
                    @else
                        <div class="text-danger">@lang('auth.reset_password_faild')</div>
                    @endif

                    <div class="flex-contents">
                        <input type="hidden" name="token" value="{{$token ?? ''}}" />
                        <input type="submit" value="@lang('strings.reset_password')" />
                    </div>
                {{Form::close()}}
                <hr>
                <div><small><a href="/login">@lang('auth.return_to_login')</a></small></div>
                @if ($settings['user_create_any'] == 1)
                <div><small><a href="/register">@lang('auth.create_account')</a></div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>