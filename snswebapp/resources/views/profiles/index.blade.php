@extends('layouts.app')
@section('content')

<!-- Page Heading -->
<div class="card">
    <!-- Card Header - Accordion -->
    <a href="#expand" class="d-block card-header p-0" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
        <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold p-0 m-0">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-users"></i> @lang('strings.member_search')</li>
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
                                'name' => 'membersSearch',
                                'url' => '/members',
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
                                    <span>@lang('strings.group')</span>
                                </div>
                                <div class="col-lg-9 col-md-8 col-8 pb-3">
                                    <select name="group_code" class="btn dropdown-toggle bg-white pr-1 border text-left w-100">
                                        <option value="0"></option>
                                        @foreach ($groups as $group)
                                        <option value="{{$group->code}}"
                                            @if ($group->code === $validated['group_code'])
                                                selected
                                            @endif
                                        >{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <a href="javascript:membersSearch.submit()" class="btn btn-primary shadow-sm w-25">
                                        <i class="fas fa-search fa-sm"></i> @lang('strings.search')
                                    </a>
                                </div>
                            </div>
                            {{Form::close()}}
                        </td>
                        <td style="width: 50%">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container pt-3 p-0">
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