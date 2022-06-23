@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    {{Form::open(['name' => 'article', 'url' => '/articles/confirm', 'method' => 'post', 'files' => true, 'enctype' => 'multipart/form-data'])}}
    @csrf
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i>@lang('strings.write_articles')</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-12">
            <table class="table table-bordered responsive-table">
                <tbody>
                    <tr>
                        <th class="text-secondary text-nowrap">@lang('strings.title')</th>
                        <td>
                            <input type="text" name="title" class="form-control" id="title" placeholder="">
                            <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-secondary text-nowrap">@lang('strings.article_body')</th>
                        <td>
                            <textarea class="form-control" name="body" id="summernote"></textarea>
                            <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="col-auto mb-5 text-center">
                <a href="javascript:article.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                    <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.confirm')
                </a>
            </div>

        </div>

    </div>        
    {{Form::close()}}
</div>
<!-- /.container-fluid -->

<!-- Summernote -->
@include('shared.summernote')
@endsection