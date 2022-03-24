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
                            {{Form::open(['name' => 'informations', 'url' => '/managements/informations/confirm', 'method' => 'post', 'files' => true])}}
                            @csrf

                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.mark')
                                        </th>
                                        <td class="bg-light">
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                @foreach ($informationMarks as $informationMark)
                                                <label class="btn btn-light active">
                                                    <input type="radio" name="options" id="option1" autocomplete="off" @if($informationMark->id == 1) checked @endif>
                                                    <i class="fas {{$informationMark->mark}} text-primary-50"></i>
                                                </label>
                                                @endforeach
                                            </div>
                                            <div class="text-danger">{{$errors->first('mark') ?? ''}}</div>
                                        </td>
                                    </tr>
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
                                            <textarea class="form-control" name="body" id="summernote">{{old('body')}}</textarea>
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
                                                old('start_time') ?? (new \Carbon\Carbon())->format($dateFormat->getDateTimeFullFormat()),
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
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap w-25">
                                            @lang('strings.status')
                                        </th>
                                        <td class="bg-light">
                                            <label class="radio-button">
                                                {{Form::radio(
                                                    'status',
                                                    \App\Models\Informations::STATUS_ENABLE,
                                                    old('status') == \App\Models\Informations::STATUS_ENABLE ? true : old('status') == '' ? true : false,
                                                    ['class' => 'radio-button__input']
                                                )}}
                                                <span class="radio-button__icon">@lang('strings.enable')</span>
                                            </label>
                                            <label class="radio-button">
                                                {{Form::radio(
                                                    'status',
                                                    \App\Models\Informations::STATUS_DISABLE,
                                                    old('status') == \App\Models\Informations::STATUS_DISABLE ? true : false,
                                                    ['class' => 'radio-button__input']
                                                )}}
                                                <span class="radio-button__icon">@lang('strings.disable')</span>
                                            </label>
                                            <div class="text-danger">{{$errors->first('status') ?? ''}}</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="javascript:informations.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                                <i class="fas fa-check fa-sm"></i> @lang('strings.do_confirm')
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

    <!-- Summernote -->
    @include('shared.summernote')

    <script>
    window.addEventListener("load", function() {
        $('#start_time').datetimepicker({
            format: 'Y/m/d H:i',
        });
        $.datetimepicker.setLocale('ja');
    });

    window.addEventListener("load", function() {
        $('#end_time').datetimepicker({
            format: 'Y/m/d H:i',
        });
        $.datetimepicker.setLocale('ja');
    });
    </script>

</body>

</html>