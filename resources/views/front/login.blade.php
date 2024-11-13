<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login with Forgot Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Login</h2>
                <form action="{{ route('front.login') }}" method="post" class="border p-4 rounded">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="login_email"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email"
                            value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="login_password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
                <button type="button" class="btn btn-link mt-3" data-toggle="modal"
                    data-target="#forgotPasswordModal">Forgot Password?</button>
                <a href="{{route('socialite.login', ['provider' => 'google'])}}" class="btn btn-link mt-3">Login with Google</a>
                <a href="{{ route('socialite.login', ['provider' => 'facebook']) }}">Login with Facebook</a>
            </div>
        </div>
    </div>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="emailForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" id="forgot_email" class="form-control" placeholder="Enter your email">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="button" id="sendOtpBtn" class="btn btn-primary btn-block">Send OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- OTP Verification Modal -->
    <div class="modal fade" id="otpVerificationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Verify OTP</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="otpForm">
                        <div class="form-group">
                            <label for="otp">OTP</label>
                            <input type="text" id="otp" class="form-control" placeholder="Enter OTP">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="button" id="verifyOtpBtn" class="btn btn-primary btn-block">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- New Password Modal -->
    <div class="modal fade" id="newPasswordModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="passwordForm">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="new_password" class="form-control"
                                placeholder="Enter new password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" id="confirm_password" class="form-control"
                                placeholder="Confirm new password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button type="button" id="resetPasswordBtn" class="btn btn-primary btn-block">Reset
                            Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Get CSRF token
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Helper function to show validation errors
        function showValidationErrors(input, message) {
            input.addClass('is-invalid');
            input.next('.invalid-feedback').text(message);
        }

        // Clear validation errors
        function clearValidationErrors(input) {
            input.removeClass('is-invalid');
            input.next('.invalid-feedback').text('');
        }

        // AJAX: Send OTP
        $('#sendOtpBtn').click(function() {
            const email = $('#forgot_email');

            clearValidationErrors(email); // Clear previous errors
            $.post('{{ route('front.password.email') }}', {
                    email: email.val(),
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.status) {
                        // email.val(''); // Clear input field
                        $('#forgotPasswordModal').modal('hide');
                        $('#otpVerificationModal').modal('show');
                    } else {
                        showValidationErrors(email, 'This email not exist');
                    }
                })
                .fail(function(xhr) {
                    // showValidationErrors(email, xhr.responseJSON.errors.email[0]);
                    showValidationErrors(email, xhr.responseJSON.errors);
                });
        });

        // AJAX: Verify OTP
        $('#verifyOtpBtn').click(function() {
            const otp = $('#otp');
            let email = $('#forgot_email').val();
            clearValidationErrors(otp); // Clear previous errors
            $.post('{{ route('front.password.verifyOtp') }}', {
                    otp: otp.val(),
                    email: email,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.status) {
                        otp.val(''); // Clear input field
                        $('#otpVerificationModal').modal('hide');
                        $('#newPasswordModal').modal('show');
                    } else {
                        showValidationErrors(otp, response.message);
                    }
                })
                .fail(function(xhr) {
                    showValidationErrors(otp, xhr.responseJSON.errors);
                });
        });

        // AJAX: Reset Password
        $('#resetPasswordBtn').click(function() {
            const password = $('#new_password');
            const confirmPassword = $('#confirm_password');
            let email = $('#forgot_email').val();
            clearValidationErrors(password); // Clear previous errors
            clearValidationErrors(confirmPassword); // Clear previous errors

            $.ajax({
                url: '{{ route('front.password.update') }}?_method=PATCH',
                type: 'POST', // Still use POST since PATCH is simulated
                data: {
                    password: password.val(),
                    email: email,
                    confirm_password: confirmPassword.val(),
                    _token: csrfToken
                },
                success: function(response) {
                    Swal.fire('Success', 'Password reset successful! Please log in.', 'success');
                    $('#newPasswordModal').modal('hide');
                    password.val(''); // Clear input field
                    confirmPassword.val(''); // Clear input field
                },
                error: function(xhr) {
                    if (xhr.responseJSON.errors) {
                        showValidationErrors(password, xhr.responseJSON.errors);
                    }
                    if (xhr.responseJSON.errors.password_confirmation) {
                        showValidationErrors(confirmPassword, xhr.responseJSON.errors);
                    }
                }
            });
        });
    </script>

</body>

</html>
