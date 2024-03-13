@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-seedling"></i> @lang('strings.mypage')</div>

    <div class="title">アカウント設定</div>
    <div class="input-label">@lang('strings.email')</div>
    {{Form::input('text', 'email', $user['email'], ['disabled'])}}

    <div class="input-label">パスワード最終更新日</div>
    {{Form::input('text', 'password_updated_at', $user['updated_at'], ['disabled'])}}
</div>

@endsection