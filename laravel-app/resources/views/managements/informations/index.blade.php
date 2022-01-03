<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<link href="http://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="http://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Nav Bar -->
                @include('shared.navbar')

                <!-- Top Bar -->
                @include('shared.topbar')

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
                                        <th class="dt-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($informations as $value)
                                    <tr>
                                        <td class="dt-center">
                                            {{$value->id}}
                                        </td>
                                        <td class="dt-center">
                                            <a href="/managements/informations/{{$value->id}}">{{$value->title}}</a>
                                        </td>
                                        <td class="dt-center">
                                            {{$value->start_time == null ? '' : (new Carbon\Carbon($value->start_time))->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                        <td class="dt-center">
                                            {{$value->end_time == null ? '' : (new Carbon\Carbon($value->end_time))->format($dateFormat->getDateTimeFormat())}}
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

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('shared.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Script Files -->
    @include('shared.scripts')

    <script>
    jQuery(document).ready(function($) {
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
</body>

</html>