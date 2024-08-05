@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><i class="fas fa-fw fa-audio-description"></i> @lang('strings.ads_management')</span>
    </div>

    <div class="tab-wrap">
        <input id="tab1" type="radio" name="tab" class="tab-switch" checked="checked" />
        <label class="tab-label" for="tab1">サイドメニュー</label>
        <div class="tab-content">
            {{Form::open(['name' => 'form', 'url' => '/managements/ads/register', 'method' => 'post', 'files' => true])}}
            @csrf
            <p>サイドメニューに表示する広告を3つまで設定できます。</p>
            @for($i = 1; $i <= 3; $i++)
                @include('managements.ads.formset', ['id' => $i, 'class' => 'side'])
            @endfor
            <div class="flex-contents">
                <a href="javascript:form.submit()">
                    <input type="submit" class="post" value="@lang('strings.save')"></input>
                </a>
            </div>
            {{Form::close()}}
        </div>
        <input id="tab2" type="radio" name="tab" class="tab-switch" />
        <label class="tab-label" for="tab2">リスト</label>
        <div class="tab-content">
            コンテンツ 2
        </div>
        <input id="tab3" type="radio" name="tab" class="tab-switch" />
        <label class="tab-label" for="tab3">フッター</label>
        <div class="tab-content">
            コンテンツ 3
        </div>
    </div>
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

@if (Session::get('result') == 1)
<script>
window.onload = function() {
    alert("@lang('strings.alert_messages.saved_settings')");
}
</script>
@endif

@include('shared.ckeditor', ['id' => 'side1', 'name' => 'side_body[]', 'height' => 180])
@include('shared.ckeditor', ['id' => 'side2', 'name' => 'side_body[]', 'height' => 180])
@include('shared.ckeditor', ['id' => 'side3', 'name' => 'side_body[]', 'height' => 180])

@endsection