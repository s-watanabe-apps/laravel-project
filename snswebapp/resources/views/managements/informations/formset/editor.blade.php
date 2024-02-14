<div class="vertical-contents">
    <div class="input-label">@lang('strings.class')</div>
    <div class="radio">
        @foreach ($categories as $category)
        <label>{{Form::radio('category_id', $category['id'],
            $category['id'] == ($values['category_id'] ?? 1), [])}} <i class="fas fa-fw {{$category['style']}}"></i> {{__('strings.information_categories')[$category['style']]}}</label>
        @endforeach
    </div>
    <div class="text-danger">{{$errors->first('category_id') ?? ''}}</div>

    <div class="input-label">@lang('strings.title')</div>
    {{Form::input('text', 'title', $values['title'] ?? old('title'), [])}}
    <div class="text-danger">{{$errors->first('title') ?? ''}}</div>

    <div class="input-label">@lang('strings.body')</div>
    <textarea id="editor" name="body">{!!$values['body'] ?? old('body')!!}</textarea>
    <div class="text-danger">{{$errors->first('body') ?? ''}}</div>

    <div class="input-label">@lang('strings.start_time')</div>
    {{Form::text(
        'start_time',
        str_datetime_format($value['start_time'] ?? (old('start_time') ?? date('Y-m-d H:00'))),
        ['id' => 'start_time', 'style' => 'width: 170px;']
    )}}
    <div class="text-danger">{{$errors->first('start_time') ?? ''}}</div>

    <div class="input-label">@lang('strings.end_time')</div>
    {{Form::text(
        'end_time',
        str_datetime_format($value['end_time'] ?? (old('end_time') ?? null), null),
        ['id' => 'end_time', 'style' => 'width: 170px;']
    )}}
    <div class="text-danger">{{$errors->first('end_time') ?? ''}}</div>

    <div class="input-label">@lang('strings.status')</div>
    <div class="radio">
        <label>{{Form::radio('status', '1', ($values['status'] ?? 0) == 1, []) }} <span class="enable">@lang('strings.enable')</span></label>
        <label>{{Form::radio('status', '0', ($values['status'] ?? 0) == 0, []) }} <span class="disable">@lang('strings.disable')</span></label>
    </div>
    <div class="text-danger">{{$errors->first('status') ?? ''}}</div>
</td>

<!--<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>-->
<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
<script>
editor = CKEDITOR.replace('editor', {
    contentsCss: '/css/editor.css',
    uiColor: '#eeeeee',
    height: 400,
    disableNativeSpellChecker: true,
    removeButtons: 'Save,NewPage,About',
    colorButton_backStyle: {
        element: 'span',
        styles: { 'background-color': '#(color)' }
    },
    colorButton_colors: 'FontColor1/FF9900,FontColor2/0066CC,FontColor3/F00',
});

editor.name = 'body';
console.log(editor);


window.addEventListener("load", function() {
    $('#start_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
    $('#end_time').datetimepicker({
        format: 'Y/m/d H:i',
    });
});

$.datetimepicker.setLocale('ja');
</script>
