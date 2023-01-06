<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>
                @lang('strings.title')
            </th>
        </tr>
        <tr>
            <td>
                {{Form::text(
                    'title',
                    $freePages->title ?? old('title'),
                    ['id' => 'title', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.free_page_code')
            </th>
        </tr>
        <tr>
            <td>
                {{Form::text(
                    'code',
                    $freePages->code ?? ($code ?? old('code')),
                    ['id' => 'code', 'class' => 'form-control']
                )}}
                <div class="text-danger">{{$errors->first('code') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.body')
            </th>
        </tr>
        <tr>
            <td>
                <textarea class="form-control" name="body" id="summernote" id="summernote">{!! $freePages->body ?? old('body') !!}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </td>
        </tr>
    </tbody>
</table>