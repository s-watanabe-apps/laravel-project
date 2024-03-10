@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-upload"></i> @lang('strings.upload_files')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row mx-1">

    <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
        <thead>
            <tr class="text-nowrap">
                <th class="dt-center">@lang('strings.file_name')</th>
                <th class="dt-center">@lang('strings.link')</th>
                <th class="dt-center">@lang('strings.created_at')</th>
                <th class="dt-center">@lang('strings.updated_at')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $value)
            <tr>
            <td class="dt-left">
                    <a href="/files/{{$value->getfileName()}}">{{$value->getfileName()}}</a>
                </td>
                <td class="dt-left">
                        <div><a href="javascript:copyLink('/files/{{$value->getfileName()}}')"><i class="fas fa-copy"></i></a>&nbsp;/files/{{$value->getfileName()}}</div>
                </td>
                <td class="dt-center">
                    {{$value->created_at->format(\DateFormat::getDateFormat())}}
                </td>
                <td class="dt-center">
                    {{$value->updated_at->format(\DateFormat::getDateFormat())}}
                </td>
                <td class="dt-center">
                    <a href="#"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<!-- DataTables -->
@include('shared.datatables')

<script>
$(function(){
});
function copyLink(link) {
    console.log(link);
}
</script>
@endsection