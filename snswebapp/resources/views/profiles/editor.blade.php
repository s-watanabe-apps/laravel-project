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
                    <td>{{__('strings.roles')[$profiles['role_name']]}}</td>
                </tr>
                <tr>
                    <th>@lang('strings.birth_date')&nbsp;:</th>
                    <td>{{str_date_format($profiles['birthdate'])}}</td>
                </tr>
                @foreach($user_profiles as $value)
                <tr>
                    <th>
                        {{$value['name']}}&nbsp;:
                    </th>
                    <td>
                        @if($value['type'] == App\Libs\ProfileInputType::FILLIN)
                            {{Form::text("dynamic_values[{$value['id']}]", $value['value'], [])}}
                        @elseif($value['type'] == App\Libs\ProfileInputType::DESCRIPTION)
                            <textarea
                                style="width: 100%; resize:vertical; padding: 5px;"
                                name="dynamic_values[{{$value['id']}}]"
                                rows="8">{{old('dynamic_values.' . $value['id']) ?? $value['value']}}</textarea>
                        @elseif($value['type'] == App\Libs\ProfileInputType::CHOICE)
                            <select name="dynamic_values[{{$value['id']}}]">
                                <optgroup label="{{$value['name']}}">
                                    @foreach($choices[$value['id']] as $k => $v)
                                    <option value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        @endif
                        <div class="text-danger">{{$errors->first('dynamic_values.' . $value['id']) ?? ''}}</div>
                    </td>
                </tr>
                @endforeach

            </table>
        </div>

    </div>


</div>

@endsection