<div class="normal-box">
    <div class="vertical-contents">
        <div class="input-label">@lang('strings.title')</div>
        {{Form::input('text', "title[]", $values['title'] ?? '')}}
        <div class="text-danger">{{$errors->first('title.' . ($id - 1))}}</div>

        <div class="input-label">@lang('strings.body')</div>
        <textarea id="{{$class}}{{$id}}" name="body[]">{{$values['body'] ?? ''}}</textarea>
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

