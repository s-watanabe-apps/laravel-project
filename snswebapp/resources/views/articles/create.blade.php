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

    @include('articles.formset.editControl')

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
    </div>

    {{Form::close()}}
</div>

<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<script>
editor = CKEDITOR.replace('editor', {
    contentsCss: '/css/editor.css',
    uiColor: '#EEEEEE',
    height: 400,
});
editor.name = 'body';
console.log(editor);
</script>

@endsection