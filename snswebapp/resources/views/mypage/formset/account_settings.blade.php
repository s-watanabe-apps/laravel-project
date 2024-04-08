<div class="title">@lang('strings.account_settings')</div>
<div class="input-label">@lang('strings.email')</div>
@if ($is_edit ?? false)
    {{Form::input('text', 'email', $email)}}
@else
    {{Form::input('text', 'email', $email, ['disabled'])}}
@endif
<div class="text-danger">{{$errors->first('email') ?? ''}}</div>

@if ($change_link)
<div class="grid-contents"><a href="{{$change_link}}">@lang('strings.change')</a></div>
@endif
