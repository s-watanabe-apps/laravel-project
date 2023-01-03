@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <div id="formset" hidden>
        @include('managements.groups.formset', [])
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

    {{Form::open(['name' => 'form', 'url' => '/managements/groups/register', 'method' => 'post', 'files' => true])}}
    @csrf

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i>@lang('strings.navigation_management')</li>
            </ol>
        </nav>
    </div>

    <div id="items">
        @foreach ($groups as $index => $group)
            @include('managements.groups.formset', compact('group'))
        @endforeach
    </div>
    <button id="btn-add" class="btn-add" type="button">@lang('strings.add')</button>

    <div class="row">
        <div class="col-12 mb-5 text-center">
            <a href="javascript:form.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
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
        $('#toastMessage').text('@lang('strings.operation_messages.saved_navigation_menus')');
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