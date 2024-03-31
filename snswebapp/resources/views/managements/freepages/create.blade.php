@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <a href="/managements/freepages/"><i class="fas fa-fw fa-edit"></i> @lang('strings.freepage_management')</a>
        &gt; @lang('strings.add')</div>

    {{Form::open([
        'name' => 'freepages',
        'url' => '/managements/freepages/confirm',
        'method' => 'post',
    ])}}
    @csrf

    <!-- Edit Control -->
    @include('managements.freepages.formset.editForm', [
        'values' => [
            'code' => $code,
        ],
    ])

    <div class="flex-contents">
        <input type="submit" class="post" value="@lang('strings.confirm')"></input>
    </div>
    {{Form::close()}}

</div>

@endsection