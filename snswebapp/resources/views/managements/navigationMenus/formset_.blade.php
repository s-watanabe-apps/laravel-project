<div id="formset-contents" class="card bg-light text-black shadow mb-3" >
    <div class="row card-body">
        <div class="row col-md-5 col-12">
            <div class="col-md-2 col-3 pt-2 text-right">
                <span class="h6 text-nowrap">@lang('strings.input_type_column_name')</span>
            </div>
            <div class="col-md-10 col-9 pt-1 pb-2">
                {{Form::input('text', 'names[]', $navigationMenu->name ?? '', [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
        </div>

        <div class="row col-md-5 col-12">
            <div class="col-md-2 col-3 pt-2 text-right">
                <span class="h6 text-nowrap">リンク</span>
            </div>
            <div class="col-md-10 col-9 pt-1 pb-2">
                {{Form::input('text', 'links[]', $navigationMenu->link ?? '', [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
        </div>

        <div class="row col-md-2 col-12">
            <div class="col-md-6 col-3 pt-2 text-right">
                <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
            </div>
            <div class="col-md-6 col-9 pt-1 pb-2">
                {{Form::input('number', 'orders[]', $navigationMenu->order ?? '', [
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
