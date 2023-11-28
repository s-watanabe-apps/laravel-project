@extends('layouts.app')
@section('content')
<div id="formset" hidden>
    @include('managements.profileSettings.formset', [
        'types' => $types,
        'profile' => null,
    ])
</div>

@if ($errors->any())
<div class="text-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{{Form::open(['name' => 'profileSettings', 'url' => '/managements/profile/settings/post', 'method' => 'post', 'files' => true])}}
@csrf

<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-user-edit"></i> @lang('strings.profile_settings')</li>
        </ol>
    </nav>
</div>

<!-- Button trigger modal -->
<div class="col-md-12 col-12 text-right">
    <a href="#" data-toggle="modal" data-target="#exampleModal">@lang('strings.input_type_description_link')</a>
</div>

<div id="items">
    @foreach ($profiles as $index => $profile)
        @include('managements.profileSettings.formset')
    @endforeach
</div>
<button id="btn-add" class="btn-add" type="button">@lang('strings.add')</button>

<div class="row">
    <div class="col-12 mb-5 text-center">
        <a href="javascript:profileSettings.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
            <i class="fas fa-check fa-sm"></i> @lang('strings.save')
        </a>
    </div>
</div>
{{Form::close()}}

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
$(document).on('click', 'button#btn-add', function(){
    //console.log("button#btn-add.click");
    $("#items").append($("#formset").children().clone(true));
});

$(document).on('click', 'button#btn-delete', function(){
    //console.log("button#btn-delete.click");
    var index = $("button#btn-delete").index(this);
    $('div#formset-contents').eq(index).remove();
});

$(document).on('change', 'select#type', function(){
    //console.log("select#type.change");
    var index = $("select#type").index(this);
    if ($(this).val() == {{App\Libs\ProfileInputType::CHOICE}}) {
        console.log(index);
        $('div#select_list_name').eq(index).css('display', 'inline');
        $('div#select_list_value').eq(index).css('display', 'inline');
    } else {
        $('div#select_list_name').eq(index).css('display', 'none');
        $('div#select_list_value').eq(index).css('display', 'none');
    }
});

</script>

@endsection