@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">

    <!-- Tab Control -->
    @include('managements.informations.formset.tabControl', ['index' => 2])

    <div class="col-lg-10 px-0 px-lg-2">
        {{Form::open([
            'name' => 'informations',
            'url' => '/managements/informations/register',
            'method' => $method,
        ])}}
        @csrf

        @if (isset($informations->id))
            {{Form::hidden('id', $informations->id)}}
        @endif

        @include('managements.informations.formset.viewForm', compact('informations', 'informationMark'))

        <a href="javascript:informations.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
            <i class="fas fa-check fa-sm"></i> @lang('strings.save')
        </a>
        {{Form::close()}}
    </div>
</div>
@endsection