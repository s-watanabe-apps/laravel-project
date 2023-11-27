@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-users"></i>@lang('strings.member_search')</li>
        </ol>
    </nav>
</div>

<div class="container p-0">
    <!-- Content Row -->
    <div class="row">
        @foreach ($profileUsers as $profileUser)
        <div class="col-md-2 col-4 p-2">
            <div class="thumbnail">
                <a href="/profiles/{{$profileUser->id}}" class="text-decoration-none">
                    <img
                        src="/img/loading.gif"
                        data-src="/show/image/?file={{$profileUser->image_file}}"
                        alt="{{$profileUser->name}}"
                        style="width:100%; height: 10rem; object-fit: cover;"
                        class="lazyload rounded"
                        loading="lazy">
                    <div class="caption my-2 text-center">
                        <div class="text-muted">{{$profileUser->name}}</div>
                    </div>
                </a>
            </div>
        </div>
        @endforeach

        <div class="col-md-12">
            {{$profileUsers->links()}}
        </div>
    </div>
</div>

<!-- Lazyload -->
@include('shared.lazyload')

@endsection