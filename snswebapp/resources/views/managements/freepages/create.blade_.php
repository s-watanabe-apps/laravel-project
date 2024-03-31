@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i> @lang('strings.freepage_management')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">

    <!-- Tab Control -->
    @include('managements.freepages.formset.tabControl', ['index' => 2])

    <div class="col-lg-10 px-0 px-lg-2">
        {{Form::open([
            'name' => 'freepages',
            'url' => '/managements/freepages/confirm',
            'method' => 'post',
        ])}}
        @csrf

        <!-- Edit Control -->
        @include('managements.freepages.formset.editControl', compact('code'))

        <a href="javascript:freepages.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
            <i class="fas fa-check fa-sm"></i> @lang('strings.do_confirm')
        </a>
        {{Form::close()}}
    </div>

</div>

<!-- Summernote -->
@include('shared.summernote')

@endsection