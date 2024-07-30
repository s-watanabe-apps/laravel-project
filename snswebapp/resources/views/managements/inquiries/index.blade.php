@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-tools"></i> @lang('strings.inquiry_list')</span>
    </div>

    {{Form::open([
        'name' => 'inquiriesSearch',
        'url' => '/managements/inquiries',
        'method' => 'get',
    ])}}
    <div class="flex-contents search-box">
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.keyword'):&nbsp;</span>
            {{Form::input('text', 'keyword', $validated['keyword'] ?? null, [
                'style' => 'width: 50%;',
            ])}}
        </div>
        <div class="search-item">
            <span style="width: 50%;">@lang('strings.inquiry_type'):&nbsp;</span>
            <select name="type" style="width: 50%;">
                <option value="0"></option>
                @foreach ($types as $type)
                <option value="{{$type['id']}}"
                    @if ($type['id'] == $validated['type'])
                        selected
                    @endif
                >{{$type['name']}}</option>
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
                @for ($i = 0; $i < (count($headers) - 1); $i++)
                <th><a href="{{$headers[$i]['link']}}">{{$headers[$i]['name']}}</a></th>
                @endfor
            </tr>
            <tr>
                <th class="left" colspan="5"><a href="{{$headers[array_key_last($headers)]['link']}}">{{$headers[array_key_last($headers)]['name']}}</a></th>
            </tr>
            @foreach ($inquiries as $value)
            <tr>
                <td>{{$value['id']}}</td>
                <td class="left">{{$value['type_name']}}</td>
                <td class="left">
                    @if (is_null($value['user_id']))
                    <span><b>[@lang('strings.non_member')]</b> {{$value['user_name']}}</span>
                    @else
                    <a href="/managements/users/{{$value['user_id']}}">{{$value['user_name']}}</a>
                    @endif
                </td>
                <td>{{str_date_format($value['created_at'])}}</td>
                <td>
                    @if ($value['status'] == \Status::ENABLED)
                    <span class="disable">@lang('strings.not_answered')</span>
                    @else
                    <span class="enable">@lang('strings.answered')</span>
                    @endif
                </td>
            </tr>
            <tr class="under">
                <td class="left" colspan="5">
                    <a href="/managements/inquiries/{{$value['id']}}">{{truncate($value['text'], 60, "...")}}</a>
                </td>
            </tr>
            @endforeach
        </table>

        {!!$inquiries->links('vendor.pagination.semantic-ui')!!}
    </div>
</div>

@endsection