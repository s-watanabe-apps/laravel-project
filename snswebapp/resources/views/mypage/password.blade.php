@extends('app')
@section('content')

<div class="contents mypage">
    <div class="subject">
        <a href="/mypage"><i class="fas fa-seedling"></i> @lang('strings.mypage')</a>
        &gt; @lang('strings.password_change')</div>

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">

            <div class="title">@lang('strings.current_password')</div>
            <div class="input-label">@lang('strings.password')</div>
            {{Form::input('password', 'password', '', [])}}

            <div class="title">@lang('strings.new_password')</div>
            <div class="input-label">@lang('strings.password')</div>
            {{Form::input('password', 'new_password', '', [])}}

            <div class="input-label">@lang('strings.confirm')</div>
            {{Form::input('password', 'new_password_confirm', '', [])}}

            <div class="flex-contents">
                <input type="submit" class="post" value="@lang('strings.save')"></input>
                <a href="javascript:window.history.back();">
                    <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection