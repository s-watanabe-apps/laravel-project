<div class="title">@lang('strings.account_settings')</div>
<div class="input-label">@lang('strings.email')</div>
{{Form::input('text', 'email', $email, $attributes)}}
@if ($change_link)
<div class="grid-contents"><a href="/mapage/emailchange">@lang('strings.change')</a></div>
@endif
