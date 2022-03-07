<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>

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

                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.title')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{Form::text(
                                                'title',
                                                old('title'),
                                                ['id' => 'title', 'class' => 'form-control',]
                                            )}}
                                            <div class="text-danger">{{$errors->first('title') ?? ''}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.body')
                                        </th>
                                        <td class="bg-light text-dark">
                                            <textarea class="form-control" name="body" id="summernote"></textarea>
                                            <div class="text-danger">{{$errors->first('body') ?? ''}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.start_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{Form::text(
                                                'start_time',
                                                old('start_time') ?? (new \Carbon\Carbon())->format($dateFormat->getDateTimeFormat()),
                                                ['id' => 'start_time', 'class' => 'form-control',]
                                            )}}
                                            <div class="text-danger">{{$errors->first('start_time') ?? ''}}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.end_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{Form::text(
                                                'end_time',
                                                old('end_time') ?? '',
                                                ['id' => 'end_time', 'class' => 'form-control',]
                                            )}}
                                            <div class="text-danger">{{$errors->first('end_time') ?? ''}}</div>
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
        $('#summernote').summernote({
            lang: "ja-JP",
            placeholder: '',
            tabsize: 1,
            height: 400,
        });
    });

    window.addEventListener("load", function() {
        $('#start_time').datetimepicker({
            format: 'Y/m/d H:i:s',
        });
        $.datetimepicker.setLocale('ja');
    });

    window.addEventListener("load", function() {
        $('#end_time').datetimepicker({
            format: 'Y/m/d H:i:s',
        });
        $.datetimepicker.setLocale('ja');
    });
    </script>

</body>

</html>