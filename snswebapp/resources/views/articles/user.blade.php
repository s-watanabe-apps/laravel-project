@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            @if (!$labelName)
            <li class="breadcrumb-item"><i class="fas fa-blog"></i> {{sprintf(__('strings.articles_index_title'), $articlesUser->name)}}</li>
            @else
            <li class="breadcrumb-item"><a href="/articles/user/{{$articlesUser->id}}"><i class="fas fa-blog"></i> {{sprintf(__('strings.articles_index_title'), $articlesUser->name)}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tag"></i> {{$labelName}}</li>
            @endif
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 mb-12">
        @foreach ($articles as $value)
        <div class="card bg-light text-black shadow mb-3">
            <div class="card-body">
                <div class="h5">{{$value->title}}</div>
                <hr>
                <div>{!!$value->body_text!!}</div>
                <hr>

                <div class="row">
                    <div class="col-6 text-left">
                        <span><a href="/articles/{{$value->id}}">@lang('strings.read_article')</a></span>
                    </div>
                    <div class="col-6 text-right">
                        <span>{{$value->created_at->format(\DateFormat::getDateTimeFormat())}}</span>
                        <span>(0)</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{$articles->links()}}
    </div>

    <div class="col-lg-4 mb-12">
        @include('articles.formset.sidemenu', array_merge(
            compact('sidemenus')),
            ['articleUserId' => $articlesUser->id]
        )
    </div>
</div>
@endsection