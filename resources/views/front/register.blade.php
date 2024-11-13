<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form with Backend Errors</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form action="{{ route('front.user.store') }}" method="POST">
            @csrf

            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                    id="first_name" value="{{ old('first_name') }}">
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                    id="last_name" value="{{ old('last_name') }}">
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback"></div>
            </div>
            <button type="button" id="sendOtpBtn" class="btn btn-primary btn-block">Send OTP</button>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    id="phone" value="{{ old('phone') }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
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
            const email = $('#email');
    
            clearValidationErrors(email); // Clear previous errors
            $.post('{{ route('front.sign.up.email.verify') }}', {
                    email: email.val(),
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.status) {
                        $('#otpVerificationModal').modal('show');
                    } else {
                        showValidationErrors(email, 'This email already exist');
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
            let email = $('#email').val();
            clearValidationErrors(otp); // Clear previous errors
            $.post('{{ route('front.password.verifyOtp') }}', {
                    otp: otp.val(),
                    email: email,
                    _token: csrfToken
                })
                .done(function(response) {
                    if (response.status) {
                        otp.val(''); 
                        $('#otpVerificationModal').modal('hide');
                    } else {
                        showValidationErrors(otp, response.message);
                    }
                })
                .fail(function(xhr) {
                    showValidationErrors(otp, xhr.responseJSON.errors);
                });
        });
    </script>
</body>

</html>
