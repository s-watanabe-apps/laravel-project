@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <span><a href="/managements/users"><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</a></span>
        <span>&gt; @lang('strings.add')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/users/confirm',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">

            @include('mypage.formset.account_settings', [
                'email' => '',
                'attributes' => [],
                'change_link' => false,
            ])

            @include('mypage.formset.basic_settings', [
                'user' => [],
                'attributes' => [],
                'change_link' => false,
                'groups' => $groups,
            ])

            <div class="flex-contents tb-margin">
                <input type="submit" class="post" value="@lang('strings.confirm')"></input>
                <a href="/managements/users">
                    <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
                </a>
            </div>

        </div>
    </div>

    {{Form::close()}}

</div>

@endsection