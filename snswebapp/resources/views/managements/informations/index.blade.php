@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</div>
    <div class="contents-header"><a href="/managements/users/add">@lang('strings.add_information')</a></div>

    {{Form::open([
        'name' => 'informationsSearch',
        'url' => '/managements/informations',
        'method' => 'get',
    ])}}
    <div class="flex-contents search-box">
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.keyword'):&nbsp;</span>
            {{Form::input('text', 'keyword', $validated['keyword'] ?? '', [
                'style' => 'width: 50%;',
            ])}}
        </div>
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.class'):&nbsp;</span>
            <select name="m" style="width: 50%;">
                <option value="0"></option>
                @foreach ($marks as $mark)
                <option value="{{$mark['id']}}"
                    @if ($mark['id'] == $validated['m'])
                        selected
                    @endif
                >{{__('strings.information_marks.' . $mark['mark'])}}</option>
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
                @foreach ($headers as $value)
                <th><a href="{{$value['link']}}">{{$value['name']}}</a></th>
                @endforeach
            </tr>
            @foreach ($informations as $value)
            <tr>
                <td>
                    {{$value['id']}}
                </td>
                <td style="text-align: left; padding: 0 5px 0 5px;">
                    <a href="/managements/informations/{{$value['id']}}"><i class="fas fa-fw {{$value['mark']}}"></i> {{$value['title']}}</a>
                </td>
                <td>
                    {{$value['start_time']}}
                </td>
                <td>
                    {{$value['end_time']}}
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

    {!!$informations->links('vendor.pagination.semantic-ui')!!}
</div>

@endsection