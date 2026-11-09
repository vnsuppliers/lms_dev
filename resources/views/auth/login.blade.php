
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
    body{
        padding-top: 0px !important;
    }
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
                <!-- <div class="col-12 px-0">
                    <div class="login-top-grd-border">
                        
                    </div>
                </div> -->
                <div class="col-12 col-md-6 col-lg-5 px-0">
                    <div class="login-image-section">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{url('public/images/tas-logo.png')}}" class="img-fluid login-logo-image" />
                            <span class="pl-4 pl-lg-4 mang-system">Corporate LMS</span>
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
                                    <h1 class="text-center mt-2 lgn-wel-text">Welcome</h1>
                                    <p class="text-center">Log in with your organization email & password</p>
                                </div>
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <form method="post" class="pt-3 pt-lg-5 mt-lg-4" action="{{ url('login') }}">
                                    @csrf
                                    <!-- CSRF token -->
                                    <div class="form-group row mb-2 mb-md-4">
                                        <label for="staticEmail" class="col-12">Email Address</label>
                                        <div class="col-12 fields-div">
                                            <i class="fa-solid fa-envelope mail-icon"></i>
                                            <input type="text" class="form-control inpt-field" placeholder="Email Address" id="email" name="email" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2 mb-md-4">
                                        <label for="inputPassword" class="col-12">Password</label>
                                        <div class="col-12 fields-div">
                                            <i class="fa-solid fa-lock lock-icon"></i>
                                            <input type="password" class="form-control inpt-field" placeholder="Enter Your Password" id="password" name="password" />
                                            <i class="fa-solid fa-eye pass-eye-icon" id="togglePassword"></i>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2 mb-md-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <!-- <div>
                                                    <input type="checkbox" class="form-check-input" name="remember" />
                                                    <span class="pl-4">Remember me</span>
                                                </div> -->
                                              <div>
                                                    <a href="{{url('forget-password')}}" class="pb-1">Forgot Password?</a>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row pt-0 pt-md-3">
                                        <div class="col-12 pt-2">
                                            <button type="submit" class="btn text-white login-btn shadow-none border-0">Login</button>
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
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        var passwordInput = document.getElementById('password');
        var passEyeIcon = document.getElementById('togglePassword');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passEyeIcon.classList.remove('fa-eye');
            passEyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            passEyeIcon.classList.remove('fa-eye-slash');
            passEyeIcon.classList.add('fa-eye');
        }
    });
</script>
