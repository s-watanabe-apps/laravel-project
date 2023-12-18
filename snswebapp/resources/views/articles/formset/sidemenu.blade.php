<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th">アーカイブ</th>
        </tr>
        <tr>
            <td class="view-box">
                {{Form::select(
                    'archives',
                    array_merge([
                        '#' => '月を選択',
                        ], $sidemenus['archiveMonths'][0] ?? []
                    ),
                    old('archives') ?? 0,
                    [
                        'class' => 'w-100',
                        'onChange' => 'location.href=value;'
                    ]
                )}}
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th"><i class="fas fa-blog"></i> @lang('strings.latest_articles')</th>
        </tr>
        @foreach($sidemenus['latestArticles'] as $value)
        <tr>
            <td class="view-box">
                <a href="/articles/{{$value->id}}">{{$value->title}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th"><i class="fas fa-blog"></i> @lang('strings.popular_articles')</th>
        </tr>
        @foreach($sidemenus['favoriteArticles'] as $value)
        <tr>
            <td class="view-box">
                <a href="/articles/{{$value->id}}">{{$value->title}}</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th"><i class="fas fa-tags"></i> @lang('strings.label')</th>
        </tr>
        <tr>
            <td class="view-box">
                <nobr>
                    @foreach($sidemenus['userLabels'] as $label)
                    <a href="/articles/user/{{$articleUserId}}?label={{$label->value}}" class="text-decoration-none"><span class="label">{{$label->value}}</span></a><wbr>
                    @endforeach
                </nobr>
            </td>
        </tr>
    </tbody>
</table>
