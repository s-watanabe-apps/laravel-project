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
                        @include('managements.informations.tabControl', ['index' => 2])

                        <div class="col-lg-10 px-0 px-lg-2">
                            {{Form::open(['name' => 'informations', 'url' => '/managements/informations/post', 'method' => 'post', 'files' => true])}}
                            @csrf

                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.title')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$request->title}}
                                            {{Form::hidden('title', $request->title)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.body')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {!!$request->body!!}
                                            {{Form::hidden('body', $request->body)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.start_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$request->start_time}}
                                            {{Form::hidden('start_time', $request->start_time)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.end_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$request->end_time}}
                                            {{Form::hidden('end_time', $request->end_time)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.status')
                                        </th>
                                        <td class="bg-light">
                                            {{\App\Models\Informations::getStatuses()[$request->status]}}
                                            {{Form::hidden('status', $request->status)}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="javascript:informations.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                                <i class="fas fa-check fa-sm"></i> @lang('strings.save')
                            </a>
                            {{Form::close()}}
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