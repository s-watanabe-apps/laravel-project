<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>@lang('strings.title')</th>
            <td style="width: 90%;">
                <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{$articles->title ?? ''}}">
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>@lang('strings.article_body')</th>
            <td>
                <textarea class="form-control" name="body" id="summernote">{{$articles->body ?? ''}}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>@lang('strings.label')</th>
            <td>
                <input type="text" name="labels" class="form-control" value="" />
                <div class="text-danger">{{$errors->first('labels') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>@lang('strings.display_flag')</th>
            <td>
                <input type="checkbox"
                    name="status"
                    @if (($articles->status ?? \Status::DISABLED) == \Status::ENABLED)
                        checked
                    @endif
                    data-onstyle="success" data-offstyle="secondary"
                    data-toggle="toggle"
                    data-size="sm"
                    data-on="@lang('strings.enable')"
                    data-off="@lang('strings.disable')" />
                <div class="text-danger">{{$errors->first('status') ?? ''}}</div>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-auto mb-5 text-center">
    <a href="javascript:article.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
        <i class="fas fa-check fa-sm text-white-50"></i>&nbsp;@lang('strings.confirm')
    </a>
</div>
