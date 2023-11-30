@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="card mb-3">
    <!-- Card Header - Accordion -->
    <a href="#test" class="d-block card-header p-0" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
        <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold p-0 m-0">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-images"></i> @lang('strings.pictures')</li>
            </ol>
        </nav>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse show" id="test">
        <div class="row card-body py-2">
            <div class="col-lg-6 col-12">
                {{Form::open([
                    'name' => 'picturesSearch',
                    'url' => '/pictures',
                    'method' => 'get',
                ])}}

                <div class="row py-3">
                    <div class="col-md-3 col-3">
                        <span>@lang('strings.title')</span>
                    </div>
                    <div class="col-md-9 col-9 pb-2">
                        {{Form::input('text', 'title', old('title'), [
                            'style' => 'width: 100%;'
                        ])}}
                        <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
                    </div>
                    <div class="col-md-3 col-3">
                        <span>@lang('strings.contributor')</span>
                    </div>
                    <div class="col-md-9 col-9 pb-3">
                        <select name="user_id" class="btn dropdown-toggle pr-1 border text-left w-100">
                            <option value="0"></option>
                            @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-danger">{{$errors->first('user_id') ?? ''}}</div>
                    </div>
                    <div class="col-12 text-center">
                        <a href="javascript:picturesSearch.submit()" class="btn btn-primary shadow-sm w-25">
                            <i class="fas fa-search fa-sm"></i> @lang('strings.search')
                        </a>
                    </div>
                </div>
                {{Form::close()}}

            </div>
            <div class="col-lg-6 col-12">
                TODO
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

@endsection