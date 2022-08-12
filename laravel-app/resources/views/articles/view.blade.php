@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/articles/user/{{$articles->user_id}}"><i class="fas fa-blog"></i> {{sprintf(__('strings.articles_index_title'), $articles->name)}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$articles->title}}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-12">
            @include('articles.formset.viewControl', compact('articles'))

            @if ($articles->user_id == $user->id)
            <div class="col-lg-12 mb-12 text-center">
                <a type="button" class="btn btn-success" href="/articles/edit/{{$articles->id}}"><i class="fas fa-fw fa-edit"></i> @lang('strings.edit')</a>
                <a type="button" class="btn btn-danger" href="#"><i class="fas fa-fw fa-trash"></i> @lang('strings.delete')</a>
            </div>
            @endif
        </div>
        <div class="col-lg-4 mb-12">
            @include('articles.formset.sidemenu', compact('latestArticles', 'userLabels'))
        </div>
    </div>
</div>

<!-- /.container-fluid -->
@endsection