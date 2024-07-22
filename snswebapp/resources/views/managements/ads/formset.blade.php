<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', $ads['title'] ?? '', [])}}
    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body">{{$ads['body'] ?? ''}}</textarea>
</div>
