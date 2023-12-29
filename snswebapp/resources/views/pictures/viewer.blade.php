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
                @if (!is_null($image->description))
                <tr>
                    <th>
                        @lang('strings.description')
                    </th>
                    <td>
                        {{$image->description}}
                    </td>
                </tr>
                @endif
                <tr>
                    <th class="w-25">
                        @lang('strings.contribute_date')
                    </th>
                    <td class="w-75">
                        {{$image->created_at->format(\DateFormat::getDateFormat())}}
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <th class="text-center">@lang('strings.comment')</th>
                </tr>
                @foreach ($pictureComments as $comment)
                <tr>
                    @if (isset($editComment) && $comment->id == $editComment->id)
                    <td>
                        {{Form::open([
                            'name' => 'picturesComment',
                            'url' => '/pictures/comment',
                            'method' => 'put',
                        ])}}
                        @csrf
                        {{Form::hidden('id', $image->id)}}
                        {{Form::hidden('comment_id', $comment->id)}}
                        <textarea id="description" name="comment" rows="2" class="form-control">{{$comment->comment}}</textarea>
                        <div class="text-danger">{{$errors->first('comment') ?? ''}}</div>
                        <div class="text-center">
                            <a href="javascript:picturesComment.submit()" class="btn btn-success shadow-sm py-0 mt-2">
                                <i class="fas fa-check fa-sm text-white-50"></i>&nbsp;@lang('strings.save')
                            </a>
                        </div>
                        {{Form::close()}}
                    </td>
                    @else
                    <td>
                        <div>{!!str_replace("\n", "<br>", $comment->comment)!!}</div>
                        <div class="text-right"><small class="text-left">
                            {{$comment->created_at->format(\DateFormat::getDateFormat())}}&nbsp;
                            <a href="/profiles/{{$comment->user_id}}">{{$comment->user_name}}</a>
                            @if (user()->id == $comment->user_id)
                            <a href="/pictures/{{$image->id}}/comment/{{$comment->id}}">
                                <span><i class="fas fa-fw fa-edit text-primary"></i></span>
                            </a>
                            <a href="/pictures/{{$image->id}}/comment/{{$comment->id}}">
                                <span><i class="fas fa-fw fa-trash text-danger"></i></span>
                            </a>
                            @endif
                        </small></div>
                    </td>
                    @endif
                </tr>
                @endforeach
                @if (!isset($editComment))
                <tr>
                    <td>
                        {{Form::open([
                            'name' => 'picturesComment',
                            'url' => '/pictures/comment',
                            'method' => 'post',
                        ])}}
                        @csrf
                        {{Form::hidden('id', $image->id)}}
                        <textarea id="description" name="comment" rows="2" class="form-control"></textarea>
                        <div class="text-danger">{{$errors->first('comment') ?? ''}}</div>
                        <div class="text-center">
                            <a href="javascript:picturesComment.submit()" class="btn btn-success shadow-sm py-0 mt-2">
                                <i class="fas fa-check fa-sm text-white-50"></i>&nbsp;@lang('strings.save')
                            </a>
                        </div>
                        {{Form::close()}}
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Lazyload -->
@include('shared.lazyload')

@endsection