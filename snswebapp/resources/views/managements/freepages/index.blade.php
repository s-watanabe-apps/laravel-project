@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-edit"></i> @lang('strings.freepage_management')</div>
    <div class="contents-header"><a href="/managements/freepages/create">@lang('strings.create_new')</a></div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/freepages',
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
            <span style="width: 50%;">@lang('strings.status'):&nbsp;</span>
            <select name="status" style="width: 50%;">
                <option value=""></option>
                <option value="{{\App\Libs\Status::DISABLED}}"
                    @if (!is_null($validated['status']) && \App\Libs\Status::DISABLED == $validated['status'])
                        selected
                    @endif
                >@lang('strings.disable')</option>
                <option value="{{\App\Libs\Status::ENABLED}}"
                    @if (!is_null($validated['status']) && \App\Libs\Status::ENABLED == $validated['status'])
                        selected
                    @endif
                >@lang('strings.enable')</option>
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
                @foreach ($headers ?? [] as $value)
                <th><a href="{{$value['link']}}">{{$value['name']}}</a></th>
                @endforeach
            </tr>
            @foreach ($freePages as $value)
            <tr>
                <td>
                    {{$value['id']}}
                </td>
                <td style="text-align: left; padding: 0 5px 0 5px;">
                    <a href="/managements/freepages/{{$value['id']}}">{{$value['title']}}</a>
                </td>
                <td>
                    {{str_datetime_format($value['created_at'])}}
                </td>
                <td>
                    {{str_datetime_format($value['updated_at'])}}
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
        {!!$freePages->links('vendor.pagination.semantic-ui')!!}
    </div>
</div>

@endsection