@extends('app')
@section('content')

<div id="formset" hidden>
    @include('managements.navigationMenus.formset', [])
</div>

<div class="contents">
    <div class="subject"><i class="fas fa-fw fa-tools"></i> @lang('strings.navigation_management')</div>

    {{Form::open(['name' => 'form', 'url' => '/managements/navigations/register', 'method' => 'post', 'files' => true])}}
    @csrf

    <div id="items">
    @foreach ($navigations as $index => $nav)
        @include('managements.navigationMenus.formset', compact('nav'))
    @endforeach
    </div>

    {{Form::close()}}
    <button id="btn-add" class="btn-add" type="button">@lang('strings.add')</button>
</div>

<!-- Toast -->
@if (Session::get('result') == 1)
<script>
window.onload = function() {
    alert('更新しました。');
}
</script>
@endif

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

@endsection