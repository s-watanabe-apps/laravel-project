<div class="vertical-contents">
    <div class="input-label">@lang('strings.class')</div>
    <div class="radio">
        @foreach ($marks as $value)
        <label>{{Form::radio('mark_id', $value['id'],
            $value['id'] == 1, [])}} <i class="fas fa-fw {{$value['mark']}}"></i> {{__('strings.information_marks')[$value['mark']]}}</label>
        @endforeach
    </div>
    <div class="text-danger">{{$errors->first('mark') ?? ''}}</div>

    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', '', [])}}
    <div class="text-danger">{{$errors->first('title') ?? ''}}</div>

    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body"></textarea>
    <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

    <div class="input-label">@lang('strings.start_time')</div>
    {{Form::text(
        'start_time',
        str_datetime_format(date('Y-m-d H:00')),
        ['id' => 'start_time', 'style' => 'width: 170px;']
    )}}
    <div class="text-danger">{{$errors->first('start_time') ?? ''}}</div>

    <div class="input-label">@lang('strings.end_time')</div>
    {{Form::text(
        'end_time',
        '',
        ['id' => 'end_time', 'style' => 'width: 170px;']
    )}}
    <div class="text-danger">{{$errors->first('end_time') ?? ''}}</div>

    <div class="input-label">@lang('strings.status')</div>
    <div class="radio">
        <label>{{Form::radio('status', '1', false, []) }} <span class="enable">@lang('strings.enable')</span></label>
        <label>{{Form::radio('status', '0', true, []) }} <span class="disable">@lang('strings.disable')</span></label>
    </div>
    <div class="text-danger">{{$errors->first('status') ?? ''}}</div>
</td>

<script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>
<script>
editor = CKEDITOR.replace('editor', {
    contentsCss: '/css/editor.css',
    uiColor: '#eeeeee',
    height: 400,
});
editor.name = 'body';
//console.log(editor);

window.addEventListener("load", function() {
    $('#start_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
});

window.addEventListener("load", function() {
    $('#end_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
});

$.datetimepicker.setLocale('ja');
</script>
