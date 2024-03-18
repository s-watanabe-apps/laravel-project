@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject"><i class="fas fa-seedling"></i> @lang('strings.mypage')</div>

    @include('mypage.formset.account_settings', [
        'email' => $user['email'],
        'attributes' => ['disabled'],
        'change_link' => true,
    ])

    <div class="title">@lang('strings.security')</div>
    <div class="input-label">@lang('strings.password') @lang('strings.updated_at')</div>
    {{Form::input('text', 'password_updated_at', str_date_format($user['password_updated_at']), ['disabled'])}} <span><a href="/mapage/passwordchange">@lang('strings.change')</a></span>

    <div class="title">@lang('strings.basic_settings')</div>
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