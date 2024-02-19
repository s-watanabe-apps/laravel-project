@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; <a href="/managements/informations/{{$values['id']}}">{{$values['title']}}</a></span>
        <span>&gt; @lang('strings.delete_confirm')</span>
    </div>

    @include('managements.informations.formset.viewer', compact('values'))

    <div class="alert-box">
        @lang('strings.alert_messages.delete_confirm')
    </div>

    <div class="flex-contents">
        <a href="/managements/informations/delete/{{$values['id']}}">
            <input type="button" class="delete" value="@lang('strings.delete')"></input>
        </a>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>
</div>

@endsection