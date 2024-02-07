@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <a href="/members"><i class="fas fa-fw fa-user"></i> @lang('strings.profile')</a>
        &gt; {{$profiles['name']}}
    </div>
    <div class="grid-contents">
        <div class="w-25">
            <img class="profile-image" src="/show/image?file={{$profiles['image_file']}}" />
        </div>

        <div class="w-75">
            <table class="profiles">
                <tr>
                    <th>@lang('strings.name')&nbsp;:</th>
                    <td>{{$profiles['name']}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.email')&nbsp;:</th>
                    <td>{{$profiles['email']}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.role')&nbsp;:</th>
                    <td>{{__('strings.roles')[$profiles['role_name']]}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.group')&nbsp;:</th>
                    <td>{{$profiles['group_name'] ?? __('strings.none')}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.birth_date')&nbsp;:</th>
                    <td>{{str_date_format($profiles['birthdate'])}}</td>
                </tr>
                @foreach ($user_profiles as $value)
                    @if ($value['type'] != \App\Libs\ProfileInputType::DESCRIPTION)
                    <tr>
                        <th>{{$value['name']}}&nbsp;:</th>
                        <td>{{$value['value']}}</td>
                    </tr>
                    @else
                    <tr>
                        <th>{{$value['name']}}&nbsp;:</th>
                        <td><div style="white-space: pre; padding: 5px 0 10px 0;">{!!$value['value']!!}</div></td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </div>
    @if ($profiles['id'] == user()->id)
    <div class="flex-contents">
        <a href="/profiles/edit"><input type="button" value="@lang('strings.edit')"></input></a>
    </div>
    @endif

    <div class="grid-contents">
        <div class="w-50">
            <div class="subject"><i class="fas fa-fw fa-edit"></i> @lang('strings.latest_articles')</div>
            @foreach ($articles as $article)
            <div class="profile-articles">
                <div class="title"><a href="#">{{$article['title']}}</a></div>
                <div class="source">{{$article['updated_at'] ? str_date_format($article['updated_at']) : str_date_format($article['created_at'])}}</div>
            </div>
            @endforeach
            <div class="source"><a href="/articles/user/{{$profiles['id']}}">@lang('strings.readmore')</a></div>
        </div>

        <div class="w-50">
            <div class="subject"><i class="fas fa-fw fa-tag"></i> @lang('strings.keyword')</div>
        </div>
    </div>
    
</div>

@endsection