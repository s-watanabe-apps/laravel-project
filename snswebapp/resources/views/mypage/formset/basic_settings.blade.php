<div class="title">@lang('strings.basic_settings')</div>
<div class="input-label">@lang('strings.name')</div>
@if ($is_edit ?? false)
{{Form::input('text', 'name', $user['name'] ?? '')}}
@else
{{Form::input('text', 'name', $user['name'] ?? '', ['disabled'])}}
@endif

<div class="input-label">@lang('strings.birth_date')</div>
@if ($is_edit ?? false)
{{Form::input('text', 'birthdate', $user['birthdate'] ?? '', ['id' => 'birthdate'])}}
@else
{{Form::input('text', 'birthdate', $user['birthdate'] ?? '', ['disabled'])}}
@endif

<div class="input-label">@lang('strings.role')</div>
@if ($is_edit ?? false)
<select name="role_id">
    <option value="member">@lang('strings.roles.member')</option>
    <option value="admin">@lang('strings.roles.admin')</option>
</select>
@else
{{Form::input('text', 'role', '', ['disabled'])}}
@endif

<div class="input-label">@lang('strings.group')</div>
@if ($is_edit ?? false)
<select name="group_code">
    <option value="0"></option>
    @foreach ($groups as $group)
    <option value="{{$group['code']}}">{{$group['name']}}</option>
    @endforeach
</select>
@else
{{Form::input('text', 'group_name', $user['group_name'] ?? '', ['disabled'])}}
@endif

@if ($change_link)
<div class="grid-contents"><a href="{{$change_link}}">@lang('strings.change')</a></div>
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
