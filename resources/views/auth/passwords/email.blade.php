@include('admin.header-login')
<link rel="stylesheet" href="{{ asset('public/css/horizontal-layout/lms.css')}}" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
/>

<style>
    .form-check-input {
        position: absolute;
        margin-top: 0px;
        margin-left: 0px;
    }
    label {
        color: #292d34 !important;
    }
    
</style>

<div class="my-4 my-lg-5">
<div class="container my-4 my-md-0 lgn-page">
    <div class="row px-3 px-md-0">
        <div class="col-12 bg-white bg-transparent-sm rounded-4">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5 px-0">
                    <div class="login-image-section">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{url('public/images/tas-logo.png')}}" class="img-fluid login-logo-image" />
                            <span class="pl-4 pl-lg-4 mang-system">Learning Management System</span>
                        </div>
                        <div class="py-0 py-md-4 my-3">
                            <img src="{{url('public/images/login-image.png')}}" class="img-fluid login-image mx-auto d-block" alt="login-image" />
                        </div>
                        <div class="text-center on-bg-text">
                            <i>"Great talent is not hired, it is built"</i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-7 px-0 px-md-0 px-lg-0 login-top-grd-border">
                    <div class="login-form-section bg-white mb-3 mb-md-0 h-100">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-right mb-3">
                                    <!-- <a href="mailto: taslms@tasengg.com" class="support-text">Support</a> -->
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 offset-lg-2">
                                <div>
                                    <h1 class="text-center mt-2 lgn-wel-text">{{ __('Reset Password') }}</h1>
                                    <p class="text-center">Enter your email and we'll send you a link to reset your password.</p>
                                </div>
                                 @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form method="post" class="pt-3 pt-lg-5 mt-lg-4" action="{{ route('password.email') }}">
                                    @csrf
                                    <!-- CSRF token -->
                                     <div class="form-group row mb-4">
                                        <label for="staticEmail" class="col-12">{{ __('Email Address') }}</label>
                                        <div class="col-12 fields-div">
                                            <i class="fa-solid fa-envelope mail-icon"></i>
                                            <input id="email" type="email" class="form-control inpt-field @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row pt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn reset-btn text-white">
                                                {{ __('Send Reset Link') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-12 mt-3">
                                            <div class="text-center">
                                               <a href="{{url('/')}}" class="">Back to Login</a>
                                           </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
