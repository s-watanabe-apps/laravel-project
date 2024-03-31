<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', $values['title'] ?? old('title'), [])}}
    <div class="text-danger">{{$errors->first('title') ?? ''}}</div>

    <div class="input-label">@lang('strings.free_page_code')</div>
    {{Form::input('text', 'code', $values['code'] ?? old('code'), [])}}
    <div class="text-danger">{{$errors->first('code') ?? ''}}</div>
    
    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body">{!!isset($values['body']) ? htmlspecialchars($values['body']) : old('body')!!}</textarea>
    <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

</div>
@include('shared.ckeditor', ['name' => 'body'])