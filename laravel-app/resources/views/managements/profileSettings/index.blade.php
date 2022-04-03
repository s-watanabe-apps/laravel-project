@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="formset" hidden>
        @include('managements.profileSettings.formset', [
            'types' => $types,
            'profile' => null,
        ])
    </div>

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

    <!-- Button trigger modal -->
    <div class="col-md-12 col-12 text-right">
        <a href="#" data-toggle="modal" data-target="#exampleModal">@lang('strings.input_type_description_link')</a>
    </div>

    <div id="items">
        @foreach ($profiles as $profile)
            @include('managements.profileSettings.formset', [
                'types' => $types,
                'profile' => $profile,
            ])
        @endforeach
    </div>
    <button class="btn-add" type="button">@lang('strings.add')</button>

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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('strings.input_type_description_link')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
    $("#items").append($("#formset").children().clone());
});
</script>

@endsection