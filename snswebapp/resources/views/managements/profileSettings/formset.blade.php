<div id="formset-contents" class="grid-contents formset-box" style="position: relative;">
    <div class="w-50">
        <span class="input-label">@lang('strings.input_type')</span>
        <div>
            <select id="type" name="types[]" style="width: 100%;">
                @foreach ($types as $key => $value)
                <option value="{{$key}}"
                @if (isset($profile['type']) && $key == $profile['type'])
                    selected
                @endif
                >{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="w-50">
        <span class="input-label">@lang('strings.input_type_column_name')</span>
        {{Form::input('text', 'names[]', isset($profile['name']) ? $profile['name'] : '', [
            'style' => 'width: 100%;',
        ])}}
        <span class="input-label">@lang('strings.sort_order')</span>
        {{Form::input('number', 'orders[]', isset($profile['order']) ? $profile['order'] : '', [
            'style' => 'width: 100%;',
        ])}}
        <div id="select_list"
            @if (!isset($profile['type']) || $profile['type'] != App\Libs\ProfileInputType::CHOICE) {
                style="display:none;"
            @else
                style="display:inline;"
            @endif
        >
            <?php
                $choices = '';
                if (isset($profile['type']) && $profile['type'] == App\Libs\ProfileInputType::CHOICE) {
                    $choices = implode("\n", array_column($profile['choices'], 'name'));
                }
            ?>

            <span class="input-label">@lang('strings.select_list')</span>
            <textarea style="width: 100%;" rows="3" name="choices[]">{{$choices}}</textarea>
        </div>
    
    </div>

    <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
        <span aria-hidden="true"><b>&times;</b></span>
    </button>
</div>
