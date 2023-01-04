<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th>
                @lang('strings.title')
            </th>
            <td>
                <i class="fas {{$informationMark}} text-primary-50"></i>
                {{$informations->title}}
                {{Form::hidden('mark_id', $informations->mark_id)}}
                {{Form::hidden('title', $informations->title)}}
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.body')
            </th>
            <td>
                {!!$informations->body!!}
                {{Form::hidden('body', $informations->body)}}
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.start_time')
            </th>
            <td>
                {{$informations->start_time}}
                {{Form::hidden('start_time', $informations->start_time)}}
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.end_time')
            </th>
            <td>
                {{$informations->end_time}}
                {{Form::hidden('end_time', $informations->end_time)}}
            </td>
        </tr>
        <tr>
            <th>
                @lang('strings.status')
            </th>
            <td>
                <input type="checkbox"
                    @if ($informations->status == \Status::ENABLED)
                        checked
                    @endif
                    name="status"
                    value="1"
                    data-onstyle="success" data-offstyle="secondary"
                    data-toggle="toggle"
                    data-size="sm"
                    data-on="@lang('strings.enable')"
                    data-off="@lang('strings.disable')" />
            </td>
        </tr>
    </tbody>
</table>
