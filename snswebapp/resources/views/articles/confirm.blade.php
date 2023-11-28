@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-edit"></i> @lang('strings.write_articles')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('strings.confirm')</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 mb-12">
        {{Form::open([
            'name' => 'articles',
            'url' => '/articles/register',
            'method' => $method,
            'files' => true,
            'enctype' => 'multipart/form-data'
        ])}}
        @csrf

        @include('articles.formset.viewControl', compact('articles'))

        @if (isset($articles->id))
            {{Form::hidden('id', $articles->id)}}
        @endif

        {{Form::hidden('title', $articles->title)}}
        {{Form::hidden('body', $articles->body)}}
        <div class="col-auto mb-5 text-center">
            <a href="javascript:articles.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.save')
            </a>
            <a href="javascript:window.history.back();" class="btn btn-secondary shadow-sm btn-edit-cancel-save">
                <i class="fas fa-window-close fa-sm text-white-50"></i>@lang('strings.cancel')
            </a>
        </div>
    </div>
</div>
{{Form::close()}}

@endsection