@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-file-text-o"></i>@lang('strings.freepage_management')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row mx-1">

        <!-- Tab Control -->
        @include('managements.freepages.tabControl', ['index' => 2])

        <div class="col-lg-10 px-0 px-lg-2">
            {{Form::open(['name' => 'informations', 'url' => '/managements/freepages/confirm', 'method' => 'post', 'files' => true])}}
            @csrf

            <div class="mb-3">
                <div class="h6 font-weight-bold">@lang('strings.title')</div>
                {{Form::text(
                    'title',
                    old('title'),
                    ['id' => 'title', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </div>

            <div class="mb-3">
                <div class="h6 font-weight-bold">@lang('strings.free_page_code')</div>
                {{Form::text(
                    'free_page_code',
                    $freePageCode ?? old('free_page_code'),
                    ['id' => 'free_page_code', 'class' => 'form-control']
                )}}
                <div class="text-danger">{{$errors->first('free_page_code') ?? ''}}</div>
            </div>

            <div class="mb-4">
                <div class="h6 font-weight-bold">@lang('strings.body')</div>
                <textarea class="form-control" name="body" id="summernote" id="summernote">{{old('body')}}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </div>

            <a href="javascript:informations.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm"></i> @lang('strings.do_confirm')
            </a>
            {{Form::close()}}
        </div>

    </div>
</div>
<!-- /.container-fluid -->

<!-- Summernote -->
@include('shared.summernote')

@endsection