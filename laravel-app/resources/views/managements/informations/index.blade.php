@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i>@lang('strings.informations_management')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row mx-1">

        <!-- Tab Control -->
        @include('managements.informations.tabControl', ['index' => 1])

        <div class="col-lg-10 px-0 px-lg-2">

            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.title')</th>
                        <th class="dt-center">@lang('strings.start_time')</th>
                        <th class="dt-center">@lang('strings.end_time')</th>
                        <th class="dt-center">@lang('strings.status')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($informations as $value)
                    <tr>
                        <td class="dt-center">
                            {{$value->id}}
                        </td>
                        <td class="dt-left">
                            <a href="/managements/informations/{{$value->id}}">
                                <i class="fas {{$value->mark}} text-primary-50"></i>
                                {{$value->title}}
                            </a>
                        </td>
                        <td class="dt-center">
                            {{$value->start_time == null ? '' : (new Carbon\Carbon($value->start_time))->format($dateFormat->getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            {{$value->end_time == null ? '' : (new Carbon\Carbon($value->end_time))->format($dateFormat->getDateTimeFormat())}}
                        </td>
                        <td class="dt-center text-nowrap">
                            <input type="checkbox"
                                @if ($value->status == \App\Models\Informations::STATUS_ENABLE)
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

<link href="http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="http://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>

<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script>
$(window).on('load', function() {
    var table = $('#dataTable').DataTable({
        aLengthMenu:[50, 100, 200],
        language: {!!json_encode(__('strings.datatables'), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)!!},
        stateSave:true,
        order:[[0, "desc"]],
        columnDefs:[
            {
                "targets": [5],
                "bSortable": false
            },
        ],
        scrollX: true,
    });

    table.columns.adjust();

    $(window).on('resize', function(){
        table.columns.adjust();
    });
});
</script>
@endsection