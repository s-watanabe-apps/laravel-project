@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-user"></i> @lang('strings.profile')</div>

    {{Form::open([
        'name' => 'membersSearch',
        'url' => '/members',
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
            <span style="width: 50%;">@lang('strings.group'):&nbsp;</span>
            <select name="group_code" style="width: 50%;">
                <option value="0"></option>
                @foreach ($groups as $group)
                <option value="{{$group['code']}}"
                    @if ($group['code'] == $validated['group_code'])
                        selected
                    @endif
                >{{$group['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="search-submit">
            <input type="submit" class="search" value="@lang('strings.search')" />
        </div>
    </div>
    {{Form::close()}}

    <div class="flex-contents">
        @foreach ($profile_users as $user)
        <div class="view-item">
            <a href="/profiles/{{$user['id']}}">
                <img
                    src="/img/loading.gif"
                    data-src="/show/image/?file={{$user['image_file']}}"
                    alt="{{$user['name']}}"
                    style="width:100%; height: 10rem; object-fit: cover;"
                    class="lazyload"
                    loading="lazy">
                <div>{{$user['name']}}</div>
            </a>
        </div>
        @endforeach
    </div>

    {!!$profile_users->links('vendor.pagination.semantic-ui')!!}
</div>

<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js" defer></script>
<script>
    $(window).on('load', function() {
        $(".lazyload").lazyload();
    });
</script>

@endsection