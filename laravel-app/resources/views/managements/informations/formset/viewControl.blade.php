<table class="table table-bordered responsive-table">
    <tbody>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.title')
            </th>
            <td class="bg-light text-dark">
                <i class="fas {{$informationMark}} text-primary-50"></i>
                {{$informations->title}}
                {{Form::hidden('mark_id', $informations->mark_id)}}
                {{Form::hidden('title', $informations->title)}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.body')
            </th>
            <td class="bg-light text-dark">
                {!!$informations->body!!}
                {{Form::hidden('body', $informations->body)}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.start_time')
            </th>
            <td class="bg-light text-dark">
                {{$informations->start_time}}
                {{Form::hidden('start_time', $informations->start_time)}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.end_time')
            </th>
            <td class="bg-light text-dark">
                {{$informations->end_time}}
                {{Form::hidden('end_time', $informations->end_time)}}
            </td>
        </tr>
        <tr>
            <th class="bg-th text-secondary text-nowrap w-25">
                @lang('strings.status')
            </th>
            <td class="bg-light">
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
