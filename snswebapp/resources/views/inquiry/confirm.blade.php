@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-paper-plane"></i> @lang('strings.contact_admin')</div>

    {{Form::open([
        'name' => 'inquiry',
        'url' => '/inquiry/send',
        'method' => 'post',
    ])}}
    @csrf

    @foreach($validated as $key => $value)
    {{Form::hidden($key, $value)}}
    @endforeach

    <div class="vertical-contents">
        <div class="input-label">@lang('strings.inquiry_type')</div>
        <div>{{$types[$validated['type']]}}</div>

        @if (!auth()->check())
        <div class="input-label">@lang('strings.email')</div>
        <div>{{$validated['email']}}</div>
        <div class="input-label">@lang('strings.name')</div>
        <div>{{$validated['name']}}</div>
        @endif

        <div class="input-label">@lang('strings.inquiry_body')</div>
        <div class="text-preview">{{$validated['text']}}</div>

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.send')"></input>
            <a href="javascript:window.history.back();">
                <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
            </a>
        </div>
    </div>

    {{Form::close()}}
</div>

@endsection