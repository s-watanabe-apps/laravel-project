@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-images"></i>@lang('strings.pictures')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
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
<!-- /.container-fluid -->

<!-- Lazyload -->
@include('shared.lazyload')

@endsection