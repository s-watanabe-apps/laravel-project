<div id="formset-contents" class="grid-contents formset-box" style="position: relative;">
    <div class="w-33">
        <span class="input-label">@lang('strings.input_type_column_name')</span>
        <div>
            {{Form::input('text', 'names[]', $nav['name'] ?? '', [
                'style' => 'width: 100%;',
            ])}}
        </div>
    </div>

    <div class="w-33">
        <span class="input-label">リンク</span>
        <div>
        {{Form::input('text', 'links[]', $nav['link'] ?? '', [
            'style' => 'width: 100%;',
        ])}}
        </div>
    </div>

    <div class="w-33">
        <span class="input-label">@lang('strings.sort_order')</span>
        <div>
        {{Form::input('number', 'orders[]', $nav['order'] ?? '', [
            'style' => 'width: 100%;',
        ])}}
        </div>
    </div>

    <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
        <span aria-hidden="true"><b>&times;</b></span>
    </button>
</div>
