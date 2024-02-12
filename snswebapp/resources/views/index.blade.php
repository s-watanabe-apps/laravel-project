@extends('app')
@section('content')

<div class="subject">管理者からのお知らせ</div>
@foreach($informations as $info)
<div class="container">
    <div class="title"><i class="fas {{$info['style']}} text-primary-50"></i> {{$info['title']}}</div>
    <div class="body">
        <div class="description">{!!$info['body']!!}</div>
    </div>
    <div class="footer">
        <div class="source">hogehoge</div>
    </div>
</div>
@endforeach

<div class="subject">@lang('strings.latest_articles')</div>
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
    <div class="footer">
        <div class="tags">
            @foreach($article['tags'] as $tag)
            <a href="/{{$lang}}/?tag={{$tag['name']}}"><span class="tag" style="border-color: {{$tag['frame_color']}}; background: {{$tag['body_color']}}">{{$tag['name']}}</span></a>
            @endforeach
        </div>
        <div class="source"><a href="/profiles/{{$article['user_id']}}">{{$article['name']}}</a></div>
    </div>
</div>
@endforeach
{!!$articles->links('vendor.pagination.semantic-ui')!!}
@endsection