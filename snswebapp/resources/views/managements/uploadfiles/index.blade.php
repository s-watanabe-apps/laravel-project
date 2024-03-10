@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-upload"></i> @lang('strings.upload_files')</div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/uploadfiles',
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
            <span style="width: 50%;">@lang('strings.file_type'):&nbsp;</span>
            <select name="ext" style="width: 50%;">
                <option value=""></option>
                @foreach ($extensions as $ext)
                <option value="{{$ext}}"
                    @if ($ext == ($validated['ext'] ?? ''))
                        selected
                    @endif
                >{{$ext}}</option>
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
                @foreach ($headers ?? [] as $value)
                <th><a href="{{$value['link']}}">{{$value['name']}}</a></th>
                @endforeach
            </tr>
            @foreach ([] as $file)
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
    </div>

    <?php
    //{!!$files->links('vendor.pagination.semantic-ui')!!}
    ?>
</div>

@endsection