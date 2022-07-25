@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if (isset($formMethod))
    {{Form::open(['name' => 'articles', 'url' => '/articles/register', 'method' => $formMethod, 'files' => true, 'enctype' => 'multipart/form-data'])}}
    @csrf
    @endif
    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                @if(isset($formMethod))
                <li class="breadcrumb-item"><a href="/pictures"><i class="fas fa-fw fa-edit"></i> @lang('strings.write_articles')</a></li>
                <li class="breadcrumb-item active" aria-current="page">@lang('strings.confirm')</li>
                @else
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-edit"></i> {{$articles->title}}</li>
                @endif
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-12">
            <table class="table table-bordered responsive-table">
                <tbody>
                    <tr>
                        <th class="text-secondary text-nowrap bg-th">@lang('strings.title')</th>
                        <td class="view-box">
                            {{$articles->title}}
                            {{Form::hidden('title', $articles->title)}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-secondary text-nowrap bg-th">@lang('strings.article_body')</th>
                        <td class="view-box">
                            {!!$articles->body!!}
                            {{Form::hidden('body', $articles->body)}}
                        </td>
                    </tr>
                    @if (!isset($formMethod))
                    <tr>
                        <th class="text-secondary text-nowrap bg-th">@lang('strings.contributor')</th>
                        <td class="view-box">
                            {{$articles->name ?? ''}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-secondary text-nowrap bg-th">@lang('strings.contribute_date')</th>
                        <td class="view-box">
                            {{$articles->created_at ?? $articles->created_at->format($dateFormat->getDateFormat())}}
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            @if (isset($formMethod))
            <div class="col-auto mb-5 text-center">
                <a href="javascript:articles.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                    <i class="fas fa-check fa-sm text-white-50"></i>@lang('strings.save')
                </a>
                <a href="javascript:window.history.back();" class="btn btn-secondary shadow-sm btn-edit-cancel-save">
                    <i class="fas fa-window-close fa-sm text-white-50"></i>@lang('strings.cancel')
                </a>
            </div>
            @endif

        </div>

    </div>
    @if (isset($formMethod))
    {{Form::close()}}
    @endif
</div>
<!-- /.container-fluid -->
@endsection