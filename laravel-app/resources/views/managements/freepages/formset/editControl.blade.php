<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.title')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                {{Form::text(
                    'title',
                    $freePages->title ?? old('title'),
                    ['id' => 'title', 'class' => 'form-control',]
                )}}
                <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.free_page_code')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                {{Form::text(
                    'code',
                    $freePages->code ?? ($code ?? old('code')),
                    ['id' => 'code', 'class' => 'form-control']
                )}}
                <div class="text-danger">{{$errors->first('code') ?? ''}}</div>
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.body')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                <textarea class="form-control" name="body" id="summernote" id="summernote">{!! $freePages->body ?? old('body') !!}</textarea>
                <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
            </td>
        </tr>
    </tbody>
</table>