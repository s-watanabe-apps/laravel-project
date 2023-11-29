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
        <div class="card-body py-2">
            hogehoge
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