@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; @lang('strings.add')</span>
        <span>&gt; @lang('strings.confirm')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/informations/save',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    @include('managements.informations.formset.viewForm', compact('values'))

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.save')"></input>
        <a href="javascript:window.history.back();">
            <input type="button" class="cancel" value="@lang('strings.cancel')"></input>
        </a>
    </div>

    {{Form::close()}}
</div>

@endsection