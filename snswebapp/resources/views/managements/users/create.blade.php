@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <span><a href="/managements/users"><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</a></span>
        <span>&gt; @lang('strings.add')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/users/comfirm',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    @include('mypage.formset.account_settings', [
        'email' => '',
        'attributes' => [],
        'change_link' => false,
    ])

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}

</div>

@endsection