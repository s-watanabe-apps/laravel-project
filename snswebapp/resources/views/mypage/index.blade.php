@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject"><i class="fas fa-seedling"></i> @lang('strings.mypage')</div>

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">
            @include('mypage.formset.account_settings', [
                'email' => $user['email'],
                'attributes' => ['disabled'],
                'change_link' => '/mypage/account',
            ])

            @include('mypage.formset.basic_settings', [
                'user' => $user,
                'attributes' => ['disabled'],
                'change_link' => '/mypage/basic',
            ])

        </div>
        <div class="vertical-contents w-50">
            <div class="title">@lang('strings.security')</div>
            <div class="input-label">@lang('strings.password') @lang('strings.updated_at')</div>
            {{Form::input('text', 'password_updated_at', str_date_format($user['password_updated_at']), ['disabled'])}}
            <div class="grid-contents"><a href="/mypage/password">@lang('strings.change')</a></div>
        </div>
    </div>
</div>

@endsection