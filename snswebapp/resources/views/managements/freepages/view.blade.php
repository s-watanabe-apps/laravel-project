@extends('app')
@section('content')

<div class="contents">
    <div class="subject">
        <a href="/managements/freepages/"><i class="fas fa-fw fa-edit"></i> @lang('strings.freepage_management')</a>
        &gt; {{$freePages['title']}}</div>


</div>

@endsection