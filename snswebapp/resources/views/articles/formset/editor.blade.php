<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', '', [])}}
    <div class="text-danger">{{$errors->first('title') ?? ''}}</div>

    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body"></textarea>
    <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

    <div class="input-label">@lang('strings.label')</div>
    {{Form::input('text', 'labels', '', [])}}
    <div class="text-danger">{{$errors->first('labels') ?? ''}}</div>

    <div class="input-label">@lang('strings.display_flag')</div>
    <div style="display: flex;">
        <label>{{Form::radio('status', '1', false, []) }}&nbsp;@lang('strings.enable')</label>
        <label>{{Form::radio('status', '0', true, []) }}&nbsp;@lang('strings.disable')</label>
    </div>
    <div class="text-danger">{{$errors->first('display_flag') ?? ''}}</div>
</td>
