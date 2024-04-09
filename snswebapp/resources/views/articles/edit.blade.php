@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/articles/{{$articles['id']}}"><i class="fas fa-blog"></i> {{$articles['title']}}</a></span>
        <span>&gt; @lang('strings.edit')</span>
    </div>

    {{Form::open([
        'name' => 'article',
        'url' => '/articles/confirm',
        'method' => 'put',
        'files' => true,
        'enctype' => 'multipart/form-data'
    ])}}

    @include('articles.formset.editForm')

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
    </div>

    {{Form::close()}}
</div>

@include('shared.ckeditor', ['name' => 'body'])

@endsection