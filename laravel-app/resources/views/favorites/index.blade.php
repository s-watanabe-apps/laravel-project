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
                                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-star"></i>@lang('strings.favorites')</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12 text-center">

                            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                                <thead>
                                    <tr class="text-nowrap">
                                        <th>@lang('strings.favorites')</th>
                                        <th>@lang('strings.category')</th>
                                        <th>@lang('strings.contributor')</th>
                                        <th>@lang('strings.datetime')</th>
                                        <th><br></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($index = 0; $index < count($favorites); $index++)
                                    <?php $favorite = $favorites->get($index) ?>
                                    <tr id="row-{{$index}}" class="text-nowrap">
                                        <td>
                                            <a href="{{$favorite->uri}}">
                                                @if ($favorite->favorite_code == \App\Models\Favorites::FAVORITE_CODE_PROFILES)
                                                {{sprintf(__('strings.someones_profile'), $favorite->name)}}
                                                @else
                                                {{$favorite->value}}
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            {{\App\Models\Favorites::getFavoriteName($favorite->favorite_code)}}
                                        </td>
                                        <td>
                                            {{$favorite->name}}
                                        </td>
                                        <td>
                                            {{$favorite->created_at->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                        <td>
                                            <a href="/favorites/remove/{{urlencode($favorite->uri)}}" class="py-0 btn btn-secondary shadow-sm">
                                                <i class="fas fa-window-close fa-sm text-white-50"></i> @lang('strings.delete')
                                            </a>
                                        </td>
                                    </tr>
                                    @endfor
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
/*
        var clickEventType = ((window.ontouchstart !== null) ? 'click' : 'touchend');
        $(document).on(clickEventType, '#removeFavorites\\[\\]', function(){
            $('#row-' + $(this).attr('index')).remove();
            $.ajax({
                type: "POST",
                url: "/api/favorites",
                data: {
                    "isFavorite":"1",
                    "uri":$(this).attr('data'),
                },
            }).done(function(data) {
                //
            }).fail(function(){
                console.log('fail');
            });
        });
*/
    });
    </script>
</body>

</html>