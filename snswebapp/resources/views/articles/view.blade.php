@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-blog"></i> {{$articles['title']}}</div>

    <div class="articles-body">{!!$articles['body']!!}</div>

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">
            <div class="title">著者</div>
            <span>
                <small>{{str_date_format($articles['created_at'])}}</small>
                <a href="/profiles/{{$articles['user_id']}}">{{$articles['name']}}</a>
            </span>

            <div class="title">@lang('strings.label')</div>
            <div class="tb-margin">
                <div class="article-tags">
                    @foreach($labels as $tag)
                    <a href="/{{$lang}}/?tag={{$tag['value']}}"><span class="tag" style="border-color: {{$tag['frame_color']}}; background: {{$tag['body_color']}}">{{$tag['value']}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="vertical-contents w-50">
            <div class="title">@lang('strings.comment')</div>
            @foreach ($comments as $comment)
                <div class="comment">
                    <div class="body">{!!str_replace("\n", "<br>", $comment['comment'])!!}</div>
                    <div class="source"><small>2024-04-04</small> <a href="/profiles/{{$comment['user_id']}}">{{$comment['user_name']}}</a></div>
                </div>
            @endforeach

            {{Form::open([
                'url' => '/articles/comment',
                'method' => 'post',
                'files' => true,
                'enctype' => 'multipart/form-data'
            ])}}
            {{Form::hidden('id', $articles['id'])}}
            <textarea name='comment' rows='6'></textarea>
            <div class="text-danger">{{$errors->first('comment') ?? ''}}</div>
            <div class="flex-contents">
                <input type="submit" class="post" value="@lang('strings.save')"></input>
            </div>

            {{Form::close()}}
        </div>
    </div>

</div>

@endsection