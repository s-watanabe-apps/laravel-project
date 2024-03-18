<div class="title">@lang('strings.account_settings')</div>
<div class="input-label">@lang('strings.email')</div>
{{Form::input('text', 'email', $email, $attributes)}}
@if ($change_link)
<span><a href="/mapage/emailchange">@lang('strings.change')</a></span>
@endif
