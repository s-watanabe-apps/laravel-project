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
                        <?php $tabIndex = 2;?>
                        @include('managements.users.tabControl')

                        <div class="col-lg-10 px-0 px-lg-2">
                        {{Form::open(['name' => 'managementsUsers', 'url' => '/managements/users/post', 'method' => 'post', 'files' => true])}}
                        @csrf

                        {{Form::text(
                            'email',
                            old('name'),
                            ['id' => 'name', 'class' => 'form-control',]
                        )}}

                        {{Form::text(
                            'name',
                            old('name'),
                            ['id' => 'name', 'class' => 'form-control',]
                        )}}

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