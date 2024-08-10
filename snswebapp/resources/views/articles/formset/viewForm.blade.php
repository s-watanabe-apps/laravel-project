<div class="vertical-contents">
    <div class="input-label">@lang('strings.title')</div>
    <div>{{$validated['title']}}</div>
    {{Form::hidden('title', $validated['title'])}}

    <div class="input-label">@lang('strings.body')</div>
    <div class="text-preview">{!! \UserHtml::escapeScript($validated['body']) ?? '<br>'!!}</div>
    {{Form::hidden('body', \UserHtml::escapeScript($validated['body'] ?? ''))}}

    <div class="input-label">@lang('strings.label')</div>
    <nobr>
        @foreach($labels as $value)
        <a href="/articles/user/{{user()->id}}?label={{$value}}" class="text-decoration-none">
            <span class="tag">{{$value}}</span>
        </a><wbr>
        @endforeach
    </nobr>
    {{Form::hidden('labels', $validated['labels'])}}

    <div class="input-label">@lang('strings.link')</div>
    <div>{{$validated['link']}}</div>
    {{Form::hidden('link', $validated['link'])}}

    <div class="input-label">@lang('strings.display_flag')</div>
    @if ($validated['status'] == \App\Libs\Status::ENABLED)
    <label><span class="enable">@lang('strings.enable')</span></label>
    @else
    <label><span class="disable">@lang('strings.disable')</span></label>
    @endif
    {{Form::hidden('status', $validated['status'])}}
</td>
