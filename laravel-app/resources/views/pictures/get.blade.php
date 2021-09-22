<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js" defer></script>

<style type="text/css">
<!--
.pagination {
  justify-content: center;
}
-->
</style>
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
                                <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-images"></i>@lang('strings.pictures')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$image->title}}</li>
                                <span style="margin:0 0 0 auto">
                                    <a id="switchFavorites" href="#">
                                        @if ($isFavorite)
                                        <i class="fas fa-star"></i>
                                        @else
                                        <i class="far fa-star"></i>
                                        @endif
                                    </a>
                                    {{Form::hidden('isFavorite', $isFavorite, ['id' => 'isFavorite'])}}
                                </span>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <a href="/show/image/?file={{$image->file}}">
                                <img
                                    src="/img/loading.gif"
                                    data-src="/show/image/?file={{$image->file}}"
                                    alt="{{$image->title}}"
                                    style="width:100%; height: auto; object-fit: cover; cursor:pointer;"
                                    class="lazyload rounded"
                                    loading="lazy" />
                            </a>
                        </div>

                        <div class="col-md-6 p-2">
                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25 py-2">
                                            @lang('strings.title')
                                        </th>
                                        <td class="bg-light text-dark py-2">
                                            {{$image->title}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25 py-2">
                                            @lang('strings.contributor')
                                        </th>
                                        <td class="bg-light text-dark py-2">
                                            <a href="/profiles/{{$image->user_id}}">{{$image->name}}</a>
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

    <script>
    jQuery(document).ready(function($) {
        console.log("lazyload");
        $(".lazyload").lazyload();
    });
    </script>

</body>

</html>