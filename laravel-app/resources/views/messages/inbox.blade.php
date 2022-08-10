@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-envelope-open-text"></i> @lang('strings.inbox')</a></li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row mx-1">

        <!-- Tab Control -->
        @include('messages.tabControl')

        <div class="col-lg-10 px-0 px-lg-2">

            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.subject')</th>
                        <th class="dt-center">@lang('strings.message_from')</th>
                        <th class="dt-center">@lang('strings.received_time')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $message)
                    <tr class="text-nowrap">
                        <td class="dt-center">
                            {{$message->message_id}}
                        </td>
                        <td>
                            <a href="/messages/{{$message->message_id}}">
                                @if ($message->readed == 0)
                                <i class="fas fa-envelope fa-fw"></i>
                                @else
                                <i class="fas fa-envelope-open-text"></i>
                                @endif
                                {{$message->subject}}
                            </a>
                        </td>
                        <td>
                            <a href="/profiles/{{$message->from_user_id}}">
                                {{$message->name}}
                            </td>
                        </td>
                        <td class="dt-center">
                            {{$message->created_at->format(\DateFormat::getDateTimeFormat())}}
                        </td>
                        <td class="dt-center">
                            <a href="#"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- DataTables -->
@include('shared.datatables')

@endsection