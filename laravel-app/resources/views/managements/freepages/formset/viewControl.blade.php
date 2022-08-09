<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.title')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                {{$freePages->title}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.free_page_code')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                {{$freePages->code}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.body')
            </th>
        </tr>
        <tr>
            <td class="bg-light">
                {!! $freePages->body ?? old('body') !!}
            </td>
        </tr>
    </tbody>
</table>