<div id="formset-contents" class="card bg-light text-black shadow mb-3" >
    <div class="row card-body">
        <div class="col-md-2 col-4 pt-2">
            <span class="h6 text-nowrap">@lang('strings.input_type')</span>
        </div>
        <div class="col-md-4 col-8 pb-2">
            <select id="type" name="types[]" class="btn btn-secondary dropdown-toggle pr-1">
                @foreach ($types as $key => $value)
                <option value="{{$key}}"
                @if (!is_null($profile) && $key == $profile->type)
                    selected
                @endif
                >{{$value}}</option>
                @endforeach
            </select>
        </div>

        <div class="row col-md-6 col-12">
            <div class="col-md-3 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
            </div>
            <div class="col-md-9 col-8 pt-1 pb-2">
                {{Form::input('text', 'input_type_column_names[]', is_null($profile) ? '' : $profile->name, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
            <div class="col-md-3 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
            </div>
            <div class="col-md-9 col-8 pt-1 pb-2">
                {{Form::input('number', 'input_type_column_orders[]', is_null($profile) ? '' : $profile->order, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2',
                ])}}
            </div>
            
            <div id="select_list_name" class="col-md-3 col-4 pt-2"
            @if (is_null($profile) || $profile->type != App\Libs\InputType::CHOICE)
                style="display:none;"
            @else
                style="display:inline;"
            @endif>
                <span class="h6 text-nowrap">@lang('strings.select_list')</span>
            </div>
            <div id="select_list_value" class="col-md-9 col-8 pt-1 pb-2"
            @if (is_null($profile) || $profile->type != App\Libs\InputType::CHOICE)
                style="display:none;"
            @else
                style="display:inline;"
            @endif>
                <?php
                    $choices = '';
                    if (!is_null($profile) && $profile->type == App\Libs\InputType::CHOICE) {
                        $choices = implode(array_column($profile->choices->toArray(), 'name'), "\n");
                    }
                ?>
                <textarea class="form-control ml-2" name="input_type_column_choices[]">{{$choices}}</textarea>
            </div>
        </div>

        <button id="btn-delete" type="button" class="close" aria-label="Close" style="position: absolute; right: 10px; top: 4px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
