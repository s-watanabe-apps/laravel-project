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
                                <li class="breadcrumb-item" aria-current="page"><i class="fas fa-envelope-open-text"></i> {{$backlink['name']}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('strings.message')</a></li>
                                <span style="margin:0 0 0 auto">
                                    <a href="#"><i class="far fa-star"></i></a>
                                </span>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row mx-1">

                        <!-- Tab Control -->
                        @include('messages.tabControl')

                        <div class="col-lg-6 px-0 px-lg-2 mb-4">
                            <table class="table table-bordered responsive-table">
                                <tbody>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap" style="width: 20%;">
                                            @lang('strings.subject')
                                        </th>
                                        <td class="bg-light text-dark" style="width: 80%;">
                                            {{$message->subject}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">
                                            @lang('strings.body')
                                        </th>
                                        <td class="bg-light text-dark">
                                            <pre class="mb-0">{{$message->body}}</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">
                                            @lang('strings.message_from')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$message->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-gradient-light text-secondary text-nowrap">
                                            @lang('strings.received_time')
                                        </th>
                                        <td class="bg-light text-dark">
                                            {{$message->created_at->format($dateFormat->getDateTimeFormat())}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="col-lg-12 text-center">
                                <a href="/profiles/edit" class="btn btn-primary shadow-sm btn-edit-cancel-save">
                                    <i class="fas fa-reply fa-sm text-white-50"></i> @lang('strings.reply')
                                </a>
                            </div>

                        </div>

                        <div class="col-lg-4 mb-4 px-0">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="bg-light text-dark" colspan="2">
                                            <i class="fas fa-fw fa-mail-bulk"></i> {{sprintf(__('strings.message_from_user'), $message->name)}}
                                        </td>
                                    </tr>
                                    @foreach ($fromUserMessages as $fromUserMessage)
                                    <tr>
                                        <td class="bg-light text-dark" style="width: 20%;">
                                            {{$fromUserMessage->created_at->format($dateFormat->getDateFormat())}}
                                        </td>
                                        <td class="bg-light text-dark">
                                            <a href="/messages/{{$fromUserMessage->message_id}}">{{$fromUserMessage->subject}}</a>
                                        </td>
                                    </tr>
                                    @endforeach
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

</body>

</html>