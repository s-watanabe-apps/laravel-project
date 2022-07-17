@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-star"></i>@lang('strings.favorites')</li>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 text-center">

            <table id="dataTable" class="display cell-border compact" style="margin: unset; width: 100%;">
                <thead>
                    <tr class="text-nowrap">
                        <th>@lang('strings.favorites')</th>
                        <th>@lang('strings.category')</th>
                        <th>@lang('strings.contributor')</th>
                        <th>@lang('strings.datetime')</th>
                        <th><br></th>
                    </tr>
                </thead>
                <tbody>
                    @for ($index = 0; $index < count($favorites); $index++)
                    <?php $favorite = $favorites->get($index) ?>
                    <tr id="row-{{$index}}" class="text-nowrap">
                        <td>
                            <a href="{{$favorite->uri}}">
                                @if ($favorite->favorite_code == \App\Models\Favorites::FAVORITE_CODE_PROFILES)
                                {{sprintf(__('strings.someones_profile'), $favorite->name)}}
                                @else
                                {{$favorite->value}}
                                @endif
                            </a>
                        </td>
                        <td>
                            {{$favorite->favorite_name}}
                        </td>
                        <td>
                            {{$favorite->name}}
                        </td>
                        <td>
                            {{$favorite->created_at->format($dateFormat->getDateTimeFormat())}}
                        </td>
                        <td>
                            <a href="/favorites/remove/{{urlencode($favorite->uri)}}" class="py-0 btn btn-secondary shadow-sm">
                                <i class="fas fa-window-close fa-sm text-white-50"></i> @lang('strings.delete')
                            </a>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- DataTables -->
@include('shared.datatables')

@endsection