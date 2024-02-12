<div class="vertical-contents">
    <div class="input-label">@lang('strings.class')</div>
    <div><i class="fas fa-fw {{$values['style']}}"></i> {{__('strings.information_categories')[$values['style']]}}</div>
    
    <div class="input-label">@lang('strings.title')</div>
    <div>{{$values['title']}}

    <div class="input-label">@lang('strings.body')</div>
    <div class="text-preview">{!!$values['body'] ?? '<br>'!!}</div>

    <div class="input-label">@lang('strings.start_time')</div>
    <div>{{str_datetime_format($values['start_time'])}}</div>

    <div class="input-label">@lang('strings.end_time')</div>
    <div>{{str_datetime_format($values['end_time'])}}</div>
    
    <div class="input-label">@lang('strings.status')</div>
    <div>
        @if ($values['status'] == \Status::ENABLED)
        <span class="enable">@lang('strings.enable')</span>
        @else
        <span class="disable">@lang('strings.disable')</span>
        @endif
    </div>
</td>