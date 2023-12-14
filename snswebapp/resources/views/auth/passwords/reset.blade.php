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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">@lang('auth.reset_password_title')</h1>
                                        <div class="mb-4">@lang('auth.reset_password_message')</div>
                                    </div>

                                    {{Form::open([
                                        'method' => 'post',
                                        'url' => '/password/reset',
                                        'class' => 'user',
                                    ])}}
                                        @csrf
                                        <input type="hidden" name="token" value="{{$token}}">

                                        <div class="form-group">
                                            <input
                                                id="password" name="password" type="password"
                                                class="form-control form-control-user"
                                                placeholder="@lang('strings.password')" />
                                            <div class="text-danger">{{$errors->first('password') ?? ''}}</div>
                                        </div>

                                        <div class="form-group">
                                            <input
                                                id="password-confirm" name="password_confirm" type="password"
                                                class="form-control form-control-user"
                                                placeholder="@lang('strings.confirm')"
                                                value="{{old('password')}}">
                                            <div class="text-danger">{{$errors->first('password_confirm') ?? ''}}</div>
                                        </div>

                                        <input type="submit" value="@lang('auth.reset_password')" class="btn btn-primary btn-user btn-block" />
                                    {{Form::close()}}

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
</html>