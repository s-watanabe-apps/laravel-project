@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; @lang('strings.add')</span>
        <span>&gt; @lang('strings.confirm')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/informations/confirm',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    <div class="vertical-contents">
        <div class="input-label">@lang('strings.class')</div>
        <div><i class="fas fa-fw {{$mark['mark']}}"></i> {{__('strings.information_marks')[$mark['mark']]}}</div>
        
        <div class="input-label">@lang('strings.title')</div>
        <div>{{$values['title']}}

        <div class="input-label">@lang('strings.body')</div>
        <div class="text-preview">{!!$values['body'] ?? '<br>'!!}</div>

        <div class="input-label">@lang('strings.start_time')</div>
        <div>{{str_datetime_format($values['start_time'])}}</div>

        <div class="input-label">@lang('strings.end_time')</div>
        <div>{{str_datetime_format($values['end_time'])}}</div>
        
        <div class="input-label">@lang('strings.status')</div>
        <div>
            @if ($values['status'] == \Status::ENABLED)
            <span class="enable">@lang('strings.enable')</span>
            @else
            <span class="disable">@lang('strings.disable')</span>
            @endif
        </div>
        
    </td>

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}
</div>

@endsection