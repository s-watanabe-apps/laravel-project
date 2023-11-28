@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="card mb-3">
    <!-- Card Header - Accordion -->
    <a href="#test" class="d-block card-header p-0" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
        <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold p-0 m-0">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-users"></i> @lang('strings.member_search')</li>
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

<div class="container p-0">
    <!-- Content Row -->
    <div class="row">
        @foreach ($profileUsers as $profileUser)
        <div class="col-md-2 col-4">
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