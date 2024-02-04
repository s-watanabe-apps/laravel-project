@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-tools"></i> @lang('strings.user_management')</div>

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
        <table class="user-managements">
            <tr>
                <th><a href="asort=1">ID</a></th>
                <th><a href="#">@lang('strings.name')</a></th>
                <th><a href="#">@lang('strings.group')</a></th>
                <th><a href="#">@lang('strings.created_at')</a></th>
                <th><a href="#">@lang('strings.last_login')</a></th>
                <th><a href="#">@lang('strings.status')</a></th>
            </tr>
            @foreach ($users as $value)
            <tr>
                <td>
                    {{$value['id']}}
                </td>
                <td style="text-align: left; padding: 0 5px 0 5px;">
                    <a href="/managements/users/{{$value['id']}}">{{$value['name']}}</a>
                </td>
                <td>
                    {{$value['group_name'] ?? __('strings.none')}}
                </td>
                <td>
                    {{str_date_format($value['created_at'])}}
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
    </div>

    {!!$users->links('vendor.pagination.semantic-ui')!!}
</div>

@endsection