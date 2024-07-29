<div id="formset-contents" class="grid-contents formset-box" style="position: relative;">
    <div class="w-25">
        <span class="input-label">@lang('strings.id')</span>
        <div>
        {{Form::input('number', 'ids[]', $type['id'] ?? '', [
            'style' => 'width: 100%;',
        ])}}
        </div>
    </div>

    <div class="w-75">
        <span class="input-label">@lang('strings.inquiry_type')</span>
        <div>
            {{Form::input('text', 'names[]', $type['name'] ?? '', [
                'style' => 'width: 100%;',
            ])}}
        </div>
    </div>

    <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
        <span aria-hidden="true"><b>&times;</b></span>
    </button>
</div>
