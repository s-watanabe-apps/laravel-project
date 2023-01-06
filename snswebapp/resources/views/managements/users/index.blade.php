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
                            {{$value->created_at->format(\DateFormat::getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            {{!$value->last_activity ? '' : carbon($value->last_activity)->format(\DateFormat::getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            <input type="checkbox"
                                @if ($value->status == \Status::ENABLED)
                                    checked                                                
                                @endif
                                data-onstyle="success" data-offstyle="secondary"
                                data-toggle="toggle"
                                data-size="sm"
                                data-on="@lang('strings.enable')"
                                data-off="@lang('strings.disable')" />
                        </td>
                        <td class="dt-center text-nowrap">
                            @if ($value->enable == 0)
                            <a href="/managements/users/deleted/{{$value->id}}" class="py-0 btn btn-danger shadow-sm mb-2">
                                <i class="fas fa-window-close fa-sm text-white-50"></i> @lang('strings.delete')
                            </a><br>
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