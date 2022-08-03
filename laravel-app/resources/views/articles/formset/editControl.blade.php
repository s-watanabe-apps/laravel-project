<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.title')</th>
            <td>
                <input type="text" name="title" class="form-control" id="title" placeholder="" value="{{$articles->title ?? ''}}">
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.article_body')</th>
            <td>
                <textarea class="form-control" name="body" id="summernote">{{$articles->body ?? ''}}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </td>
        </tr>
    </tbody>
</table>

<div class="col-auto mb-5 text-center">
    <a href="javascript:article.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
        <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.confirm')
    </a>
</div>
