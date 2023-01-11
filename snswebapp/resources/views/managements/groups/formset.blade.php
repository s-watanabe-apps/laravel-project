<div id="formset-contents" class="card bg-light text-black shadow mb-3" >
    <div class="row card-body">
        <div class="row col-md-5 col-12">
            <div class="col-md-4 col-4 pt-2 text-right">
                <span class="h6 text-nowrap">@lang('strings.group_code')</span>
            </div>
            <div class="col-md-8 col-8 pt-1 pb-2">
                {{Form::input('text', 'codes[]', $group->code ?? '', [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
        </div>

        <div class="row col-md-5 col-12">
            <div class="col-md-3 col-4 pt-2 text-right">
                <span class="h6 text-nowrap">@lang('strings.group_name')</span>
            </div>
            <div class="col-md-9 col-8 pt-1 pb-2">
                {{Form::input('text', 'names[]', $group->name ?? '', [
                    'style' => 'width: 100%;',
                    'class' => 'ml-2'
                ])}}
            </div>
        </div>

        <div class="row col-md-2 col-12">
            <div class="col-md-6 col-4 pt-2 text-right">
                <span class="h6 text-nowrap">@lang('strings.sort_order')</span>
            </div>
            <div class="col-md-6 col-8 pt-1 pb-2">
                {{Form::input('number', 'orders[]', $group->order ?? '', [
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
