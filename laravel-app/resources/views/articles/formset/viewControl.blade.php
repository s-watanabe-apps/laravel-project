<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>@lang('strings.title')</th>
            <td>
                {{$articles->title}}
            </td>
        </tr>
        <tr>
            <th>@lang('strings.article_body')</th>
            <td>
                {!!$articles->body!!}
            </td>
        </tr>
        <tr>
            <th>@lang('strings.contributor')</th>
            <td>
                {{$articles->name ?? user()->name}}
            </td>
        </tr>
        <tr>
            <th>@lang('strings.contribute_date')</th>
            <td>
                {{isset($articles->created_at) ? $articles->created_at->format(\DateFormat::getDateTimeFullFormat()) : carbon()->format(\DateFormat::getDateTimeFullFormat())}}
            </td>
        </tr>
        <tr>
            <th>@lang('strings.label')</th>
            <td>
                <nobr>
                    @foreach($labels as $label)
                    <a href="/articles/user/{{$articles->user_id}}?label={{$label->label_id}}" class="text-decoration-none"><span class="label">{{$label->value}}</span></a><wbr>
                    @endforeach
                </nobr>
            </td>
        </tr>
    </tbody>
</table>
