<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', $articles['title'] ?? '', [])}}
    <div class="text-danger">{{$errors->first('title') ?? ''}}</div>

    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body">{{$articles['body'] ?? ''}}</textarea>
    <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

    <div class="input-label">@lang('strings.label')</div>
    {{Form::input('text', 'labels', $labels
        ? implode(array_column($labels, 'value'), ' ')
        : ''
        , [])}}
    <div class="text-danger">{{$errors->first('labels') ?? ''}}</div>

    <div class="input-label">@lang('strings.display_flag')</div>
    <div style="display: flex;">
        <label>{{Form::radio('status', '1', ($articles['status'] ?? true) == 1, []) }}&nbsp;<span class="enable">@lang('strings.enable')</span></label>
        <label>{{Form::radio('status', '0', ($articles['status'] ?? true) == 0, []) }}&nbsp;<span class="disable">@lang('strings.disable')</span></label>
    </div>
    <div class="text-danger">{{$errors->first('display_flag') ?? ''}}</div>
</td>
