@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-images"></i> @lang('strings.pictures')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('strings.upload')</li>
        </ol>
    </nav>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-6 px-3 pb-4">
        <img id="preview_confirm" class="img-preview" />
    </div>

    <div class="col-md-6">
        <table class="table table-bordered responsive-table">
            <tbody>
                <tr>
                    <th>
                        @lang('strings.title')
                    </th>
                    <td>
                        hogehoge
                    </td>
                </tr>
                <tr>
                    <th>
                        @lang('strings.contributor')
                    </th>
                    <td>
                        hogehoge
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

@endsection