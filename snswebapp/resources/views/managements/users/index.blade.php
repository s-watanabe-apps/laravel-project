@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-users"></i> @lang('strings.user_management')</span>
    </div>
    <div class="contents-header"><a href="/managements/users/create">@lang('strings.add_user')</a></div>

    {{Form::open([
        'name' => 'usersSearch',
        'url' => '/managements/users',
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

    <div class="vertical-contents">
        <table class="table-managements">
            <tr>
                @foreach ($headers as $value)
                <th><a href="{{$value['link']}}">{{$value['name']}}</a></th>
                @endforeach
            </tr>
            @foreach ($users as $value)
            <tr>
                <td>
                    {{$value['id']}}
                </td>
                <td style="text-align: left; padding: 0 5px 0 5px;">
                    <a href="/managements/users/{{$value['id']}}">{{$value['email']}}</a>
                </td>
                <td style="text-align: left; padding: 0 5px 0 5px;">
                    <a href="/managements/users/{{$value['id']}}">{{$value['name']}}</a>
                </td>
                <td>
                    {{$value['group_name'] ?? __('strings.none')}}
                </td>
                <td>
                    {{str_date_format($value['last_activity'])}}
                </td>
                <td>
                    @if ($value['status'] == \Status::ENABLED)
                    <span class="enable">@lang('strings.enable')</span>
                    @else
                    <span class="disable">@lang('strings.disable')</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>

        {!!$users->links('vendor.pagination.semantic-ui')!!}
    </div>

</div>

@endsection