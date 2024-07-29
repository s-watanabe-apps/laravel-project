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
        <table class="user-managements">
            <tr>
                @foreach ($headers as $value)
                <th><a href="{{$value['link']}}">{{$value['name']}}</a></th>
                @endforeach
            </tr>
            @foreach ($inquiries as $value)
            <tr>
                <td>{{$value['id']}}</td>
                <td style="text-align: left; padding: 0 5px 0 5px;">{{$value['type_name']}}</td>
                <td style="text-align: left; padding: 0 5px 0 5px;">{{$value['name']}}</td>
                <td>{{$value['text']}}</td>
                <td>{{str_date_format($value['created_at'])}}</td>
            </tr>
            @endforeach
        </table>

        {!!$inquiries->links('vendor.pagination.semantic-ui')!!}
    </div>
</div>

@endsection