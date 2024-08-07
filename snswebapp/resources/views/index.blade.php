@extends('app')
@section('content')

@if (count($informations) > 0)
<div class="subject">{{$settings['title_informations']}}</div>
@foreach($informations as $info)
<div class="container">
    <div class="title"><i class="fas {{$info['style']}} text-primary-50"></i> {{$info['title']}}</div>
    <div class="body">
        <div class="description">{!!$info['body']!!}</div>
    </div>
    <div class="footer">
        <div class="source">{{str_datetime_format($info['start_time'])}}</div>
    </div>
</div>
@endforeach
@endif

<div class="subject">{{$settings['title_latest_articles']}}</div>
@foreach($articles as $article)
<div class="container">
    <div class="title"><a href="/articles/{{$article['id']}}">{{$article['title']}}</a></div>
    <div class="body">
        @if(isset($article['image_url']))
        <div class="image">
            <a href="/articles/{{$article['id']}}">
                <img
                    src="/images/loading.gif"
                    data-src="{{$article['image_url']}}"
                    style="object-fit: cover; width: 100%;"
                    class="lazyload"
                    loading="lazy" />
            </a>
        </div>
        @endif
        <div class="description">{!!$article['body_text']!!}</div>
    </div>
    @if (!is_null($article['link']))
    <a href="{{$article['link']}}">{{$article['link']}}</a>
    @endif
    <div class="footer" style="margin-top: 5px;">
        <div class="tags">
            @foreach($article['tags'] as $tag)
            <a href="/articles/?tag={{$tag['value']}}"><span class="tag" style="border-color: {{$tag['frame_color'] ?? ''}}; background: {{$tag['body_color'] ?? ''}}">{{$tag['value']}}</span></a>
            @endforeach
        </div>
        <div class="source"><small>{{str_datetime_format($article['created_at'])}}</small> <a href="/profiles/{{$article['user_id']}}">{{$article['name']}}</a></div>
    </div>
</div>
@endforeach

{!!$articles->links('vendor.pagination.semantic-ui')!!}
@endsection