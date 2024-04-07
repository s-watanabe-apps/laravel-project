<div class="title">@lang('strings.basic_settings')</div>
<div class="input-label">@lang('strings.name')</div>
{{Form::input('text', 'name', $user['name'] ?? '', $attributes)}}

<div class="input-label">@lang('strings.birth_date')</div>
{{Form::input('text', 'birthdate', $user['birthdate'] ?? '', array_merge($attributes, ['id' => 'birthdate']))}}

<div class="input-label">@lang('strings.role')</div>
@if ($attributes)
{{Form::input('text', 'role', '', $attributes)}}
@else
<select name="role_id">
    <option value="member">@lang('strings.roles.member')</option>
    <option value="admin">@lang('strings.roles.admin')</option>
</select>
@endif

<div class="input-label">@lang('strings.group')</div>
@if ($attributes)
{{Form::input('text', 'group_name', $user['group_name'] ?? '', $attributes)}}
@else
<select name="group_code">
    <option value="0"></option>
    @foreach ($groups as $group)
    <option value="{{$group['code']}}">{{$group['name']}}</option>
    @endforeach
</select>
@endif

@if ($change_link)
<div class="grid-contents"><a href="/mypage/profiles">@lang('strings.change')</a></div>
@endif

<script>
window.addEventListener("load", function() {
    $('#birthdate').datetimepicker({
        format: 'Y/m/d',
        timepicker: false,
    });
});
console.log($('#birthdate'));

$.datetimepicker.setLocale('{{\App::getLocale()}}');
</script>
