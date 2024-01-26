@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i> @lang('strings.write_articles')</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-12 mb-12">
        {{Form::open([
            'name' => 'article',
            'url' => '/articles/confirm',
            'method' => 'post',
            'files' => true,
            'enctype' => 'multipart/form-data'
        ])}}
        @csrf

        @include('articles.formset.editControl')

        {{Form::close()}}
    </div>
</div>

<!-- Summernote -->
@include('shared.summernote')
@endsection