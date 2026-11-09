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

<div class="container my-4 my-md-0 lgn-page">
    <div class="row px-3 px-md-0">
        <div class="col-12 bg-white rounded-4">
            <div class="row">
                <div class="col-12 px-0">
                    <!-- <div class="login-top-grd-border">
                        
                    </div> -->
                </div>
                <div class="col-12 col-md-6 col-lg-5 px-0">
                    <div class="login-image-section">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{url('public/repo_lms_admin_ui/images/tas-logo.png')}}" class="img-fluid" width="65px" />
                            <span class="pl-4 pl-lg-5 mang-system">Learning Management System</span>
                        </div>
                        <div class="py-5 my-3">
                            <img src="{{url('public/repo_lms_admin_ui/images/login-image.png')}}" class="img-fluid" alt="login-image" />
                        </div>
                      
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-7 px-3 px-md-0 px-lg-0 login-top-grd-border">
                    <div class="login-form-section bg-white mb-3 mb-md-0 h-100">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 offset-lg-2 mt-3">
                                <div>
                                    <h1 class="text-center mt-2">{{ __('Reset Password') }}</h1>
                                 
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

                    <form method="POST" class="pt-3 pt-lg-5 mt-lg-4" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

 

                      

    


                        <div class="form-group row mb-4">
                            <label for="email" class="col-12">{{ __('Email Address') }}</label>

                            <div class="col-12 fields-div">
                                <i class="fa-solid fa-envelope mail-icon"></i>
                                <input id="email" type="email" class="form-control inpt-field @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password" class="col-12">{{ __('Password') }}</label>

                            <div class="col-12 fields-div">
                                <i class="fa-solid fa-lock lock-icon"></i>
                                <input id="password" type="password" class="form-control inpt-field @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="password-confirm" class="col-12">{{ __('Confirm Password') }}</label>

                            <div class="col-12 fields-div">
                                <i class="fa-solid fa-lock lock-icon"></i>
                                <input id="password-confirm" type="password" class="form-control inpt-field" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row pt-0 pt-md-3">
                            <div class="col-12">
                                <button type="submit" class="btn text-white login-btn shadow-none border-0">
                                    {{ __('Reset Password') }}
                                </button>
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

