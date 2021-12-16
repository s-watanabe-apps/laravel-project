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
                    {{Form::open(['name' => 'articles', 'url' => '/articles/post', 'method' => 'post', 'files' => true, 'enctype' => 'multipart/form-data'])}}
                    @csrf
                    <!-- Page Heading -->
                    <div class="row">
                        <nav aria-label="breadcrumb" class="col-md-12 h5">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-edit"></i>@lang('strings.write_articles')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('strings.confirm')</li>
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
                                            {{$validated['title']}}
                                            {{Form::hidden('title', $validated['title'])}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">@lang('strings.article_body')</th>
                                        <td>
                                            {!!$validated['body']!!}
                                            {{Form::hidden('body', $validated['body'])}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="col-auto mb-5 text-center">
                                <a href="javascript:articles.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                                    <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.save')
                                </a>
                                <a href="javascript:window.history.back();" class="btn btn-secondary shadow-sm btn-edit-cancel-save">
                                    <i class="fas fa-window-close fa-sm text-white-50"></i>@lang('strings.cancel')
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

</body>

</html>