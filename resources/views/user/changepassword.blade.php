@include('layouts.user.header')

<div class="container mb-3">
    <div class="row justify-content-center">
        <div class="col-13 col-md-10 col-lg-8 px-1 px-md-2">
            <div class="row mx-0">
                <div class="col-12 px-0 px-md-2">
                    <div class="res-main-headings mb-3"> <i class="fa-solid fa-lock me-2 menu-icon2"></i> <span class="text-blue font-weight-500">Change Password</span> </div>
                </div>
            </div>
            <div class="row px-1">
                <div class="col-12">
                    <div class="card shadow-none">
                        <!-- <div class="card-header">Change Password</div> -->

                        <div class="card-body pt-2 pb-3 p-sm-3">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <form id="changePasswordForm" method="POST" action="{{ route('password.newupdate') }}">
                                @csrf

                                <div class="form-group row mb-2 mb-sm-3">
                                    <label for="current_password" class="col-12 col-sm-4 col-form-label text-md-right mb-0 mb-sm-2">Current Password</label>

                                    <div class="col-12 col-sm-8 col-md-6">
                                        <div class="input-group">
                                            <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="#" id="toggleCurrentPassword">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-2 mb-sm-3">
                                    <label for="password" class="col-12 col-sm-4 col-form-label text-md-right mb-0 mb-sm-2">New Password</label>

                                    <div class="col-12 col-sm-8 col-md-6">
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="#" id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-2 mb-sm-3">
                                    <label for="password_confirmation" class="col-12 col-sm-4 col-form-label text-md-right mb-0 mb-sm-2">Confirm New Password</label>

                                    <div class="col-12 col-sm-8 col-md-6">
                                        <div class="input-group">
                                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <a href="#" id="togglePasswordConfirmation">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div id="password_confirmation_error" class="invalid-feedback" style="display: none;">
                                            Passwords do not match.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-3 mt-sm-0 mb-0">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">
                                                Change Password
                                            </button>
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

<script>
    $(document).ready(function() {
        // Function to toggle password visibility
        function togglePasswordVisibility(inputId) {
            var input = $('#' + inputId);
            var type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
        }

        $('#toggleCurrentPassword').click(function(e) {
            e.preventDefault();
            togglePasswordVisibility('current_password');
        });

        $('#togglePassword').click(function(e) {
            e.preventDefault();
            togglePasswordVisibility('password');
        });

        $('#togglePasswordConfirmation').click(function(e) {
            e.preventDefault();
            togglePasswordVisibility('password_confirmation');

            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();
            var passwordConfirmationError = $('#password_confirmation_error');

            if (password !== passwordConfirmation) {
                passwordConfirmationError.css('display', 'block');
            } else {
                passwordConfirmationError.css('display', 'none');
            }
        });

        $('#changePasswordForm').submit(function(e) {
            var password = $('#password').val();
            var passwordConfirmation = $('#password_confirmation').val();
            var passwordConfirmationError = $('#password_confirmation_error');

            if (password !== passwordConfirmation) {
                passwordConfirmationError.css('display', 'block');
                e.preventDefault(); // Prevent form submission
            }
        });
    });
</script>


@include('layouts.user.footer')
