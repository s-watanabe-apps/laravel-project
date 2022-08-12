<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th">アーカイブ</th>
        </tr>
        <tr>
            <td class="view-box">
                {{Form::select(
                    'archives',
                    [
                        '#1' => '月を選択',
                        '#2' => '2022/01 (1)',
                        '#3' => '2022/02 (2)',
                        '#4' => '2022/03 (3)',
                    ],
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
        @foreach($latestArticles as $value)
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
            <th class="text-secondary text-nowrap bg-th">@lang('strings.popular_articles')</th>
        </tr>
        <tr>
            <td class="view-box">
            </td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="text-secondary text-nowrap bg-th">@lang('strings.label')</th>
        </tr>
        <tr>
            <td class="view-box">
                <nobr>
                    @foreach($userLabels as $label)
                    <a href="/articles/user/TODO?label={{$label->label_id}}" class="text-decoration-none"><span class="label">{{$label->value}}</span></a><wbr>
                    @endforeach
                </nobr>
            </td>
        </tr>
    </tbody>
</table>
