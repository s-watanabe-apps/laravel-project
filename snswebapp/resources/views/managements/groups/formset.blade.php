<div id="formset-contents" class="grid-contents formset-box" style="position: relative;">
    <div class="w-33">
        <span class="input-label">@lang('strings.group_code')</span>
        <div>
            {{Form::input('text', 'codes[]', $group['code'] ?? '', [
                'style' => 'width: 100%;',
            ])}}
        </div>
    </div>

    <div class="w-33">
        <span class="input-label">@lang('strings.group_name')</span>
        <div>
        {{Form::input('text', 'names[]', $group['name'] ?? '', [
            'style' => 'width: 100%;',
        ])}}
        </div>
    </div>

    <div class="w-33">
        <span class="input-label">@lang('strings.sort_order')</span>
        <div>
        {{Form::input('number', 'orders[]', $group['order'] ?? '', [
            'style' => 'width: 100%;',
        ])}}
        </div>
    </div>

    <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
        <span aria-hidden="true"><b>&times;</b></span>
    </button>
</div>
