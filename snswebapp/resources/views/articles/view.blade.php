@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-blog"></i> {{$articles['title']}}</div>

    <div class="articles-body">
        {!! \HtmlString::escapeScript($articles['body']) !!}
        <a href="{{$articles['link']}}">{{$articles['link']}}</a>
    </div>

    @if (user()->isAdmin() || user()->id == $articles['user_id'])
    <div class="flex-contents">
        <a href="/articles/edit/{{$articles['id']}}">
            <input type="button" class="post" value="@lang('strings.edit')"></input>
        </a>
        <a href="/articles/delete/{{$articles['id']}}">
            <input type="button" class="delete" value="@lang('strings.delete')"></input>
        </a>
    </div>
    @endif

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">
            <div class="title">@lang('strings.author')</div>
            <span>
                <a href="/profiles/{{$articles['user_id']}}">{{$articles['name']}}</a>
            </span>

            <div class="title">@lang('strings.updated_at')</div>
            <span>
                <p>{{$articles['updated_at'] != null ? str_datetime_format($articles['updated_at']) : str_datetime_format($articles['created_at'])}}</p>
            </span>

            <div class="title">@lang('strings.label')</div>
            <div class="tb-margin">
                <div class="article-tags">
                    @foreach($labels as $label)
                    <a href="/{{$lang}}/?tag={{$label['value']}}"><span class="tag">{{$label['value']}}</span></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="vertical-contents w-50">
            <div class="title">@lang('strings.comment')</div>
            @foreach ($comments as $comment)
                <div class="comment">
                    <div class="body">{!!str_replace("\n", "<br>", $comment['comment'])!!}</div>
                    <div class="source">
                        <small>2024-04-04</small>
                        <a href="/profiles/{{$comment['user_id']}}">{{$comment['user_name']}}</a>
                        @if (user()->isAdmin() || user()->id == $comment['user_id'])
                        <a class="comment-edit" href="/articles/comment/edit/{{$comment['id']}}"><i class="fas fa-edit"></i></a>
                        <a class="comment-delete" href="/articles/comment/delete/{{$comment['id']}}"><i class="fas fa-trash"></i></a>
                        @endif
                    </div>
                </div>
            @endforeach

            {{Form::open([
                'url' => '/articles/comment',
                'method' => 'post',
                'files' => true,
                'enctype' => 'multipart/form-data'
            ])}}
            {{Form::hidden('id', $articles['id'])}}
            <textarea name='comment' rows='6' placeholder="@lang('strings.comment')"></textarea>
            <div class="text-danger">{{$errors->first('comment') ?? ''}}</div>
            <div class="flex-contents">
                <input type="submit" class="post" value="@lang('strings.save')"></input>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>
@endsection