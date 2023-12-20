@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="row">
    <nav aria-label="breadcrumb" class="col-md-12 h6 font-weight-bold">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-user"></i> @lang('strings.profile')</a></li>
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
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th class="w-25">
                        @lang('strings.email')
                    </th>
                    <td>
                        {{$profileUser->email}}
                    </td>
                </tr>
                <tr>
                    <th>
                        @lang('strings.name')
                    </th>
                    <td>
                        {{$profileUser->name}}
                    </td>
                </tr>
                @if(__('strings.name_kana') != 'strings.name_kana')
                <tr>
                    <th>
                        @lang('strings.name_kana')
                    </th>
                    <td>
                        {{$profileUser->name_kana}}
                    </td>
                </tr>
                @endif
                <tr>
                    <th>
                        @lang('strings.birth_date')
                    </th>
                    <td>
                        {{carbon($profileUser->birthdate)->format(\DateFormat::getDateFormat())}}
                    </td>
                </tr>

                @foreach($userProfiles as $userProfile)
                <tr>
                    <th>
                        {{$userProfile->name}}
                    </th>
                    <td>
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
                    <th colspan="2">
                        <h2 class="h5 mb-0 text-gray-800">
                            <i class="fas fa-blog"></i>
                            <small>@lang('strings.latest_articles')
                        </h2>
                    </th>
                </tr>
                @foreach($articles as $value)
                <tr>
                    <td class="w-25 text-secondary text-center text-nowrap">
                        <small>{{$value->created_at->format(\DateFormat::getDateFormat())}}</small>
                    </td>
                    <td class="w-75">
                        <a href="/articles/{{$value->id}}">{{$value->title}}</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td class="text-center text-nowrap" colspan="2">
                        <a href="/articles/user/{{$profileUser->id}}">@lang('strings.readmore')</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="col-lg-8 mb-5 text-center">
        @if (user()->id == $profileUser->id)
        <a href="/profiles/edit" class="btn btn-primary shadow-sm btn-edit-cancel-save">
            <i class="fas fa-user-edit fa-sm text-white-50"></i>&nbsp;@lang('strings.edit')
        </a>
        @else
        <a href="/profiles/edit" class="btn btn-primary shadow-sm btn-edit-cancel-save" style="width: 12rem !important;">
            <i class="fas fa-paper-plane fa-sm text-white-50"></i>&nbsp;@lang('strings.send_message')
        </a>
        @endif
    </div>
</div>

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