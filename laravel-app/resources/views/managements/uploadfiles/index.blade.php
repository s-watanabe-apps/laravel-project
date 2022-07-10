@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

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
                    <th class="dt-center">ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $value)
                <tr>
                    <td class="dt-center">
                        {{$value->getfileName()}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<!-- /.container-fluid -->

<!-- DataTables -->
@include('shared.datatables')

@endsection