<div id="formset-contents" class="card bg-light text-black shadow mb-3" >
    <div class="row card-body">
        <div class="col-md-2 col-4 pt-2">
            <span class="h6 text-nowrap">@lang('strings.input_type')</span>
        </div>

        <div class="row col-md-6 col-12">
            <div class="col-md-3 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
            </div>
            <div class="col-md-9 col-8 pt-1 pb-2">
                {{Form::input('text', 'names[]', !isset($navigationMenu) ? '' : $navigationMenu->name, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
            <div class="col-md-3 col-4 pt-2">
                <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
            </div>
            <div class="col-md-9 col-8 pt-1 pb-2">
                {{Form::input('number', 'orders[]', !isset($navigationMenu) ? '' : $navigationMenu->sort, [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2',
                ])}}
            </div>
        </div>

        <button id="btn-delete" type="button" class="close" aria-label="Close" style="position: absolute; right: 10px; top: 4px;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
