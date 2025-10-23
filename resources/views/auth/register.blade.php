<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register | SITIMBANG</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
    <meta name="keywords"
        content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
    <meta name="author" content="CodedThemes">

    <link rel="icon" href="{{ asset('template/dist') }}/assets/images/favicon.svg" type="image/x-icon">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
        id="main-font-link">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/feather.css">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/fonts/material.css">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style.css" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('template/dist') }}/assets/css/style-preset.css">

    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    {{-- Ganti logo jika perlu --}}
                    <a href="#"><img src="{{ asset('template/dist') }}/assets/images/logo-dark.svg"
                            alt="img"></a>
                </div>
                <div class="card my-5">
                    <div class="card-body">

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>{{ __('Sign up') }}</b></h3>
                                <a href="{{ route('login') }}" class="link-primary">Already have an account?</a>
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="name">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Full Name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirm Password">
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">{{ __('Create Account') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/popper.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/simplebar.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/bootstrap.min.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/fonts/custom-font.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/pcoded.js"></script>
    <script src="{{ asset('template/dist') }}/assets/js/plugins/feather.min.js"></script>

    <script>
        layout_change('light');
    </script>
    <script>
        change_box_container('false');
    </script>
    <script>
        layout_rtl_change('false');
    </script>
    <script>
        preset_change("preset-1");
    </script>
    <script>
        font_change("Public-Sans");
    </script>
</body>

</html>
