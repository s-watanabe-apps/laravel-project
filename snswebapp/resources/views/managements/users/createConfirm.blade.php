@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <span><a href="/managements/users"><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</a></span>
        <span>&gt; @lang('strings.add')</span>
        <span>&gt; @lang('strings.confirm')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/users/sendmail',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">
            @include('mypage.formset.account_settings', [
                'email' => $validated['email'],
                'change_link' => false,
            ])
            {{Form::hidden('email', $validated['email'])}}
            
            @include('mypage.formset.basic_settings', [
                'user' => $validated,
                'is_edit' => false,
                'change_link' => false,
            ])
            {{Form::hidden('name', $validated['name'])}}
            {{Form::hidden('birthdate', $validated['birthdate'])}}
            {{Form::hidden('role_id', $validated['role_id'])}}
            {{Form::hidden('group_code', $validated['group_code'])}}
            
            <div class="flex-contents tb-margin">
                <div class="post-box">
                    @lang('strings.alert_messages.invitation_confirm')
                </div>
                <input type="submit" class="post" value="@lang('strings.send')"></input>
                <a href="javascript:window.history.back();">
                    <input type="button" class="cancel" value="@lang('strings.return')"></input>
                </a>
            </div>
        </div>
    </div>

    {{Form::close()}}

</div>

@endsection