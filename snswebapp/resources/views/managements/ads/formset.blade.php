<div class="normal-box">
    <div class="vertical-contents">
        <div class="input-label">@lang('strings.title')</div>
        {{Form::input('text', 'title[]', $ads['title'] ?? '', [])}}
        <div class="input-label">@lang('strings.body')</div>
        <textarea id="{{$id}}" name="body[]">{{$ads['body'] ?? ''}}</textarea>
    </div>
</div>