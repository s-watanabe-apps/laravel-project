<div class="title">@lang('strings.basic_settings')</div>

<!--
名前
-->
<div class="input-label">@lang('strings.name')</div>
@if ($is_edit ?? false)
{{Form::input('text', 'name', $user['name'] ?? '')}}
@else
{{Form::input('text', 'name', $user['name'] ?? '', ['disabled'])}}
@endif
<div class="text-danger">{{$errors->first('name')}}</div>

<!--
生年月日
-->
<div class="input-label">@lang('strings.birth_date')</div>
@if ($is_edit ?? false)
{{Form::input('text', 'birthdate', $user['birthdate'] ?? '', ['id' => 'birthdate'])}}
@else
{{Form::input('text', 'birthdate', $user['birthdate'] ?? '', ['disabled'])}}
@endif
<div class="text-danger">{{$errors->first('birthdate')}}</div>

<!--
ロール
-->
<div class="input-label">@lang('strings.role')</div>
@if ($is_edit ?? false)
<select name="role_id">
    <option value="{{App\Models\Roles::MEMBER}}">@lang('strings.roles.member')</option>
    <option value="{{App\Models\Roles::ADMIN}}">@lang('strings.roles.admin')</option>
</select>
@else
{{Form::input('text', 'role', $user['role'] ?? '', ['disabled'])}}
@endif
<div class="text-danger">{{$errors->first('role_id')}}</div>

<!--
グループ
-->
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
<div class="text-danger">{{$errors->first('group_code')}}</div>

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
