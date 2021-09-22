<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Side Bar -->
        @if(isset($user))
        @include('shared.sidebar')
        @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top Bar -->
                @if(isset($user))
                @include('shared.topbar')
                @endif

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- 404 Error Text -->
                    <div class="text-center">
                        <div class="error mx-auto" data-text="500">500</div>
                        <p class="lead text-gray-800 mb-5">Fatal Error</p>
                        <p class="text-gray-500 mb-0">@lang('strings.errors.fatal')</p>
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