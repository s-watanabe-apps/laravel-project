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
                                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-envelope-open-text"></i> @lang('strings.inbox')</a></li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row mx-1">

                        <!-- Tab Control -->
                        @include('messages.tabControl')

                        <div class="col-lg-10 px-0 px-lg-2">

                            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th class="dt-center">ID</th>
                                        <th class="dt-center">@lang('strings.subject')</th>
                                        <th class="dt-center">@lang('strings.message_from')</th>
                                        <th class="dt-center">@lang('strings.received_time')</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                    <tr class="text-nowrap">
                                        <td class="dt-center">
                                            {{$message->message_id}}
                                        </td>
                                        <td>
                                            <a href="/messages/{{$message->message_id}}">
                                                @if ($message->readed == 0)
                                                <i class="fas fa-envelope fa-fw"></i>
                                                @else
                                                <i class="fas fa-envelope-open-text"></i>
                                                @endif
                                                {{$message->subject}}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/profiles/{{$message->from_user_id}}">
                                                {{$message->name}}
                                            </td>
                                        </td>
                                        <td class="dt-center">
                                            {{$message->created_at->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                        <td class="dt-center">
                                            <a href="#"><i class="fas fa-trash-alt"></i></a>
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
            order:[[3, "desc"]],
            columnDefs:[
                {
                    "targets": [4],
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