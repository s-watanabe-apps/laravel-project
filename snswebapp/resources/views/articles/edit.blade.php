@extends('layouts.app')
@section('content')
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i>@lang('strings.write_articles')</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 mb-12">
        {{Form::open([
            'name' => 'article',
            'url' => '/articles/confirm',
            'method' => 'put',
            'files' => true,
            'enctype' => 'multipart/form-data'
        ])}}
        @csrf

        @include('articles.formset.editControl', compact('articles'))

        {{Form::hidden('id', $articles->id)}}
        {{Form::close()}}
    </div>
</div>

<!-- Summernote -->
@include('shared.summernote')
@endsection