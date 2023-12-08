@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-images"></i> @lang('strings.pictures')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('strings.upload')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 px-3 pb-4">
        <img id="preview" class="img-preview pb-2" />
        <input type="file" id="inputfile" name="image" value="@lang('strings.choose_file')" accept=".jpg, .png" />
        <div class="text-danger" id="inputfile_error"></div>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <th class="w-25">
                        @lang('strings.title')
                    </th>
                    <td class="w-75">
                        {{Form::input('text', 'title', old('title'), [
                            //'placeholder' => __('strings.title'),
                            'class' => 'w-100',
                        ])}}
                    </td>
                </tr>
                <tr>
                    <th>
                        @lang('strings.contributor')
                    </th>
                    <td>
                        <textarea name="comment" rows="6" class="form-control"></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="col-12 text-center">
            <a href="#" id="uploadConfirmButton" class="btn btn-success shadow-sm w-25">
                <i class="fas fa-check fa-sm"></i> @lang('strings.confirm')
            </a>
        </div>
    </div>

</div>

<div class="modal fade" id="uploadConfirm" tabindex="-1" role="dialog" aria-labelledby="uploadConfirmLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h6 modal-title" id="uploadConfirmLabel">@lang('strings.confirm')</div>
                <button type="button" id="uploadClose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="preview_confirm" class="img-preview" />
            </div>
            <div class="modal-footer">
                <button type="button" id="uploadCancel" class="btn btn-secondary" data-dismiss="modal">@lang('strings.cancel')</button>
                <a href="javascript:picturesPost.submit()" type="button" class="btn btn-success" aria-label="Close">
                    <i class="fas fa-upload fa-sm"></i> @lang('strings.upload')
                </a>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $("#inputfile").on('change', function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr('src', e.target.result);
            $("#preview_confirm").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);   
    });

    $("#uploadConfirmButton").on('click', function (e) {
        let error = document.getElementById('inputfile_error');
        if ($("#inputfile").val() == "") {
            error.innerText = "{{__('strings.errors.upload_image_unselected')}}";
        } else {
            error.innerText = "";
            $('#uploadConfirm').modal('show');
        }
    });

    $("#uploadCancel").on('click', function (e) {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#uploadConfirm').modal('hide'); 
    });

    $("#uploadClose").on('click', function (e) {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
        $('#uploadConfirm').modal('hide'); 
    });

});
</script>

@endsection