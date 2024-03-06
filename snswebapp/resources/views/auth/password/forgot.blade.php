<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Header -->
    @include('shared.header')
</head>
<body>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 bg-light">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="/images/login/{{$settings->login_file_name}}"
                                    style="width:100%; height: 65vh; object-fit: cover;" />
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">@lang('auth.forgot_password_title')</h1>
                                        <div class="mb-4">@lang('auth.forgot_password_message')</div>
                                    </div>
                                    {{Form::open([
                                        'url' => '/password/email',
                                        'method' => 'post',
                                        'class' => 'user',
                                    ])}}
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                id="inputEmail" name="email" type="email"
                                                class="form-control form-control-user"
                                                aria-describedby="emailHelp"
                                                placeholder="@lang('strings.email')">
                                            <div class="text-danger">{{$errors->first('email') ?? ''}}</div>
                                        </div>

                                        <input type="submit" value="@lang('auth.reset_password_send')" class="btn btn-primary btn-user btn-block" />
                                    {{Form::close()}}

                                    <div class="mt-4 p-2 text-success">{{$result_message ?? ''}}</div>

                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.html">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script Files -->
    @include('shared.scripts')
</body>