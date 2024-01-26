@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-edit"></i> @lang('strings.write_articles') &gt; @lang('strings.confirm')</div>

    {{Form::open([
        'name' => 'article',
        'url' => '/articles/register',
        'method' => 'post',
        'files' => true,
        'enctype' => 'multipart/form-data'
    ])}}

    @include('articles.formset.viewControl', compact('validated', 'labels'))

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