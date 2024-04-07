@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-tools"></i> @lang('strings.site_settings')</span>
    </div>

    {{Form::open(['name' => 'settings', 'url' => '/managements/settings', 'method' => 'post', 'files' => true])}}
    @csrf
    <div class="grid-contents">
        <div class="w-50">
            <div class="vertical-contents">
                <div class="title">@lang('strings.basic_settings')</div>
                <div class="input-label">@lang('strings.site_name')</div>
                {{Form::input('text', 'site_name', old('site_name') ?? $settings['site_name'], [
                    'style' => 'width: 100%;',
                ])}}
                <div class="text-danger">{{$errors->first('site_name') ?? ''}}</div>

                <div class="input-label">@lang('strings.site_description')</div>
                {{Form::input('text', 'site_description', old('site_description') ?? $settings['site_description'], [
                    'style' => 'width: 100%;',
                    'rows' => '4',
                ])}}
                <div class="text-danger">{{$errors->first('site_description') ?? ''}}</div>
            </div>
            <div class="vertical-contents">
                <div class="title">@lang('strings.anonymous_user')</div>
                <div class="vertical-contents">
                    <label>{{Form::radio('anonymous_permission', '0', $settings['anonymous_permission'] == 0, []) }}&nbsp;@lang('strings.anonymous_permisshon_not_allowed')</label>
                    <label>{{Form::radio('anonymous_permission', '1', $settings['anonymous_permission'] == 1, []) }}&nbsp;@lang('strings.anonymous_permisshon_allowed')</label>
                </div>
                <div class="text-danger">{{$errors->first('display_flag') ?? ''}}</div>
            </div>

            <div class="vertical-contents">
                <div class="title">@lang('strings.basic_auth')</div>
                <div class="radio">
                    <label>{{Form::radio('basic_auth', '1', false, []) }}&nbsp;<span class="enable">@lang('strings.enable')</span></label>
                    <label>{{Form::radio('basic_auth', '0', true, []) }}&nbsp;<span class="disable">@lang('strings.disable')</span></label>
                </div>

                <div class="input-label">@lang('strings.user_name')</div>
                {{Form::input('text', 'basic_user', old('basic_user') ?? $settings['basic_user'], [
                    'style' => 'width: 100%;',
                ])}}
                <div class="text-danger">{{$errors->first('basic_user') ?? ''}}</div>

                <div class="input-label">@lang('strings.password')</div>
                {{Form::input('text', 'basic_password', old('basic_password') ?? $settings['basic_password'], [
                    'style' => 'width: 100%;',
                ])}}
                <div class="text-danger">{{$errors->first('basic_password') ?? ''}}</div>
            </div>

        </div>

        <div class="w-50">
            <div class="vertical-contents">
                <div class="title">@lang('strings.theme')</div>
                @foreach ($themes as $theme)
                <input type="radio" id="login_image_radio{{$theme['id']}}" name="theme_id" value="{{$theme['id']}}" class="hidden_radio"
                    @if ($settings['theme_id'] == $theme['id'])
                        checked
                    @endif
                />
                <label for="login_image_radio{{$theme['id']}}">
                    <div style="margin: 3px; background: {{$theme['body_color']}}; border: 1px dotted {{$settings['border_color']}}">
                        <div style="margin: 6px 6px 0 6px; border: 1px solid {{$theme['border_color']}}; background: {{$theme['header_color']}};
                            text-align: center; color: #fff; font-size: 18px; font-weight: bold;">{{$theme['name']}}</div>
                        <div style="margin: 0 6px 6px 6px; border: 1px solid {{$theme['border_color']}}; background: {{$theme['background_color']}};
                            text-align: center; color: {{$theme['text_color']}};"><br></div>
                    </div>
                </label>
                @endforeach
                <div class="text-danger">{{$errors->first('thtme_id') ?? ''}}</div>
            </div>
        </div>
    </div>
    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.save')"></input>
    </div>
    {{Form::close()}}
</div>

@if (Session::get('result') == 1)
<script>
window.onload = function() {
    alert("@lang('strings.alert_messages.saved_settings')");
}
</script>
@endif

@endsection