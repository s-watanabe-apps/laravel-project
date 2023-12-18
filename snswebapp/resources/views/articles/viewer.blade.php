@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/articles/user/{{$articles->user_id}}"><i class="fas fa-blog"></i> {{sprintf(__('strings.articles_index_title'), $articles->name)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$articles->title}}</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 mb-3">
        @include('articles.formset.viewControl', compact('articles'))

        @if ($articles->user_id == user()->id)
        <div class="col-lg-12 text-center">
            <a type="button" class="btn btn-success" href="/articles/edit/{{$articles->id}}"><i class="fas fa-fw fa-edit"></i> @lang('strings.edit')</a>
            <a type="button" class="btn btn-danger" href="#"><i class="fas fa-fw fa-trash"></i> @lang('strings.delete')</a>
        </div>
        @endif

        <table class="table table-bordered responsive-table mt-3">
            <tbody>
                <tr>
                    <th class="text-center">@lang('strings.comment')</th>
                </tr>
                @foreach ($articleComments as $comment)
                <tr>
                    <td>
                        <div>{!!str_replace("\n", "<br>", $comment->comment)!!}</div>
                        <div class="text-right"><small class="text-left">
                            {{$comment->created_at->format(\DateFormat::getDateFormat())}}&nbsp;
                            <a href="/profiles/{{$comment->user_id}}">{{$comment->user_name}}</a>
                        </small></div>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td>
                        {{Form::open([
                            'name' => 'articlesComment',
                            'url' => '/articles/comment',
                            'method' => 'post',
                        ])}}
                        @csrf
                        {{Form::hidden('id', $articles->id)}}
                        <textarea id="description" name="comment" rows="2" class="form-control"></textarea>
                        <div class="text-danger">{{$errors->first('comment') ?? ''}}</div>
                        <div class="text-center">
                            <a href="javascript:articlesComment.submit()" class="btn btn-success shadow-sm py-0 mt-2">
                                <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.save')
                            </a>
                        </div>
                        {{Form::close()}}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    <div class="col-lg-4 mb-12">
        @include('articles.formset.sidemenu', array_merge(
            compact('sidemenus')),
            ['articleUserId' => $articles->user_id]
        )
    </div>
</div>

<!-- /.container-fluid -->
@endsection