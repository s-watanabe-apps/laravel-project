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
                                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i>@lang('strings.user_management')</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row mx-1">

                        <!-- Tab Control -->
                        <?php $tabIndex = 2;?>
                        @include('managements.users.tabControl', ['index' => 2])

                        <div class="col-lg-10 px-0 px-lg-2">
                            {{Form::open(['name' => 'managementsUsers', 'url' => '/managements/users/post', 'method' => 'post', 'files' => true])}}
                            @csrf

                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.email')
                                        </th>
                                        <td class="bg-light">
                                            {{$request->email}}
                                            {{Form::hidden('email', $request->email)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.name')
                                        </th>
                                        <td class="bg-light">
                                            {{$request->name}}
                                            {{Form::hidden('name', $request->name)}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="javascript:managementsUsers.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                                <i class="fas fa-check fa-sm"></i> TEST
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