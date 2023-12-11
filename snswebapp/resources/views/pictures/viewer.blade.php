@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-images"></i> @lang('strings.pictures')</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$image->title}}</li>
            <span style="margin:0 0 0 auto">
                <a id="switchFavorites" href="#">
                    @if ($isFavorite)
                    <i class="fas fa-star"></i>
                    @else
                    <i class="far fa-star"></i>
                    @endif
                </a>
                {{Form::hidden('isFavorite', $isFavorite, ['id' => 'isFavorite'])}}
            </span>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 px-3 pb-4">
        <a href="/show/image/?file={{$image->file}}">
            <img
                src="/img/loading.gif"
                data-src="/show/image/?file={{$image->file}}"
                alt="{{$image->title}}"
                style="width:100%; height: auto; object-fit: cover; cursor:pointer;"
                class="lazyload rounded"
                loading="lazy" />
        </a>
    </div>

    <div class="col-md-6">
        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <th class="w-25">
                        @lang('strings.title')
                    </th>
                    <td class="w-75">
                        {{$image->title ?? __('strings.untitled')}}
                    </td>
                </tr>
                <tr>
                    <th>
                        @lang('strings.contributor')
                    </th>
                    <td>
                        <a href="/profiles/{{$image->user_id}}">{{$image->name}}</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- Lazyload -->
@include('shared.lazyload')

@endsection