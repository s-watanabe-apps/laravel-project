@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-edit"></i> @lang('strings.write_articles')</div>

    {{Form::open([
        'name' => 'article',
        'url' => '/articles/confirm',
        'method' => 'post',
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