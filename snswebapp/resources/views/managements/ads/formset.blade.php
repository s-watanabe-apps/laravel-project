<div class="normal-box">
    <div class="vertical-contents">
        <div class="input-label">@lang('strings.title')</div>
        {{Form::input('text', "title[]", $ads['title'] ?? '', [])}}
        <div class="input-label">@lang('strings.body')</div>
        <textarea id="{{$class}}{{$id}}" name="body[]">{{$ads['body'] ?? ''}}</textarea>

        <div class="input-label">@lang('strings.start_time')</div>
        {{Form::text(
            "start_time[]",
            str_datetime_format($value['start_time'] ?? (old('start_time') ?? date('Y-m-d H:00'))),
            ['id' => "{$class}_start_time{$id}", 'style' => 'width: 170px;']
        )}}
        <div class="text-danger">{{$errors->first('start_time') ?? ''}}</div>

        <div class="input-label">@lang('strings.end_time')</div>
        {{Form::text(
            "end_time[]",
            str_datetime_format($value['end_time'] ?? (old('end_time') ?? null), null),
            ['id' => "{$class}_end_time{$id}", 'style' => 'width: 170px;']
        )}}
        <div class="text-danger">{{$errors->first('end_time') ?? ''}}</div>

        <div class="input-label">@lang('strings.status')</div>
        <div class="radio">
            <label>{{Form::radio("status[]", '1', ($values['status'] ?? 0) == 1, []) }} <span class="enable">@lang('strings.enable')</span></label>
            <label>{{Form::radio("status[]", '0', ($values['status'] ?? 0) == 0, []) }} <span class="disable">@lang('strings.disable')</span></label>
        </div>
        <div class="text-danger">{{$errors->first('status') ?? ''}}</div>

        <script>
        window.addEventListener("load", function() {
            $('#{{$class}}_start_time{{$id}}').datetimepicker({
                format: 'Y/m/d H:i',
            });
            $('#{{$class}}_end_time{{$id}}').datetimepicker({
                format: 'Y/m/d H:i',
            });
        });

        $.datetimepicker.setLocale('{{\App::getLocale()}}');
        </script>

    </div>
</div>

