@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/informations"><i class="fas fa-fw fa-info-circle"></i> @lang('strings.informations_management')</a><span>
        <span>&gt; <a href="/managements/informations/{{$values['id']}}">{{$values['title']}}</a></span>
        <span>&gt; @lang('strings.edit')</span>
    </div>

    {{Form::open([
        'name' => 'form',
        'url' => '/managements/informations/confirm',
        'method' => 'put',
        'files' => false,
        'enctype' => 'multipart/form-data'
    ])}}

    @include('managements.informations.formset.editForm', [])

    {{Form::hidden('id', $values['id'])}}

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
    </div>

    {{Form::close()}}
</div>

@endsection