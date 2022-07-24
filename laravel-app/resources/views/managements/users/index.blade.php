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
                        <th class="dt-center"></th>
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
                            {{$value->created_at->format($dateFormat->getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            {{!$value->last_activity ? '' : \Carbon\Carbon::createFromTimestamp($value->last_activity)->format($dateFormat->getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            @if ($value->enable == 1)
                                @lang('strings.enable')
                            @else
                                @lang('strings.disable')
                            @endif
                        </td>
                        <td class="dt-center text-nowrap">
                            @if ($value->enable == 0)
                            <a href="/managements/users/deleted/{{$value->id}}" class="py-0 btn btn-danger shadow-sm mb-2">
                                <i class="fas fa-window-close fa-sm text-white-50"></i> @lang('strings.delete')
                            </a><br>
                            <a href="/managements/users/enabled/{{$value->id}}" class="py-0 btn btn-success shadow-sm">
                                <i class="fas fa-bullseye fa-sm text-white-50"></i> @lang('strings.enable')
                            </a>
                            @else
                            <a href="/managements/users/disabled/{{$value->id}}" class="py-0 btn btn-secondary shadow-sm">
                                <i class="fas fa-window-close fa-sm text-white-50"></i> @lang('strings.disable')
                            </a>
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