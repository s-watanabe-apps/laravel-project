@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-upload"></i>@lang('strings.upload_files')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">

    <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
        <thead>
            <tr class="text-nowrap">
                <th class="dt-center">@lang('strings.file_name')</th>
                <th class="dt-center">@lang('strings.created_at')</th>
                <th class="dt-center">@lang('strings.updated_at')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $value)
            <tr>
                <td class="dt-left">
                    <a href="/files/{{$value->getfileName()}}">{{$value->getfileName()}}</a>
                </td>
                <td class="dt-center">
                    {{$value->createdAt->format(\DateFormat::getDateTimeFormat())}}
                </td>
                <td class="dt-center">
                    {{$value->updatedAt->format(\DateFormat::getDateTimeFormat())}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- DataTables -->
@include('shared.datatables')

@endsection