@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><i class="fas fa-fw fa-edit"></i>
                    {{sprintf(__('strings.articles_index_title'), $articlesUser->name)}}
                </li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-12">

            <table id="dataTable" class="display cell-border compact responsive nowrap" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.title')</th>
                        <th class="dt-center">@lang('strings.contribute_date')</th>
                        <th class="dt-center">@lang('strings.updated_at')</th>
                        @if ($articlesUser->id == $user->id)
                        <th class="dt-center">@lang('strings.status')</th>
                        <th class="dt-center">@lang('strings.comment_count')</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $value)
                    <tr>
                        <td class="dt-center">
                            {{$value->id}}
                        </td>
                        <td class="dt-center">
                            <a href="/articles/{{$value->id}}">{{$value->title}}</a>
                        </td>
                        <td class="dt-center">
                            {{$value->created_at->format($dateFormat->getDateFormat())}}
                        </td>
                        <td class="dt-center">
                            {{$value->updated_at->format($dateFormat->getDateFormat())}}
                        </td>
                        @if ($articlesUser->id == $user->id)
                        <td class="dt-center">
                            <input type="checkbox"
                                @if ($value->status == \App\Libs\Status::ENABLED)
                                    checked                                                
                                @endif
                                data-onstyle="success" data-offstyle="secondary"
                                data-toggle="toggle"
                                data-size="sm"
                                data-on="@lang('strings.enable')"
                                data-off="@lang('strings.disable')" />
                        </td>
                        <td class="dt-center">
                            10
                        </td>
                        @endif
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