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

        <!-- Side Bar -->
        @include('shared.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top Bar -->
                @include('shared.topbar')

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
                        @include('managements.users.tabControl')

                        <div class="col-lg-10 px-0 px-lg-2">

                            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="dt-center">ID</th>
                                        <th class="dt-center">@lang('strings.name')</th>
                                        <th class="dt-center">@lang('strings.group')</th>
                                        <th class="dt-center">@lang('strings.created_at')</th>
                                        <th class="dt-center">@lang('strings.last_login')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $value)
                                    <tr class="text-nowrap">
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
            language: {!!$dataTablesLanguage!!},
            stateSave:true,
            order:[[0, "desc"]],
            columnDefs:[
                {
                    //"targets": [1],
                    //"bSortable": false
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