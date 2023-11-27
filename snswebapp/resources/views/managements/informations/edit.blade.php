@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-info-circle"></i>@lang('strings.informations_management')</li>
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
            'url' => '/managements/informations/confirm',
            'method' => 'put',
        ])}}
        @csrf

        {{Form::hidden('id', $informations->id)}}

        @include('managements.informations.formset.editControl', compact('informations', 'informationMarks'))

        <a href="javascript:informations.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
            <i class="fas fa-check fa-sm"></i> @lang('strings.do_confirm')
        </a>
        {{Form::close()}}
    </div>
</div>

<!-- Summernote -->
@include('shared.summernote')

<script>
window.addEventListener("load", function() {
    $('#start_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
    $.datetimepicker.setLocale('ja');
});

window.addEventListener("load", function() {
    $('#end_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
    $.datetimepicker.setLocale('ja');
});
</script>

@endsection