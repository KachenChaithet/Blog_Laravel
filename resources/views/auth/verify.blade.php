<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" />
</head>

<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
        <div class="col-lg-5 col-md-7 mx-auto">

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">

                    <div class="text-center mb-4">
                        <img src="{{ asset('backend/assets/images/logo-dark.png') }}" height="32" class="mb-3">
                        <h4 class="fw-bold">Verify Your Login</h4>
                        <p class="text-muted mb-0">
                            Enter the 6-digit verification code sent to your email
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('custom.verification.verify') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Verification Code</label>
                            <input
                                type="text"
                                name="code"
                                class="form-control form-control-lg text-center @error('code') is-invalid @enderror"
                                placeholder="••••••"
                                maxlength="6"
                                required
                            >
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Verify & Continue
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <p class="text-center text-muted mt-3 mb-0">
                Didn’t receive the code? Please check your spam folder.
            </p>

        </div>
    </div>
</div>

<script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>
</html>
