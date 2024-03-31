@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; {{$values['title']}}</span>
    </div>

    @include('managements.informations.formset.viewForm', compact('values'))

    <div class="flex-contents">
        <a href="/managements/informations/edit/{{$values['id']}}">
            <input type="button" class="post" value="@lang('strings.edit')"></input>
        </a>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.return')"></input>
        </a>
        <a href="/managements/informations/delete/{{$values['id']}}">
            <input type="button" class="delete" value="@lang('strings.delete')"></input>
        </a>
    </div>
</div>

@endsection