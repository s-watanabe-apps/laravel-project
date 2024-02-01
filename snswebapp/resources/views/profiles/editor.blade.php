@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <a href="/members"><i class="fas fa-fw fa-user"></i> @lang('strings.profile')</a>
        &gt; <a href="/profiles/{{$profiles['id']}}">{{$profiles['name']}}</a>
        &gt; @lang('strings.edit')</div>
    <div class="grid-contents">
        <div class="w-25">
            <img class="profile-image" src="/show/image?file={{$profiles['image_file']}}" />
        </div>

        <div class="w-75">
            <table class="profiles">
                <tr>
                    <th>@lang('strings.name')&nbsp;:</th>
                    <td>
                    {{Form::text(
                        'name',
                        old('name') ?? $profiles['name'],
                    )}}
                    </td>
                </tr>
                <tr>
                    <th>@lang('strings.email')&nbsp;:</th>
                    <td>{{$profiles['email']}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.role')&nbsp;:</th>
                    <td>{{$profiles['role_id']}}</td>
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
                        <td>{!!$value['value']!!}</td>
                    </tr>
                    @endif
                @endforeach
                <tr>
                    <th>@lang('strings.last_login')&nbsp;:</th>
                    <td>{{str_date_format($profiles['last_activity'])}}</td>
                </tr>
            </table>
        </div>

    </div>


</div>

@endsection