@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-blog"></i> {{$articles['title']}}</div>

    <div class="articles-body">{!!$articles['body']!!}</div>

    <div class="grid-contents" style="padding: 0px;">
        <div class="vertical-contents w-50">
            <div class="title">記事について</div>
            <table class="info">
                <tr>
                    <th>著者:</th>
                    <td><a href="/profiles/{{$articles['user_id']}}">{{$articles['name']}}</a></td>
                </tr>
                <tr>
                    <th>作成日時:</th>
                    <td>{{str_date_format($articles['created_at'])}}</td>
                </tr>
            </table>
            <div class="title">@lang('strings.label')</div>
            <div class="title">@lang('strings.relation_articles')</div>
        </div>
        <div class="vertical-contents w-50">
            <div class="title">@lang('strings.comment')</div>
        </div>
    </div>

</div>

@endsection