@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-user"></i>@lang('strings.profile')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$profileUser->name}}</li>
                <span style="margin:0 0 0 auto">
                    <a id="switchFavorites" href="#">
                        @if ($isFavorite)
                        <i class="fas fa-star"></i>
                        @else
                        <i class="far fa-star"></i>
                        @endif
                    </a>
                    {{Form::hidden('isFavorite', $isFavorite, ['id' => 'isFavorite'])}}
                </span>
            </ol>
        </nav>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-2 mb-4 text-center">
            <img class="img-fluid rounded" src="/show/image?file={{$profileUser->image_file}}" />
        </div>

        <div class="col-lg-6 mb-4">
            <table class="table table-bordered responsive-table">
                <tbody>
                    <tr>
                        <th class="bg-th text-secondary text-nowrap w-25">
                            @lang('strings.email')
                        </th>
                        <td class="bg-light text-dark">
                            {{$profileUser->email}}
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.name')
                        </th>
                        <td class="bg-light text-dark">
                            {{$profileUser->name}}
                        </td>
                    </tr>
                    @if(__('strings.name_kana') != 'strings.name_kana')
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.name_kana')
                        </th>
                        <td class="bg-light text-dark">
                            {{$profileUser->name_kana}}
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            @lang('strings.birth_date')
                        </th>
                        <td class="bg-light text-dark">
                            {{(new \Carbon\Carbon($profileUser->birthdate))->format($dateFormat->getDateFormat())}}
                        </td>
                    </tr>

                    @foreach($userProfiles as $userProfile)
                    <tr>
                        <th class="bg-th text-secondary text-nowrap">
                            {{$userProfile->name}}
                        </th>
                        <td class="bg-light text-dark">
                            {{$userProfile->value}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-lg-4 mb-4">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="2" class="bg-th">
                            <h2 class="h5 mb-0 text-gray-800">
                                <i class="fas fa-blog"></i>
                                <small>@lang('strings.latest_articles')
                            </h4>
                        </th>
                    </tr>
                    @foreach($articles as $value)
                    <tr>
                        <td class="w-25 text-secondary text-center text-nowrap">
                            <small>{{$value->created_at->format($dateFormat->getDateFormat())}}</small>
                        </td>
                        <td class="w-75">
                            <a href="/articles/{{$value->id}}">{{$value->title}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-lg-8 mb-5 text-center">
            @if ($user->id == $profileUser->id)
            <a href="/profiles/edit" class="btn btn-primary shadow-sm btn-edit-cancel-save">
                <i class="fas fa-user-edit fa-sm text-white-50"></i> @lang('strings.edit')
            </a>
            @else
            <a href="/profiles/edit" class="btn btn-primary shadow-sm btn-edit-cancel-save" style="width: 12rem !important;">
                <i class="fas fa-paper-plane fa-sm text-white-50"></i> @lang('strings.send_message')
            </a>
            @endif
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Toast -->
@include('shared.toast')
@if (Session::get('result') == 1)
<script>
    $(window).on('load', function() {
        $('#toastMessage').text('@lang('strings.operation_messages.profile_update')');
        $('#toast').toast('show');
    });
</script>
@endif

@endsection