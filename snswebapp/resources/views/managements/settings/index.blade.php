@extends('layouts.app')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    {{Form::open(['name' => 'settings', 'url' => '/managements/settings/register', 'method' => 'post', 'files' => true])}}
    @csrf

    <!-- Page Heading -->
    <div class="row">
        <nav aria-label="breadcrumb" class="col-md-12 h5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-fw fa-tools"></i>@lang('strings.site_settings')</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="h6 font-weight-bold">@lang('strings.basic_settings')</div>
            <div class="card bg-light text-black shadow mb-3">
                <div class="row card-body">
                    <div class="col-md-4 col-12">
                        <span class="h6 text-nowrap">@lang('strings.site_name')</span>
                    </div>
                    <div class="col-md-8 col-12 pb-2">
                        {{Form::input('text', 'site_name', old('site_name') ?? $settings->site_name, [
                            'style' => 'width: 100%;'
                        ])}}
                        <div class="text-danger">{{$errors->first('site_name') ?? ''}}</div>
                    </div>
                    <div class="col-md-4 col-12">
                        <span class="h6 text-nowrap">@lang('strings.site_description')</span>
                    </div>
                    <div class="col-md-8 col-12">
                        {{Form::input('text', 'site_description', old('site_description') ?? $settings->site_description, [
                            'style' => 'width: 100%;'
                        ])}}
                        <div class="text-danger">{{$errors->first('site_description') ?? ''}}</div>
                    </div>
                </div>
            </div>

            <div class="h6 font-weight-bold">@lang('strings.anonymous_user')</div>
            <div class="card bg-light text-black shadow mb-3">
                <div class="card-body">
                    <div class="custom-control custom-radio">
                        <input type="radio" id="anonymous_permission0" value="0" name="anonymous_permission" class="custom-control-input" {{$settings->anonymous_permission == 0 ? 'checked' : ''}} />
                        <label class="custom-control-label" for="anonymous_permission0">@lang('strings.anonymous_permisshon_not_allowed')</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="anonymous_permission1" value="1" name="anonymous_permission" class="custom-control-input" {{$settings->anonymous_permission == 1 ? 'checked' : ''}} />
                        <label class="custom-control-label" for="anonymous_permission1">@lang('strings.anonymous_permisshon_allowed')</label>
                    </div>
                    <div class="text-danger">{{$errors->first('anonymous_permisshon') ?? ''}}</div>
                </div>
            </div>

            <div class="h6 font-weight-bold">@lang('strings.user_create')</div>
            <div class="card bg-light text-black shadow mb-3">
                <div class="card-body">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="user_create_any" name="user_create_any" type="checkbox" value="1"
                            @if ($settings->user_create_any == 1)
                                checked
                            @endif
                        />
                        <label class="custom-control-label" for="user_create_any">@lang('strings.user_create_any')</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="user_create_member" name="user_create_member" type="checkbox" value="1"
                            @if ($settings->user_create_member == 1)
                                checked
                            @endif
                        />
                        <label class="custom-control-label" for="user_create_member">@lang('strings.user_create_member')</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" id="user_create_admin" name="user_create_admin" type="checkbox" value="1"
                            @if ($settings->user_create_admin == 1)
                                checked
                            @endif
                            disabled="disabled"
                        />
                        <label class="custom-control-label" for="user_create_admin">@lang('strings.user_create_admin')</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-12">
            <div class="h6 font-weight-bold">@lang('strings.basic_auth')</div>
            <div class="card bg-light text-black shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-12 pb-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="basic_auth1" value="1" name="basic_auth" class="custom-control-input" {{$settings->basic_auth == 1 ? 'checked' : ''}} />
                                <label class="custom-control-label" for="basic_auth1">@lang('strings.enable')</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="basic_auth2" value="0" name="basic_auth" class="custom-control-input" {{$settings->basic_auth == 0 ? 'checked' : ''}} />
                                <label class="custom-control-label" for="basic_auth2">@lang('strings.disable')</label>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <span class="h6 text-nowrap">@lang('strings.user_name')</span>
                        </div>
                        <div class="col-md-8 col-12 pb-2">
                            {{Form::input('text', 'basic_user', $settings->basic_user, [
                                'style' => 'width: 100%;'
                            ])}}
                            <div class="text-danger">{{$errors->first('basic_user') ?? ''}}</div>
                        </div>
                        <div class="col-md-4 col-12">
                            <span class="h6 text-nowrap">@lang('strings.password')</span>
                        </div>
                        <div class="col-md-8 col-12">
                            {{Form::input('text', 'basic_password', $settings->basic_password, [
                                'style' => 'width: 100%;'
                            ])}}
                            <div class="text-danger">{{$errors->first('basic_password') ?? ''}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-5 text-center">
            <a href="javascript:settings.submit()" class="btn btn-success shadow-sm btn-edit-cancel-save">
                <i class="fas fa-check fa-sm"></i> @lang('strings.save')
            </a>
        </div>
    </div>
    {{Form::close()}}
</div>
<!-- /.container-fluid -->

<!-- Toast -->
@include('shared.toast')
@if (Session::get('result') == 1)
<script>
    $(window).on('load', function() {
        $('#toastMessage').text('@lang('strings.operation_messages.saved_site_settings')');
        $('#toast').toast('show');
    });
</script>
@endif

@endsection