@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <span><a href="/managements/freepages/"><i class="fas fa-fw fa-edit"></i> @lang('strings.freepage_management')</a>
        <span>&gt; @lang('strings.add')</span>
    </div>

    {{Form::open([
        'name' => 'freepages',
        'url' => '/managements/freepages/confirm',
        'method' => 'post',
    ])}}
    @csrf

    <div class="vertical-contents">
        <!-- Edit Control -->
        @include('managements.freepages.formset.editForm', [
            'values' => [
                'code' => $code,
            ],
        ])

        <div class="flex-contents">
            <input type="submit" class="post" value="@lang('strings.confirm')"></input>
        </div>
    </div>

    {{Form::close()}}

</div>

@include('shared.ckeditor', ['name' => 'body'])

@endsection