@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; @lang('strings.add')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/informations/confirm',
        'method' => 'post',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    <div class="vertical-contents">
        @include('managements.informations.formset.editForm', [])

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        </div>
    </div>

    {{Form::close()}}
</div>

@endsection