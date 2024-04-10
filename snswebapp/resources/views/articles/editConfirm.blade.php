@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/articles/{{$validated['id']}}"><i class="fas fa-blog"></i> {{$validated['title']}}</a></span>
        <span>&gt; @lang('strings.edit')</span>
        <span>&gt; @lang('strings.confirm')</span>
    </div>

    {{Form::open([
        'name' => 'article',
        'url' => '/articles/save',
        'method' => 'put',
        'files' => true,
        'enctype' => 'multipart/form-data'
    ])}}

    {{Form::hidden('id', $validated['id'])}}
    @include('articles.formset.viewForm', compact(
        'validated', 'labels'
    ))

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.registration')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}

    </div>
</div>

@endsection