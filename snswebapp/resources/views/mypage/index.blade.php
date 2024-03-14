@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-seedling"></i> @lang('strings.mypage')</div>

    <div class="title">アカウント設定</div>

    <div class="input-label">@lang('strings.email')</div>
    {{Form::input('text', 'email', $user['email'], ['disabled', 'style' => 'width: 40%;'])}} <span><a href="/mapage/emailchange">変更する</a></span>

    <div class="input-label">パスワード最終更新日</div>
    {{Form::input('text', 'password_updated_at', $user['updated_at'], ['disabled', 'style' => 'width: 40%;'])}} <span><a href="/mapage/passwordchange">変更する</a></span>

    <div class="title">基本情報</div>
    <div class="input-label">@lang('strings.name')</div>
    {{Form::input('text', 'name', $user['name'], ['disabled', 'style' => 'width: 40%;'])}}

</div>

@endsection