@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-blog"></i> {{$articles['title']}}</div>

    <div class="articles-body">{!!$articles['body']!!}</div>
</div>

@endsection