<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>@lang('strings.title')</th>
            <td style="width: 90%;">
                {{Form::hidden('title', $articles->title)}}
                {{$articles->title}}
            </td>
        </tr>
        <tr>
            <th>@lang('strings.article_body')</th>
            <td>
                {{Form::hidden('body', $articles->body)}}
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
                {{Form::hidden('labels', $articles->labels ?? null)}}
                <nobr>
                    @foreach($labels as $label)
                    <a href="/articles/user/{{$articles->user_id}}?label={{$label->value}}" class="text-decoration-none">
                        <span class="label">{{$label->value}}</span>
                    </a><wbr>
                    @endforeach
                </nobr>
            </td>
        </tr>
    </tbody>
</table>
