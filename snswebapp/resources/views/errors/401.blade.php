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

                    <!-- 401 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="401">401</div>
                        <p class="lead text-gray-800 mb-5">Unauthorized</p>
                        <p class="text-gray mb-2">@lang('strings.errors.unauthorized')</p>
                        <p class="text-gray mb-5">@lang('strings.errors.to_admin_message')</p>
                        <a href="index.html">&larr; Back to Dashboard</a>
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
