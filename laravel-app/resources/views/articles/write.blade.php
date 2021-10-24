<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>
<!--
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/lang/summernote-ja-JP.js"></script>
-->
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
                    {{Form::open(['name' => 'article', 'url' => '/articles/confirm', 'method' => 'post', 'files' => true, 'enctype' => 'multipart/form-data'])}}
                    @csrf
                    <!-- Page Heading -->
                    <div class="row">
                        <nav aria-label="breadcrumb" class="col-md-12 h5">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i>@lang('strings.write_articles')</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">@lang('strings.title')</th>
                                        <td>
                                            <input type="text" name="title" class="form-control" id="title" placeholder="">
                                            <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">@lang('strings.article_body')</th>
                                        <td>
                                            <textarea class="form-control" name="body" id="summernote"></textarea>
                                            <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="col-auto mb-5 text-center">
                                <a href="javascript:article.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                                    <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.confirm')
                                </a>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-4 d-none d-sm-inline-block">
                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="/img/undraw_add_document_re_mbjx.svg" alt="..."
                                            onselectstart="return false;" onmousedown="return false;">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>        
                    {{Form::close()}}

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
        $('#summernote').summernote({
            lang: "ja-JP",
            placeholder: '',
            tabsize: 1,
            height: 400,
        });
    });
    </script>
</body>

</html>