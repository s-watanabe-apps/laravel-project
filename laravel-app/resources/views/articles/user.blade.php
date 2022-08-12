@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h5">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fas fa-blog"></i> {{sprintf(__('strings.articles_index_title'), $articlesUser->name)}}</li>
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
      @include('articles.formset.sidemenu', compact('latestArticles', 'userLabels'))
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection