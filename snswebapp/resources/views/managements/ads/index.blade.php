@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-tools"></i> @lang('strings.ads_management')</span>
    </div>

    {{Form::open(['name' => 'form', 'url' => '/managements/ads/register', 'method' => 'post', 'files' => true])}}
    @csrf


    <div class="title">1つめの広告</div>
    <div class="normal-box" style="position: relative;">
        <div class="vertical-contents">
            <div class="input-label">@lang('strings.title')</div>
            {{Form::input('text', 'title', $ads['title'] ?? '', [])}}
            <div class="input-label">@lang('strings.body')</div>
            <textarea id="editor1" name="body1">{{$ads['body'] ?? ''}}</textarea>
        </div>
        <button id="btn-delete" type="button" style="position: absolute; top: 10px; right:10px; height: auto;">
            <span aria-hidden="true"><b>&times;</b></span>
        </button>
    </div>

    <div class="title">2つめの広告</div>
    <div class="normal-box">
        <div class="vertical-contents">
            <div class="input-label">@lang('strings.title')</div>
            {{Form::input('text', 'title', $ads['title'] ?? '', [])}}
            <div class="input-label">@lang('strings.body')</div>
            <textarea id="editor2" name="body2">{{$ads['body'] ?? ''}}</textarea>
        </div>
    </div>

    <div class="title">3つめの広告</div>
    <div class="normal-box">
        <div class="vertical-contents">
            <div class="input-label">@lang('strings.title')</div>
            {{Form::input('text', 'title', $ads['title'] ?? '', [])}}
            <div class="input-label">@lang('strings.body')</div>
            <textarea id="editor3" name="body3">{{$ads['body'] ?? ''}}</textarea>
        </div>
    </div>

    {{Form::close()}}
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

@if (Session::get('result') == 1)
<script>
window.onload = function() {
    alert("@lang('strings.alert_messages.saved_settings')");
}
</script>
@endif

@include('shared.ckeditor', ['id' => 'editor1', 'name' => 'body1', 'height' => 150])
@include('shared.ckeditor', ['id' => 'editor2', 'name' => 'body2', 'height' => 150])
@include('shared.ckeditor', ['id' => 'editor3', 'name' => 'body3', 'height' => 150])

@endsection