@extends('app')
@section('content')

<div id="formset" hidden>
    @include('managements.groups.formset', [])
</div>

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-tools"></i> @lang('strings.group_management')</span>
    </div>

    {{Form::open(['name' => 'form', 'url' => '/managements/navigations/register', 'method' => 'post', 'files' => true])}}
    @csrf

    <div id="items">
    @foreach ($groups as $index => $group)
        @include('managements.groups.formset', compact('group'))
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
        console.log(index);
        $('div#select_list_name').eq(index).css('display', 'inline');
        $('div#select_list_value').eq(index).css('display', 'inline');
    } else {
        $('div#select_list_name').eq(index).css('display', 'none');
        $('div#select_list_value').eq(index).css('display', 'none');
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