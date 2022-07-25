@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i>@lang('strings.freepage_management')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row mx-1">

        <!-- Tab Control -->
        @include('managements.freepages.tabControl', ['index' => 1])

        <div class="col-lg-10 px-0 px-lg-2">

            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.title')</th>
                        <th class="dt-center">@lang('strings.created_at')</th>
                        <th class="dt-center">@lang('strings.updated_at')</th>
                        <th class="dt-center">@lang('strings.operation')</th>
                        <th class="dt-center">@lang('strings.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($freePages as $value)
                    <tr>
                        <td class="dt-center">
                            {{$value->id}}
                        </td>
                        <td class="dt-left">
                            <a href="/managements/freepages/{{$value->id}}">
                                {{$value->title}}
                            </a>
                        </td>
                        <td class="dt-center">
                            <small>{{$value->created_at}}</small>
                        </td>
                        <td class="dt-center">
                            <small>{{$value->updated_at}}</small>
                        </td>
                        <td class="dt-center">
                            <i class="fas fa-solid fa-link"></i>
                        </td>
                        <td class="dt-center">
                            <input type="checkbox"
                                @if ($value->status == \App\Libs\Status::ENABLE)
                                    checked                                                
                                @endif
                                data-onstyle="success" data-offstyle="secondary"
                                data-toggle="toggle"
                                data-size="sm"
                                data-on="@lang('strings.enable')"
                                data-off="@lang('strings.disable')" />
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