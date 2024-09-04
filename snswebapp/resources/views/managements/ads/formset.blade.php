<div class="normal-box">
    <div class="vertical-contents">
        <div class="input-label">@lang('strings.title')</div>
        {{Form::input('text', "title[]", $ads['title'] ?? '')}}
        <div class="text-danger">{{$errors->first('title.' . ($id - 1))}}</div>

        <div class="input-label">@lang('strings.body')</div>
        <textarea id="{{$class}}{{$id}}" name="body[]">{{$ads['body'] ?? ''}}</textarea>
        <div class="text-danger">{{$errors->first('body.' . ($id - 1))}}</div>

        <div class="input-label">@lang('strings.start_time')</div>
        {{Form::text(
            "start_time[]",
            str_datetime_format(date('Y-m-d H:00'), ''),
            ['id' => "{$class}_start_time{$id}", 'style' => 'width: 170px;']
        )}}

        <div class="input-label">@lang('strings.end_time')</div>
        {{Form::text(
            "end_time[]",
            str_datetime_format(null, ''),
            ['id' => "{$class}_end_time{$id}", 'style' => 'width: 170px;']
        )}}

        <div class="input-label">@lang('strings.status')</div>
        <div class="radio">
            <label>{{Form::radio(
                "status." . ($id - 1)
                , '1'
                , ($values['status'] ?? 0) == 1, [])
            }} <span class="enable">@lang('strings.enable')</span></label>
            <label>{{Form::radio(
                "status." . ($id - 1),
                '0',
                ($values['status'] ?? 0) == 0, [])
            }}<span class="disable">@lang('strings.disable')</span></label>
        </div>

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

