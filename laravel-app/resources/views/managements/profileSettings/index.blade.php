@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="formSet" hidden><input type="text" name="test[]"></input></div>

    {{Form::open(['name' => 'profileSettings', 'url' => '/managements/profile/settings/post', 'method' => 'post', 'files' => true])}}
    @csrf

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-user-edit"></i>@lang('strings.profile_settings')</li>
            </ol>
        </nav>
    </div>

    <div id="items"></div>
    <button class="btn-add" type="button">+</button>

    <div class="row">
        <div class="col-12 mb-5 text-center">
            <a href="javascript:profileSettings.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm"></i> @lang('strings.save')
            </a>
        </div>
    </div>
    {{Form::close()}}
</div>
<!-- /.container-fluid -->

<!-- Toast -->
@include('shared.toast')
@if (Session::get('result') == 1)
<script>
    $(window).on('load', function() {
        $('#toastMessage').text('@lang('strings.operation_messages.saved_profile_settings')');
        $('#toast').toast('show');
    });
</script>
@endif

<script>
$(".btn-add").click(function () {
    //console.log($("#formSet"));
    $("#items").append($("#formSet").clone().removeAttr("hidden"));
});
</script>

@endsection