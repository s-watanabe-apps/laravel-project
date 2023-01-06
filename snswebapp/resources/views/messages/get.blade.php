@extends('layouts.app')
@section('content')
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
                        <th class="w-25">
                            @lang('strings.subject')
                        </th>
                        <td>
                            {{$message->subject}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            @lang('strings.body')
                        </th>
                        <td>
                            <pre class="mb-0">{{$message->body}}</pre>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            @lang('strings.message_from')
                        </th>
                        <td>
                            {{$message->name}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            @lang('strings.received_time')
                        </th>
                        <td>
                            {{$message->created_at->format(\DateFormat::getDateTimeFormat())}}
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
                        <td colspan="2">
                            <i class="fas fa-fw fa-mail-bulk"></i> {{sprintf(__('strings.message_from_user'), $message->name)}}
                        </td>
                    </tr>
                    @foreach ($fromUserMessages as $fromUserMessage)
                    <tr>
                        <td style="width: 20%;">
                            {{$fromUserMessage->created_at->format(\DateFormat::getDateFormat())}}
                        </td>
                        <td>
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
@endsection
