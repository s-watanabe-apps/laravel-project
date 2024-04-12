@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/articles/{{$articles['id']}}"><i class="fas fa-blog"></i> {{$articles['title']}}</a></span>
        <span>&gt; @lang('strings.delete')</span>
    </div>

    {{Form::open([
        'url' => '/articles/delete',
        'method' => 'delete',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    {{Form::hidden('id', $articles['id'])}}
    <div class="text-preview">{!!$articles['body'] ?? '<br>'!!}</div>
    <div class="vertical-contents">
        <div class="alert-box">@lang('strings.alert_messages.delete_confirm')</div>

        <div class="flex-contents">
        <input type="submit" class="delete" value="@lang('strings.delete')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.return')"></input>
        </a>
    </div>

    </div>


    {{Form::close()}}

    </div>
</div>

@endsection