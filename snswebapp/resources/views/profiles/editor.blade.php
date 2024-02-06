@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <a href="/members"><i class="fas fa-fw fa-user"></i> @lang('strings.profile')</a>
        &gt; <a href="/profiles/{{$profiles['id']}}">{{$profiles['name']}}</a>
        &gt; @lang('strings.edit')</div>

    {{Form::open([
        'name' => 'profiles',
        'url' => '/profiles/save',
        'method' => 'put',
        'files' => true,
        'enctype' => 'multipart/form-data',
    ])}}
    @csrf

    <div class="grid-contents">
        <div class="w-25">
            <div style="position: relative;">
                <img id="preview" class="profile-image" src="/show/image?file={{$profiles['image_file']}}" />
                {{Form::hidden('image_file_clear', 0)}}
                <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
                    <span aria-hidden="true"><b>&times;</b></span>
                </button>
            </div>

            <div class="flex-contents">
                <label class="file">@lang('strings.choose_file')<input type="file" name="image_file" style="display: none" /></label>
            </div>
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
                        <div class="text-danger">{{$errors->first('name') ?? ''}}</div>
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

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.save')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}
</div>

<script type="text/javascript">
$(function(){
    $("[name='image_file']").on("change", function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr("src", e.target.result);
        }
        reader.readAsDataURL(e.target.files[0]);   
    });
    $("#btn-delete").on("click", function (e) {
        $("#preview").attr("src", "/show/image?file=profiles%2Fno_image.png");
        $("[name='image_file_clear']").attr("value", 1);
    });
});
</script>

@endsection