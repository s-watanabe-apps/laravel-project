@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="formSet" class="card bg-light text-black shadow mb-3" hidden>
        <div class="row card-body">
            <div class="col-md-2 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.input_type')</span>
            </div>
            <div class="col-md-4 col-8 pb-2">
                <select name="types[]" class="btn btn-secondary dropdown-toggle">
                    @foreach ($types as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row col-md-6 col-12">
                <div class="col-md-2 col-4 pt-2">
                    <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
                </div>
                <div class="col-md-10 col-8 pt-1 pb-2">
                    {{Form::input('text', 'input_type_column_names[]', '', [
                        'style' => 'width: 100%;',
                        'class' => 'ml-2'
                    ])}}
                </div>
                <div class="col-md-2 col-4 pt-2">
                    <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
                </div>
                <div class="col-md-10 col-8 pt-1 pb-2">
                    {{Form::input('number', 'input_type_column_orders[]', '', [
                        'style' => 'width: 100%;',
                        'class' => 'ml-2',
                    ])}}
                </div>
            </div>
        </div>
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
        <div id="formSet" class="card bg-light text-black shadow mb-3">
            <div class="row card-body">
                <div class="col-md-2 col-4 pt-2">
                    <span class="h6 text-nowrap">@lang('strings.input_type')</span>
                </div>
                <div class="col-md-4 col-8 pb-2">
                    <select name="types[]" class="btn btn-secondary dropdown-toggle">
                        @foreach ($types as $key => $value)
                        <option value="{{$key}}"
                        @if ($key == $profile->type)
                            selected
                        @endif
                        >{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row col-md-6 col-12">
                    <div class="col-md-2 col-4 pt-2">
                        <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
                    </div>
                    <div class="col-md-10 col-8 pt-1 pb-2">
                        {{Form::input('text', 'input_type_column_names[]', $profile->name, [
                            'style' => 'width: 100%;',
                            'class' => 'ml-2'
                        ])}}
                    </div>
                    <div class="col-md-2 col-4 pt-2">
                        <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
                    </div>
                    <div class="col-md-10 col-8 pt-1 pb-2">
                        {{Form::input('number', 'input_type_column_orders[]', $profile->order, [
                            'style' => 'width: 100%;',
                            'class' => 'ml-2',
                        ])}}
                    </div>
                </div>
            </div>
        </div>
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
    $("#items").append($("#formSet").clone().removeAttr("hidden"));
});
</script>

@endsection