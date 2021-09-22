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
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">@lang('auth.forgot_password_title')</h1>
                                        <p class="mb-4">@lang('auth.forgot_password_message')</p>
                                    </div>
                                    <form class="user" action="/password/email" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input
                                                id="inputEmail" name="email" type="email"
                                                class="form-control form-control-user"
                                                aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                            <div class="text-danger">{{$errors->first('email') ?? ''}}</div>
                                        </div>

                                        <input type="submit" value="@lang('auth.reset_password')" class="btn btn-primary btn-user btn-block" />
                                    </form>

                                    <div class="mt-4 p-2 text-primary font-weight-bold">{{$resultMessage ?? ''}}</div>

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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>