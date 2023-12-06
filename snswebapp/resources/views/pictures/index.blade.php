@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="card">
    <!-- Card Header - Accordion -->
    <a href="#expand" class="d-block card-header p-0" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
        <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold p-0 m-0">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-images"></i> @lang('strings.pictures')</li>
            </ol>
        </nav>
    </a>
    
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="expand">
        <div class="d-block card-body p-0">
            <table class="table responsive-table">
                <tbody>
                    <tr>
                        <td style="width: 50%">
                            {{Form::open([
                                'name' => 'picturesSearch',
                                'url' => '/pictures',
                                'method' => 'get',
                            ])}}
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-4">
                                    <span>@lang('strings.keyword')</span>
                                </div>
                                <div class="col-lg-9 col-md-8 col-8 pb-2">
                                    {{Form::input('text', 'keyword', $validated['keyword'], [
                                        'style' => 'width: 100%;'
                                    ])}}
                                </div>
                                <div class="col-lg-3 col-md-4 col-4">
                                    <span>@lang('strings.contributor')</span>
                                </div>
                                <div class="col-lg-9 col-md-8 col-8 pb-3">
                                    <select name="user_id" class="btn dropdown-toggle bg-white pr-1 border text-left w-100">
                                        <option value="0"></option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}"
                                            @if ($user->id == $validated['user_id'])
                                                selected
                                            @endif
                                        >{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="javascript:picturesSearch.submit()" class="btn btn-primary shadow-sm w-25">
                                        <i class="fas fa-search fa-sm"></i> @lang('strings.search')
                                    </a>
                                </div>
                            </div>
                            {{Form::close()}}
                        </td>
                        <td style="width: 50%">
                            {{Form::open([
                                'name' => 'picturesPost',
                                'url' => '/pictures',
                                'method' => 'post',
                            ])}}
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <input type="file" name="choose_image" value="@lang('strings.choose_file')" accept=".jpg, .png" />
                                    <div class="text-danger" id="choose_image_error"></div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-12 py-2">
                                    <img id="preview" class="img-preview" />
                                </div>
                                <div class="col-lg-8 col-md-12 col-12 py-2">
                                    {{Form::input('text', 'title', old('title'), [
                                        'placeholder' => __('strings.title'),
                                        'style' => 'width: 100%;',
                                        'class' => 'mb-1',
                                    ])}}
                                    <textarea name="comment" placeholder="@lang('strings.comment')" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="#" id="uploadConfirmButton" class="btn btn-success shadow-sm w-25">
                                        <i class="fas fa-check fa-sm"></i> @lang('strings.confirm')
                                    </a>
                                </div>
                            </div>
                            {{Form::close()}}
                        </td>
                    </tr>
                </tbody>
            </table>
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

<!-- Content Row -->
<div class="container p-1">
    <div class="row">
        @foreach ($images as $image)
        <div class="col-md-3 col-6 p-2">
            <div class="thumbnail">
                <a href="/pictures/{{$image->id}}" class="text-decoration-none">
                    <img
                        src="/img/loading.gif"
                        data-src="/show/image/?file={{$image->file}}"
                        alt="{{$image->title}}"
                        style="width:100%; height: 25vh; object-fit: cover;"
                        class="lazyload rounded"
                        loading="lazy">
                    <div class="caption my-2">
                        <small class="text-muted">@lang('strings.title')</small> <small>{{$image->title}}</small><br>
                        <small class="text-muted">@lang('strings.contribute_date')</small> <small>{{$image->created_at->format(\DateFormat::getDateFormat())}}</small><br>
                        <small class="text-muted">@lang('strings.contributor')</small> <small>{{$image->name}}</small>
                    </div>
                </a>
            </div>
        </div>
        @endforeach

        <div class="col-md-12">
            {{$images->links()}}
        </div>
    </div>
</div>

<!-- Lazyload -->
@include('shared.lazyload')

<script>
$(function(){
    $("[name='choose_image']").on('change', function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr('src', e.target.result);
            $("#preview_confirm").attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);   
    });

    $("#uploadConfirmButton").on('click', function (e) {
        let error = document.getElementById('choose_image_error');
        if ($("[name='choose_image']").val() == "") {
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

