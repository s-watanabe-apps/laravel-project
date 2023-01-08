@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i>@lang('strings.user_management')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row mx-1">

        <!-- Tab Control -->
        @include('managements.users.tabControl', ['index' => 1])

        <div class="col-lg-10 px-0 px-lg-2">

            <table id="dataTable" class="display cell-border compact responsive nowrap" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.name')</th>
                        <th class="dt-center">@lang('strings.group')</th>
                        <th class="dt-center">@lang('strings.created_at')</th>
                        <th class="dt-center">@lang('strings.last_login')</th>
                        <th class="dt-center">@lang('strings.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $value)
                    <tr>
                        <td class="dt-center">
                            {{$value->id}}
                        </td>
                        <td class="dt-center">
                            {{$value->name}}
                        </td>
                        <td class="dt-center">
                            {{$value->group_name ?? __('strings.none')}}
                        </td>
                        <td class="dt-center">
                            {{$value->created_at->format(\DateFormat::getDateTimeFullFormat())}}
                        </td>
                        <td class="dt-center">
                            {{!$value->last_activity ? '' : carbon($value->last_activity)->format(\DateFormat::getDateTimeFullFormat())}}
                        </td>
                        <td class="dt-center">
                            @if ($value->status == \Status::ENABLED)
                            <span class="enable">@lang('strings.enable')</span>
                            @else
                            <span class="disable">@lang('strings.disable')</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- DataTables -->
@include('shared.datatables')

@endsection