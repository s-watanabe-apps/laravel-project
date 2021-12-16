<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js" defer></script>
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
                                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-images"></i>@lang('strings.members')</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="container p-0">
                        <!-- Content Row -->
                        <div class="row">
                            @foreach ($profileUsers as $profileUser)
                            <div class="col-md-2 col-4 p-2">
                                <div class="thumbnail">
                                    <a href="/profiles/{{$profileUser->id}}" class="text-decoration-none">
                                        <img
                                            src="/img/loading.gif"
                                            data-src="/show/image/?file={{$profileUser->file}}"
                                            alt="{{$profileUser->name}}"
                                            style="width:100%; height: 10rem; object-fit: cover;"
                                            class="lazyload rounded"
                                            loading="lazy">
                                        <div class="caption my-2 text-center">
                                            <div class="text-muted">{{$profileUser->name}}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-md-12">
                                {{$profileUsers->links()}}
                            </div>
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
        console.log("lazyload");
        $(".lazyload").lazyload();
    });
    </script>
</body>

</html>