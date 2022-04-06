<div class="card bg-light text-black shadow mb-3" >
    <div class="row card-body">
        <div class="col-md-2 col-4 pt-2">
            <span class="h6 text-nowrap">@lang('strings.input_type')</span>
        </div>
        <div class="col-md-4 col-8 pb-2">
            <select name="types[]" class="btn btn-secondary dropdown-toggle">
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
            <div class="col-md-2 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
            </div>
            <div class="col-md-10 col-8 pt-1 pb-2">
                {{Form::input('text', 'input_type_column_names[]', is_null($profile) ? '' : $profile->name, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
            <div class="col-md-2 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
            </div>
            <div class="col-md-10 col-8 pt-1 pb-2">
                {{Form::input('number', 'input_type_column_orders[]', is_null($profile) ? '' : $profile->order, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2',
                ])}}
            </div>
            <div class="col-md-2 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.select_list')</span>
            </div>
            <div class="col-md-10 col-8 pt-1 pb-2">
                <textarea class="form-control ml-2" name="input_type_column_choices[]">{{!is_null($profile) && $profile->type == 3 ? implode(array_column($profile->choices->toArray(), 'name'), "\n") : ''}}</textarea>
            </div>
        </div>
    </div>
</div>
