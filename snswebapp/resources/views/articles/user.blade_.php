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
            <div class="card-body py-3" @if ($value->status == \Status::DISABLED)
                style="background: #cecece;"
            @endif>
                <div class="h6 font-weight-bold">{{$value->title}}</div>
                <div class="row">
                @if (isset($value->image))
                    <div class="col-4 col-sm-4 col-md-3 col-lg-3"><img src="{{$value->image}}" style="width:100%; height: 20vh; object-fit: cover;" /></div>
                    <div class="col-8 col-sm-8 col-md-9 col-lg-9">{!!$value->body_text!!}</div>
                @else
                    <div class="col-12">{!!$value->body_text!!}</div>
                @endif
                </div>
                <div class="hr"></div>
                <div class="row">
                    <div class="col-md-12 col-lg-3 text-left">
                        <span><a href="/articles/{{$value->id}}">@lang('strings.read_article')</a></span>
                    </div>
                    <div class="col-md-12 col-lg-9 text-right">
                        <span>{{$value->created_at->format(\DateFormat::getDateTimeFullFormat())}}</span>
                        <span>(0)</span>
                        <span><a href="/profile/{{$value->user_id}}">{{$value->name}}</a></span>
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