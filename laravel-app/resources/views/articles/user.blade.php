@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-edit"></i>@lang('strings.write_articles')</a></li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-12">

            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th class="dt-center">ID</th>
                        <th class="dt-center">@lang('strings.title')</th>
                        <th class="dt-center">@lang('strings.contribute_date')</th>
                        <th class="dt-center">@lang('strings.updated_at')</th>
                        <th class="dt-center">@lang('strings.status')</th>
                        <th class="dt-center">@lang('strings.status')</th>
                        <th class="dt-center"></th>
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
                            {{$value->created_at}}
                        </td>
                        <td class="dt-center">
                            {{$value->updated_at}}
                        </td>
                        <td class="dt-center">

                        </td>
                        <td class="dt-center">
    
                        </td>
                        <td class="dt-center text-nowrap">
        
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