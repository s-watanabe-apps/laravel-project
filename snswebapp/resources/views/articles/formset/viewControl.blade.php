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
        @if (strtolower($method ?? null) == 'post' || strtolower($method ?? null) == 'put')
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
        @else
        <tr>
            <th>@lang('strings.contribute_date')</th>
            <td>
                {{isset($articles->created_at) ? $articles->created_at->format(\DateFormat::getDateTimeFullFormat()) : carbon()->format(\DateFormat::getDateTimeFullFormat())}}
            </td>
        </tr>
        @endif
    </tbody>
</table>
