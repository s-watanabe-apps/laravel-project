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
            {{Form::open(['name' => 'freepages', 'url' => '/managements/freepages/register', 'method' => 'post', 'files' => true])}}
            @csrf


            {{$values['title']}}
            {{Form::hidden('title', $values['title'])}}

            {{$values['code']}}
            {{Form::hidden('code', $values['code'])}}

            {{$values['body']}}
            {{Form::hidden('body', $values['body'])}}


            <a href="javascript:freepages.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm"></i> @lang('strings.save')
            </a>
            {{Form::close()}}
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection