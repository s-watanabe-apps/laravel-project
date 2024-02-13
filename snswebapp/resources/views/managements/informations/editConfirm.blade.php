@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; {{$values['title']}}</span>
        <span>&gt; @lang('strings.confirm')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/informations/save',
        'method' => 'put',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    {{Form::hidden('id', $values['id'])}}

    @include('managements.informations.formset.viewer', compact('values'))

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.save')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}
</div>

@endsection