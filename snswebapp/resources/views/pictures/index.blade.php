@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-images"></i> @lang('strings.album')</span>
    </div>
    <div class="contents-header"><a href="/album/upload">@lang('strings.upload_picture')</a></div>

    {{Form::open([
        'url' => '/album',
        'method' => 'get',
    ])}}
    <div class="flex-contents search-box">
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.keyword'):&nbsp;</span>
            {{Form::input('text', 'keyword', $validated['keyword'], [
                'style' => 'width: 50%;',
            ])}}
        </div>
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.user_name'):&nbsp;</span>
            <select name="user_id" style="width: 50%;">
                <option value=""></option>
            </select>
        </div>
        <div class="search-submit">
            <input type="submit" class="search" value="@lang('strings.search')" />
        </div>
    </div>
    {{Form::close()}}

    <div class="flex-contents">
        @foreach ($pictures as $picture)
        <div class="image-item">
            <a href="/album/{{$picture['id']}}">
                <img
                    src="/img/loading.gif"
                    data-src="/show/image/?file={{$picture['file']}}"
                    alt="{{$picture['title']}}"
                    style="width:100%; object-fit: cover;"
                    class="lazyload"
                    loading="lazy">
                <div>{{$picture['title']}}</div>
            </a>
            <small style="position: relative; top: -10px;"><a href="/profiles/{{$picture['user_id']}}">{{$picture['name']}}</a></small>
        </div>
        @endforeach
    </div>

    {!!$pictures->links('vendor.pagination.semantic-ui')!!}

</div>

@endsection