<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('style')
</head>
<body style="border: none;">
    <div class="container">
        <div class="grid-contents">
            <div class="w-50">
                aaa
            </div>
            <div class="w-50">
                aaa
            </div>
        </div>
    </div>
    {{Form::open([
        'url' => route('login'),
        'method' => 'post',
        'class' => 'user',
    ])}}
        @csrf

        {{Form::input('text', 'email', '', [])}}
        <div class="text-danger">{{$errors->first('email') ?? ''}}</div>

        {{Form::input('password', 'password', '', [])}}
        <div class="text-danger">{{$errors->first('password') ?? ''}}</div>

        <div class="text-danger">{{$faild ?? ''}}</div>

        <input name="remember" type="checkbox" id="customCheck" />
        <label for="customCheck">@lang('auth.password_remember')</label>

        <input type="hidden" name="redirect" value="{{session('redirect')}}" />
        <input type="submit" value="@lang('auth.login')" />
    {{Form::close()}}
    <hr>
    <a class="small" href="/password/email">@lang('auth.forgot_password_link')</a>
    <a class="small" href="register.html">Create an Account!</a>
</body>
</html>