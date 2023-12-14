<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Header -->
    @include('shared.header')
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">{{$settings->site_name}}</h1>
                                    </div>
                                    {{Form::open([
                                        'url' => route('login'),
                                        'method' => 'post',
                                        'class' => 'user',
                                    ])}}

                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="inputEmail" aria-describedby="emailHelp"
                                                placeholder="@lang('strings.email')" />
                                            <div class="text-danger">{{$errors->first('email') ?? ''}}</div>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="inputPassword" placeholder="@lang('strings.password')" />
                                            <div class="text-danger">{{$errors->first('password') ?? ''}}</div>
                                        </div>
                                        <div class="form-group text-danger">{{$faild ?? ''}}</div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input name="remember" type="checkbox" class="custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">@lang('auth.password_remember')</label>
                                            </div>
                                        </div>
                                        <input type="hidden" name="redirect" value="{{session('redirect')}}" />
                                        <input type="submit" value="@lang('auth.login')" class="btn btn-primary btn-user btn-block" />
                                    {{Form::close()}}
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/password/email">@lang('auth.forgot_password_link')</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
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