<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.title')</th>
            <td class="view-box">
                {{$articles->title}}
            </td>
        </tr>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.article_body')</th>
            <td class="view-box">
                {!!$articles->body!!}
            </td>
        </tr>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.contributor')</th>
            <td class="view-box">
                {{$articles->name ?? $user->name}}
            </td>
        </tr>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.contribute_date')</th>
            <td class="view-box">
                {{isset($articles->created_at) ? $articles->created_at->format(\DateFormat::getDateTimeFullFormat()) : carbon()->format(\DateFormat::getDateTimeFullFormat())}}
            </td>
        </tr>
    </tbody>
</table>
