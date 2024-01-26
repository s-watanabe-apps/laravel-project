@extends('app')
@section('content')

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-tools"></i> @lang('strings.site_settings')</div>

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
                    <label>{{Form::radio('status', '1', false, []) }}&nbsp;@lang('strings.anonymous_permisshon_not_allowed')</label>
                    <label>{{Form::radio('status', '0', true, []) }}&nbsp;@lang('strings.anonymous_permisshon_allowed')</label>
                </div>
                <div class="text-danger">{{$errors->first('display_flag') ?? ''}}</div>
            </div>
        </div>

        <div class="w-50">
        </div>
        
    </div>
</div>

@endsection