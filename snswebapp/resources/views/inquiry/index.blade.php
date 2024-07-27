@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-paper-plane"></i> @lang('strings.contact_admin')</div>

    {{Form::open([
        'name' => 'inquiry',
        'url' => '/inquiry/confirm',
        'method' => 'post',
    ])}}

    <div class="vertical-contents">
        <div class="input-label">@lang('strings.inquiry_type')</div>
        <select name="type">
            @foreach($types as $id => $value)
            <option value="{{$id}}">{{$value}}</option>
            @endforeach
        </select>
        <div class="text-danger">{{$errors->first('type') ?? ''}}</div>

        @if (!auth()->check())
        <div class="input-label">@lang('strings.email')</div>
        {{Form::input('text', 'email', $email ?? '', [])}}
        <div class="text-danger">{{$errors->first('email') ?? ''}}</div>
        <div class="input-label">@lang('strings.name')</div>
        {{Form::input('text', 'name', $name ?? '', [])}}
        <div class="text-danger">{{$errors->first('name') ?? ''}}</div>
        @endif

        <div class="input-label">@lang('strings.inquiry_body')</div>
        <textarea name="body" style="resize: vertical; padding: 5px;" rows="30"></textarea>
        <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        </div>
    </div>

    {{Form::close()}}
</div>

@endsection