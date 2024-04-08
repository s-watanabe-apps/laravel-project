@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <span><a href="/managements/users"><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</a></span>
        <span>&gt; {{$user['name']}}</span>
    </div>

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">

            @include('mypage.formset.account_settings', [
                'email' => $user['email'],
                'is_edit' => false,
                'change_link' => "/managements/users/account/{$user['id']}",
            ])

            @include('mypage.formset.basic_settings', [
                'user' => $user,
                'is_edit' => false,
                'change_link' => "/managements/users/basic/{$user['id']}",
            ])
            
        </div>
    </div>

</div>

@endsection