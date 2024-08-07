@extends('app')
@section('content')

<div id="formset" hidden>
    @include('managements.profileSettings.formset', [])
</div>

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-user-edit"></i> @lang('strings.profile_settings')</span>
    </div>

    {{Form::open(['name' => 'form', 'url' => '/managements/profile/settings', 'method' => 'post', 'files' => true])}}
    @csrf

    <div class="title">@lang('strings.fix_items')</div>
    <div class="formset-box" style="margin-bottom: 0px;">
        <table style="table-layout: fixed;">
            <tr>
                <th>@lang('strings.input_type_column_name')</th>
                <th>@lang('strings.display_flag')</th>
                <th>@lang('strings.user_editable')</th>
            </tr>
            <tr>
                <td>@lang('strings.email')</td>
                <td>{{Form::checkbox('is_display_email', null, $settings['is_display_email'])}}</td>
                <td>{{Form::checkbox('is_editable_email', null, $settings['is_editable_email'])}}</td>
            </tr>
            <tr>
                <td>@lang('strings.name')</td>
                <td>{{Form::checkbox('is_display_name', null, $settings['is_display_name'])}}</td>
                <td>{{Form::checkbox('is_editable_name', null, $settings['is_editable_name'])}}</td>
            </tr>
            <tr>
                <td>@lang('strings.birth_date')</td>
                <td>{{Form::checkbox('is_display_birthdate', null, $settings['is_display_birthdate'])}}</td>
                <td>{{Form::checkbox('is_editable_birthdate', null, $settings['is_editable_birthdate'])}}</td>
            </tr>
            <tr>
                <td>@lang('strings.group')</td>
                <td>{{Form::checkbox('is_display_group', null, $settings['is_display_group'])}}</td>
                <td>{{Form::checkbox('is_editable_group', null, $settings['is_editable_group'])}}</td>
            </tr>
        </table>
    </div>

    <div class="title">@lang('strings.customize_items')</div>
    <div id="items">
    @foreach ($profiles as $index => $profile)
        @include('managements.profileSettings.formset', compact('profile'))
    @endforeach
    </div>
    {{Form::close()}}
    <button id="btn-add" type="button" style="margin-left: 10px;">@lang('strings.add')</button>
</div>

@if ($errors->any())
<div class="text-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="flex-contents">
    <a href="javascript:form.submit()">
        <input type="submit" class="post" value="@lang('strings.save')"></input>
    </a>
</div>

<script>
$(document).on('click', 'button#btn-add', function(){
    $("div#items").append($("#formset").children().clone(true));
});

$(document).on('click', 'button#btn-delete', function(){
    var index = $("button#btn-delete").index(this);
    $('div#formset-contents').eq(index).remove();
});

$(document).on('change', 'select#type', function(){
    var index = $("select#type").index(this);
    if ($(this).val() == {{App\Libs\ProfileInputType::CHOICE}}) {
        $('div#select_list').eq(index).css('display', 'inline');
    } else {
        $('div#select_list').eq(index).css('display', 'none');
    }
});
</script>

@if (Session::get('result') == 1)
<script>
window.onload = function() {
    alert("@lang('strings.alert_messages.saved_settings')");
}
</script>
@endif

@endsection