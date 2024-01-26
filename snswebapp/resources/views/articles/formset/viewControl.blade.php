<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    <div>{{$validated['title']}}</div>
    {{Form::hidden('title', $validated['title'])}}
</div>

<div class="vertical-contents">
    <div class="input-label">@lang('strings.body')</div>
    <div class="text-preview">{!!$validated['body'] ?? '<br>'!!}</div>
    {{Form::hidden('body', $validated['body'] ?? '')}}
</div>

<div class="vertical-contents">
    <div class="input-label">@lang('strings.label')</div>
    <nobr>
        @foreach($labels as $value)
        <a href="/articles/user/{{user()->id}}?label={{$value}}" class="text-decoration-none">
            <span class="tag">{{$value}}</span>
        </a><wbr>
        @endforeach
    </nobr>
    {{Form::hidden('labels', $validated['labels'])}}
</td>

<div class="vertical-contents">
    <div class="input-label">@lang('strings.display_flag')</div>
    <div>{{\App\Libs\Status::get_status_name($validated['status'])}}</div>
    {{Form::hidden('status', $validated['status'])}}
</td>
