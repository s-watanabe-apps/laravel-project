<div id="formset-contents" class="grid-contents formset-box" style="position: relative;">
    <div class="row">
        <div class="input-label">@lang('strings.title')</div>
        {{Form::input('text', 'title', $ads['title'] ?? '', [])}}
        <div class="input-label">@lang('strings.body')</div>
        <textarea id="editor" name="body">{{$ads['body'] ?? ''}}</textarea>
    </div>

    <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
        <span aria-hidden="true"><b>&times;</b></span>
    </button>
</div>
