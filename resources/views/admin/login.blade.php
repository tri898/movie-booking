<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Login movie admin cms">
    <meta name="author" content="Movie CMS">
    <meta name="keywords" content="admin, login, cms">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('admin/img/icons/icon-48x48.png')}}" />

    <link rel="canonical" href="/" />

    <title>CMS | Login</title>

    <link href="{{mix('admin/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back!</h1>
                        <p class="lead">
                            Sign in to your account to continue
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                @if ($errors->any())
                                    <div class="alert alert-warning" role="alert">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert-message">
                                                {{ $error }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <form id="login-form" action="{{route('admin.auth.login')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Email*</strong></label>
                                        <input class="form-control form-control-lg" type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="Enter your email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"><strong>Password*</strong></label>
                                        <input class="form-control form-control-lg" type="password" id="login-password" name="password" value="{{ old('password') }}" placeholder="Enter your password" />
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input" value="1" name="remember_me" @checked(old('remember_me', 0))>
                                            <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
{{--                    <div class="text-center mb-3">--}}
{{--                        Don't have an account? <a href="pages-sign-up.html">Sign up</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ mix('/admin/js/app.js') }}"></script>
<script src="{{ mix('/admin/js/pages/login.js')}}"></script>
</body>

</html>
