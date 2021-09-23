<!DOCTYPE html>
<html lang="en">

<head>
<!-- Header -->
@include('shared.header')

<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js" defer></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Side Bar -->
        @include('shared.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Top Bar -->
                @include('shared.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    {{Form::open(['name' => 'settings', 'url' => '/managements/settings/post', 'method' => 'post', 'files' => true])}}
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
                            <div class="h6 font-weight-bold">基本設定</div>
                            <div class="card bg-light text-black shadow mb-3">
                                <div class="row card-body">
                                    <div class="col-md-4 col-12">
                                        <span class="h6 text-nowrap">サイト名</span>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        {{Form::input('text', 'site_name', old('site_name') ?? $settings->site_name, [
                                            'style' => 'width: 100%;'
                                        ])}}
                                        <div class="text-danger">{{$errors->first('site_name') ?? ''}}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="h6 font-weight-bold">ユーザー登録</div>
                            <div class="card bg-light text-black shadow mb-3">
                                <div class="card-body">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="user_create_any" name="user_create_any" type="checkbox" value="1" />
                                        <label class="custom-control-label" for="user_create_any">誰でも登録できる</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="user_create_for_member" name="user_create_for_member" type="checkbox" value="1" />
                                        <label class="custom-control-label" for="user_create_for_member">メンバーの紹介で登録できる</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" id="user_create_for_admin" name="user_create_for_admin" type="checkbox" value="1" />
                                        <label class="custom-control-label" for="user_create_for_admin">管理者の紹介で登録できる</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-12">
                            <div class="h6 font-weight-bold">ベーシック認証</div>
                            <div class="card bg-light text-black shadow mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-12 pb-2">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="basic_auth1" value="1" name="basic_auth" class="custom-control-input" {{$settings->basic_auth == 1 ? 'checked' : ''}} />
                                                <label class="custom-control-label" for="basic_auth1">有効</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="basic_auth2" value="0" name="basic_auth" class="custom-control-input" {{$settings->basic_auth == 0 ? 'checked' : ''}} />
                                                <label class="custom-control-label" for="basic_auth2">無効</label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-12">
                                            <span class="h6 text-nowrap">ユーザー名</span>
                                        </div>
                                        <div class="col-md-8 col-12 pb-2">
                                            {{Form::input('text', 'basic_user', $settings->basic_user, [
                                                'style' => 'width: 100%;'
                                            ])}}
                                            <div class="text-danger">{{$errors->first('basic_user') ?? ''}}</div>
                                        </div>
                                        <div class="col-md-4 col-12">
                                            <span class="h6 text-nowrap">パスワード</span>
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

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('shared.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Script Files -->
    @include('shared.scripts')

    <script>
    jQuery(document).ready(function($) {
        console.log("lazyload");
        $(".lazyload").lazyload();
    });
    </script>
</body>

</html>