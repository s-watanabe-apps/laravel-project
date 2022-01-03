<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

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

                        <div class="col-lg-8 px-0 px-lg-2">

                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.title')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$information->title}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.body')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {!!$information->body!!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.start_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$information->start_time == null ? '' : (new Carbon\Carbon($information->end_time))->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.end_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$information->end_time == null ? '' : (new Carbon\Carbon($information->end_time))->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.status')
                                        </th>
                                        <td class="bg-light text-dark">
                                            @if($information->status == 1)
                                                <p class="py-0 my-0 btn btn-success shadow-sm">@lang('strings.enable')</p>
                                            @else
                                                <p class="py-0 my-0 btn btn-secondary shadow-sm">@lang('strings.disable')</p>
                                            @endif
                                        </td>
                                    </tr>
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

</body>

</html>