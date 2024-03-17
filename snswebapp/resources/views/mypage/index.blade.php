@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject"><i class="fas fa-seedling"></i> @lang('strings.mypage')</div>

    <div class="title">アカウント設定</div>
    <div class="input-label">@lang('strings.email')</div>
    {{Form::input('text', 'email', $user['email'], ['disabled'])}} <span><a href="/mapage/emailchange">変更する</a></span>

    <div class="input-label">パスワード最終更新日</div>
    {{Form::input('text', 'password_updated_at', str_date_format($user['password_updated_at']), ['disabled'])}} <span><a href="/mapage/passwordchange">変更する</a></span>

    <div class="title">基本情報</div>
    <div class="input-label">@lang('strings.name')</div>
    {{Form::input('text', 'name', $user['name'], ['disabled'])}}

    <div class="input-label">@lang('strings.birth_date')</div>
    {{Form::input('text', 'birthdate', str_date_format($user['birthdate']), ['disabled'])}}

    <div class="input-label">@lang('strings.role')</div>
    {{Form::input('text', 'role', __('strings.roles.' . $user['role_name']), ['disabled'])}}

    <div class="input-label">@lang('strings.group')</div>
    {{Form::input('text', 'group_name', $user['group_name'], ['disabled'])}}
</div>

@endsection