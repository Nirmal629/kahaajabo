  <header class="mainheader_wrap" id="myHeader">
        <div class="cust_container">
            <div class="content_wrap">
                <a href="#" class="logo_wrap">
                    <img src="{{ asset('public/Frontend/Assets/images/logo1.png') }}" class="img-fluid" alt="logo" />
                </a>
               
                <div class=" align-items-center right-part">
                    {{-- <button type="button" class="Primary-btn" data-toggle="modal" data-target="#myModal">Register as a
                        Partner</button>
                    
                    <button class="Primary-btn" data-toggle="modal" data-target="#carModal">Register your Car</button>
                    
                    <button class="Primary-btn" data-toggle="modal" data-target="#driverModal">Register as a
                        Driver</button> --}}
                    
                   
                    <div class="dropdown">
                        <button class="Primary-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Register as a Partner
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#myModal">Register as a
                                Manager</a>

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#carModal">Register Your
                                car</a>

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#driverModal">Register as
                                a Driver</a>

                        </div>
                    </div>

                    <button class="Primary-btn" data-toggle="modal" data-target="#bookingModal"><i
                            class="fa-solid fa-phone mr-2"></i>Request a Call</button>


                    @if(Auth::guard('web')->check())

                        @php
                            $user = Auth::guard('web')->user();

                            switch ($user->user_type) {
                                case 'user':
                                    $dashboardUrl = route('user.dashboard');
                                    break;

                                case 'area_manager':
                                    $dashboardUrl = route('manager.dashboard');
                                    break;

                                case 'driver':
                                    $dashboardUrl = route('driver.dashboard');
                                    break;

                                case 'car_owner':
                                    $dashboardUrl = route('car_owner.dashboard');
                                    break;

                                default:
                                    $dashboardUrl = route('home.index');
                                    break;
                            }
                        @endphp

                        <a href="{{ $dashboardUrl }}">
                            <i class="fa-solid fa-user"></i>
                        </a>

                    @else

                        <button type="button"
                            class="Secondary-btn"
                            data-toggle="modal"
                            data-target="#registerModal">
                            Sign in / Register
                        </button>

                    @endif
                    
                    <select class="language">
                        <option>English</option>
                        <option>Hindi</option>
                    </select>
                    
                    <button class="hambarger_btn" onclick='openNav()'><i
                            class="fa-solid fa-bars-staggered"></i></button>
                </div>
            </div>
        </div>
    </header>


<!--Register Manager Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Register as a
                    Partner</h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="fa-solid fa-x"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="partnerRegistrationForm"
                    action="{{ route('partner.register') }}"
                    enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="open_modal" value="myModal">
                    <!-- First Name / Last Name -->
                    <div class="form-group">
                        <label>Name</label>

                        <div class="row">
                            <div class="col">
                                <input type="text"
                                    name="partner_first_name"
                                    class="form-control"
                                    placeholder="First name"
                                    value="{{ old('partner_first_name') }}">

                                @error('partner_first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text"
                                    name="partner_last_name"
                                    class="form-control"
                                    placeholder="Last name"
                                    value="{{ old('partner_last_name') }}">

                                @error('partner_last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email address</label>

                        <input type="email"
                            name="partner_email"
                            class="form-control"
                            placeholder="Enter your email"
                            value="{{ old('partner_email') }}">

                        @error('partner_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Phone -->
                    <div class="form-group">
                        <label>Phone No</label>

                        <input type="text"
                            name="partner_phone"
                            class="form-control"
                            placeholder="Enter your mobile no"
                            value="{{ old('partner_phone') }}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            >

                        @error('partner_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Password -->
                    {{-- <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>

                        <input type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                            autocomplete="new-password"
                            required>

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <!-- Confirm Password -->
                    {{-- <div class="form-group">
                        <label>Confirm Password <span class="text-danger">*</span></label>

                        <input type="password"
                            name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm your password"
                            autocomplete="new-password"
                            required>

                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <button type="submit" id="registerBtn"
                            class="Primary-btn m-auto d-table">
                        SignUp
                    </button>

                </form>
            </div>

        </div>

    </div>
</div>

<!--Register car Modal -->
<div class="modal fade" id="carModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Register your car
                </h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="fa-solid fa-x"></i></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Last name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Enter your email">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phone No</label>
                        <input type="tel" class="form-control" id="exampleInputPassword1"
                            placeholder="Enter your mobile no">
                    </div>
                    <div class="form-group">
                        <label for="inputState">Country</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState">District</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState">City Of Operation</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <button type="submit" class="Primary-btn m-auto d-table">Submit</button>
                </form>
            </div>

        </div>

    </div>
</div>

<!--Register Driver Modal -->
<div class="modal fade" id="driverModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Register as a Driver
                </h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="fa-solid fa-x"></i></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="driverRegistrationForm"
                    action="{{ route('driver.register') }}"
                    enctype="multipart/form-data">

                    @csrf
                    <input type="hidden"
                           name="open_modal"
                           value="driverModal">
                    <!-- First Name / Last Name -->
                    <div class="form-group">
                        <label>Name</label>

                        <div class="row">
                            <div class="col">
                                <input type="text"
                                    name="driver_first_name"
                                    class="form-control"
                                    placeholder="First name"
                                    value="{{ old('driver_first_name') }}">

                                @error('driver_first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text"
                                    name="driver_last_name"
                                    class="form-control"
                                    placeholder="Last name"
                                    value="{{ old('driver_last_name') }}">

                                @error('driver_last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email address</label>

                        <input type="email"
                            name="driver_email"
                            class="form-control"
                            placeholder="Enter your email"
                            value="{{ old('driver_email') }}">

                        @error('driver_email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Phone -->
                    <div class="form-group">
                        <label>Phone No</label>

                        <input type="text"
                            name="driver_phone"
                            class="form-control"
                            placeholder="Enter your mobile no"
                            value="{{ old('driver_phone') }}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            >

                        @error('driver_phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
     
                    <button type="submit" id="driverRegisterButton"
                            class="Primary-btn m-auto d-table">
                        Submit
                    </button>

                </form>
            </div>

        </div>

    </div>
</div>

<!--Booking Modal -->
<div class="modal fade" id="bookingModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Request for booking
                </h4>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="fa-solid fa-x"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requestCall.enquiry.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Name *</label>

                        <div class="row">
                            <div class="col">
                                <input type="text"
                                    name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    placeholder="First name"
                                    value="{{ old('first_name') }}">

                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text"
                                    name="middle_name"
                                    class="form-control @error('middle_name') is-invalid @enderror"
                                    placeholder="Middle name"
                                    value="{{ old('middle_name') }}">

                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col">
                                <input type="text"
                                    name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    placeholder="Last name"
                                    value="{{ old('last_name') }}">

                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email address *</label>

                        <input type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            placeholder="Enter your email"
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Primary Mobile No *</label>

                        <input type="tel"
                            name="primary_mobile"
                            class="form-control @error('primary_mobile') is-invalid @enderror"
                            placeholder="Enter your mobile no"
                            value="{{ old('primary_mobile') }}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            >

                        @error('primary_mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Secondary Mobile No</label>

                        <input type="tel"
                            name="secondary_mobile"
                            class="form-control @error('secondary_mobile') is-invalid @enderror"
                            placeholder="Enter your mobile no"
                            value="{{ old('secondary_mobile') }}"
                            maxlength="10"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            >

                        @error('secondary_mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Home Address *</label>

                        <input type="text"
                            name="home_address"
                            class="form-control @error('home_address') is-invalid @enderror"
                            placeholder="Enter your address"
                            value="{{ old('home_address') }}">

                        @error('home_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Office Address</label>

                        <input type="text"
                            name="office_address"
                            class="form-control @error('office_address') is-invalid @enderror"
                            placeholder="Enter your address"
                            value="{{ old('office_address') }}">

                        @error('office_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Message</label>

                        <textarea name="message"
                                class="form-control @error('message') is-invalid @enderror"
                                rows="3">{{ old('message') }}</textarea>

                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="Primary-btn m-auto d-table">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Register_Login Modal -->
<div class="modal fade"
     id="registerModal"
     role="dialog"
     tabindex="-1"
     aria-labelledby="registerModalLabel"
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <ul class="nav nav-pills mb-3"
                    id="pills-tab"
                    role="tablist">

                    <!-- SIGN UP -->

                    <li class="nav-item">

                        <a class="nav-link"
                           id="pills-home-tab"
                           data-toggle="pill"
                           href="#pills-home"
                           role="tab"
                           aria-controls="pills-home"
                           aria-selected="false">

                            <h4 class="modal-title">
                                SIGN UP
                            </h4>

                        </a>

                    </li>


                    <!-- LOGIN -->

                    <li class="nav-item">

                        <a class="nav-link active"
                           id="pills-profile-tab"
                           data-toggle="pill"
                           href="#pills-profile"
                           role="tab"
                           aria-controls="pills-profile"
                           aria-selected="true">

                            <h4 class="modal-title">
                                LOGIN
                            </h4>

                        </a>

                    </li>

                </ul>
                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <i class="fa-solid fa-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <form id="userRegistrationForm">
                            @csrf
                            <div class="form-group">
                                <label>Name *</label>

                                <div class="row">

                                    <div class="col">
                                        <input type="text"
                                            name="first_name"
                                            id="user_first_name"
                                            class="form-control"
                                            placeholder="First name"
                                            required>
                                    </div>

                                    <div class="col">
                                        <input type="text"
                                            name="middle_name"
                                            id="user_middle_name"
                                            class="form-control"
                                            placeholder="Middle name">
                                    </div>

                                    <div class="col">
                                        <input type="text"
                                            name="last_name"
                                            id="user_last_name"
                                            class="form-control"
                                            placeholder="Last name"
                                            required>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email address *</label>

                                <input type="email"
                                    name="email"
                                    id="user_register_email"
                                    class="form-control"
                                    placeholder="Enter your email"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Primary Mobile No *</label>

                                <input type="text"
                                    name="primary_mobile"
                                    id="user_primary_mobile"
                                    class="form-control"
                                    placeholder="Enter your mobile no"
                                    maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Secondary Mobile No</label>

                                <input type="text"
                                    name="secondary_mobile"
                                    id="user_secondary_mobile"
                                    class="form-control"
                                    placeholder="Enter your secondary mobile no"
                                    maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>

                            <div id="userRegistrationError"
                                class="text-danger mb-2"
                                style="display:none;">
                            </div>

                            <button type="submit"
                                    id="userRegisterBtn"
                                    class="Primary-btn m-auto d-table">

                                Register

                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade show active"
                        id="pills-profile"
                        role="tabpanel"
                        aria-labelledby="pills-profile-tab">

                        @if(session('login_error'))
                            <div class="alert alert-danger">
                                {{ session('login_error') }}
                            </div>
                        @endif


                        {{-- ================= PASSWORD LOGIN ================= --}}
                        <form action="{{ route('user.login') }}" method="POST">
                            @csrf

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label for="loginEmail">Email*</label>

                                <input type="email"
                                    name="login_email"
                                    id="loginEmail"
                                    class="form-control @error('login_email', 'login') is-invalid @enderror"
                                    placeholder="Enter Email"
                                    value="{{ old('login_email') }}"
                                    autocomplete="email"
                                    required>

                                @error('login_email', 'login')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            {{-- Password --}}
                            <div class="form-group mb-2">
                                <label for="loginPassword">Password*</label>

                                <div class="password-wrapper position-relative">

                                    <input type="password"
                                        name="login_password"
                                        id="loginPassword"
                                        class="form-control @error('login_password', 'login') is-invalid @enderror"
                                        placeholder="Password"
                                        autocomplete="current-password"
                                        required>

                                    <span id="toggleLoginPassword"
                                        style="
                                            position:absolute;
                                            right:15px;
                                            top:50%;
                                            transform:translateY(-50%);
                                            cursor:pointer;
                                            color:#777;
                                            z-index:10;
                                        ">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </span>

                                </div>

                                @error('login_password', 'login')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            {{-- Forgot Password --}}
                            <div class="text-right mb-3">
                                <a href=""
                                class="forget_password">
                                    Forgot password?
                                </a>
                            </div>


                            {{-- Email OTP Login --}}
                            <div class="text-center mb-3">
                                <a href="javascript:void(0);"
                                id="showEmailOtpLogin"
                                class="email-otp-login">
                                    Sign in using email OTP
                                </a>
                            </div>

                            {{-- Sign In --}}
                            <button type="submit"
                                class="Primary-btn m-auto d-table w-100">
                                Sign in
                            </button>

                        </form>


                        {{-- ================= EMAIL OTP LOGIN ================= --}}
                        <div id="emailOtpLoginBox" style="display:none;">

                            <div class="otp-login-header">
                                <h5>Sign in using email OTP</h5>

                                <p>
                                    Enter your email address and we'll send you a
                                    verification code.
                                </p>
                            </div>


                            <form id="emailOtpLoginForm">

                                @csrf

                                <div class="form-group mb-3">

                                    <label for="otpLoginEmail">
                                        Email*
                                    </label>

                                    <input type="email"
                                        name="email"
                                        id="otpLoginEmail"
                                        class="form-control"
                                        placeholder="Enter Email"
                                        required>

                                    <div id="otpLoginEmailError"
                                        class="text-danger mt-1"
                                        style="display:none;">
                                    </div>

                                </div>


                                <button type="submit"
                                    id="sendLoginOtpBtn"
                                    class="Primary-btn m-auto d-table w-100">

                                    Send OTP

                                </button>

                            </form>


                            {{-- Back to password login --}}
                            <div class="text-center mt-3">

                                <a href="javascript:void(0);"
                                id="backToPasswordLogin"
                                class="email-otp-login">

                                    ← Sign in using password

                                </a>

                            </div>

                        </div>


                        {{-- ================= DIVIDER ================= --}}
                        <div class="login-divider">
                            <span>OR</span>
                        </div>


                        {{-- ================= GOOGLE LOGIN ================= --}}
                        <a href=""
                        class="google-login-btn">

                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg"
                                alt="Google"
                                class="google-icon">

                            <span>Continue with Google</span>

                        </a>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- ========================================================= -->
<!-- OTP VERIFICATION MODAL -->
<!-- ========================================================= -->

<div class="modal fade"
     id="otpModal"
     tabindex="-1"
     aria-labelledby="otpModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content otp-modal-content">

            <div class="modal-body">

                <div class="otp-container">

                    <h2 class="otp-title">
                        OTP Verification
                    </h2>


                    <!-- Email Message -->
                    <div class="otp-message">

                        We've sent a verification code to your
                        email -

                        <strong id="otpEmail"></strong>

                    </div>


                    <!-- OTP Form -->
                    <form id="otpVerificationForm">

                        @csrf

                        <!-- Hidden Email -->
                        <input type="hidden"
                               name="email"
                               id="otp_email">


                        <!-- OTP -->
                        <div class="mb-3">

                            <input type="text"
                                   name="otp"
                                   id="otp"
                                   class="form-control otp-input"
                                   placeholder="Enter verification code"
                                   maxlength="6"
                                   inputmode="numeric"
                                   autocomplete="one-time-code">

                        </div>


                        <!-- OTP Error -->
                        <div id="otpError"
                             class="text-danger mb-3"
                             style="display:none;">
                        </div>


                        <!-- Submit -->
                        <button type="submit"
                                id="verifyOtpBtn"
                                class="btn otp-submit-btn">

                            Submit

                        </button>

                    </form>


                    <!-- Timer -->
                    <div class="text-center mt-3">

                        <span id="otpTimer">

                            Resend OTP in
                            <strong>60</strong>s

                        </span>


                        <button type="button"
                                id="resendOtpBtn"
                                class="btn btn-link"
                                style="display:none;">

                            Resend OTP

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade"
     id="loginOtpModal"
     tabindex="-1"
     aria-labelledby="otpModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content otp-modal-content">

            <div class="modal-body">

                <div class="otp-container">

                    <h2 class="otp-title">
                        OTP Verification
                    </h2>


                    <!-- Email Message -->
                    <div class="otp-message">

                        We've sent a verification code to your
                        email -

                        <strong id="loginOtpEmail"></strong>

                    </div>


                    <!-- OTP Form -->
                    <form id="loginOtpVerificationForm">

                        @csrf

                        <!-- Hidden Email -->
                        <input type="hidden"
                               name="login_email"
                               id="loginOtp_email">


                        <!-- OTP -->
                        <div class="mb-3">

                            <input type="text"
                                   name="login_otp"
                                   id="login_otp"
                                   class="form-control otp-input"
                                   placeholder="Enter verification code"
                                   maxlength="6"
                                   inputmode="numeric"
                                   autocomplete="one-time-code">

                        </div>


                        <!-- OTP Error -->
                        <div id="loginOtpError"
                             class="text-danger mb-3"
                             style="display:none;">
                        </div>


                        <!-- Submit -->
                        <button type="submit"
                                id="verifyLoginOtpBtn"
                                class="btn otp-submit-btn">

                            Submit

                        </button>

                    </form>


                    <!-- Timer -->
                    <div class="text-center mt-3">

                        <span id="LoginotpTimer">

                            Resend OTP in
                            <strong>60</strong>s

                        </span>


                        <button type="button"
                                id="resendLoginOtpBtn"
                                class="btn btn-link"
                                style="display:none;">

                            Resend OTP

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade"
     id="userRegistrationOtpModal"
     tabindex="-1"
     role="dialog"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Verify Email
                </h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>


            <div class="modal-body">

                <p class="text-center">
                    Enter the OTP sent to
                    <strong id="userRegistrationOtpEmail"></strong>
                </p>


                <form id="userRegistrationOtpForm">

                    @csrf

                    <input type="hidden"
                           id="userRegistrationEmail"
                           name="email">


                    <div class="form-group">

                        <label>
                            Enter OTP
                        </label>

                        <input type="text"
                               id="userRegistrationOtp"
                               name="otp"
                               class="form-control text-center"
                               maxlength="6"
                               inputmode="numeric"
                               required>

                        <div id="userRegistrationOtpError"
                             class="text-danger mt-2"
                             style="display:none;">
                        </div>

                    </div>


                    <button type="submit"
                            id="verifyUserRegistrationOtpBtn"
                            class="Primary-btn w-100">

                        Verify OTP

                    </button>

                </form>


                <div class="text-center mt-3">

                    <span id="userRegistrationOtpTimer">
                        Resend OTP in
                        <strong>60</strong>s
                    </span>

                    <a href="javascript:void(0);"
                       id="resendUserRegistrationOtp"
                       style="display:none;">

                        Resend OTP

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Registration Successful Modal -->
<div class="modal fade"
     id="registrationSuccessModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="registrationSuccessModalLabel"
     aria-hidden="true"
     data-backdrop="static"
     data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered"
         role="document">

        <div class="modal-content"
             style="
                border-radius: 10px;
                border: none;
                padding: 30px;
                text-align: center;
             ">
            <div class="modal-body">
                <!-- Success Icon -->
                <div class="success-icon">
                    ✓
                </div>
                <!-- Title -->
                <h3 id="registrationSuccessModalLabel"
                    class="mb-3">
                    Registration Successful!
                </h3>
                <!-- Message -->
                <p class="text-muted mb-3">
                    You have successfully completed your
                    registration.
                </p>

                <p class="mb-4">
                    Your login password has been sent to your
                    registered email address.
                    <br>
                    Please check your email to continue.
                </p>
                <!-- Dashboard Button -->
                <button type="button"
                        id="successDashboardBtn"
                        class="btn btn-primary"
                        style="
                            min-width: 180px;
                            padding: 12px 25px;
                        ">
                    Go to Dashboard
                </button>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function ($) {

    // Country -> State
    $(document).on('change', '.location-country', function () {

        let country = $(this).closest('form');

        let country_id = $(this).val();

        let state = country.find('.location-state');
        let district = country.find('.location-district');
        let city = country.find('.location-city');
        let area = country.find('.location-area');

        state.html('<option value="">Choose State</option>').prop('disabled', true);
        district.html('<option value="">Choose District</option>').prop('disabled', true);
        city.html('<option value="">Choose City</option>').prop('disabled', true);
        area.html('<option value="">Choose Area</option>').prop('disabled', true);

        if (!country_id) {
            return;
        }

        $.ajax({
            url: "{{ route('location.fetch') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "state",
                country_id: country_id
            },

            success: function (response) {

                if (response.success) {

                    $.each(response.status, function (key, value) {

                        state.append(
                            `<option value="${value.id}">
                                ${value.name}
                            </option>`
                        );

                    });

                    state.prop('disabled', false);
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

    });


    // State -> District
    $(document).on('change', '.location-state', function () {

        let form = $(this).closest('form');

        let country_id = form.find('.location-country').val();
        let state_id = $(this).val();

        let district = form.find('.location-district');
        let city = form.find('.location-city');
        let area = form.find('.location-area');

        district.html('<option value="">Choose District</option>').prop('disabled', true);
        city.html('<option value="">Choose City</option>').prop('disabled', true);
        area.html('<option value="">Choose Area</option>').prop('disabled', true);

        if (!state_id) {
            return;
        }

        $.ajax({
            url: "{{ route('location.fetch') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "district",
                country_id: country_id,
                state_id: state_id
            },

            success: function (response) {

                if (response.success) {

                    $.each(response.status, function (key, value) {

                        district.append(
                            `<option value="${value.id}">
                                ${value.district_name}
                            </option>`
                        );

                    });

                    district.prop('disabled', false);
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

    });


    // District -> City
    $(document).on('change', '.location-district', function () {

        let form = $(this).closest('form');

        let country_id = form.find('.location-country').val();
        let state_id = form.find('.location-state').val();
        let district_id = $(this).val();

        let city = form.find('.location-city');
        let area = form.find('.location-area');

        city.html('<option value="">Choose City</option>').prop('disabled', true);
        area.html('<option value="">Choose Area</option>').prop('disabled', true);

        if (!district_id) {
            return;
        }

        $.ajax({
            url: "{{ route('location.fetch') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "city",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id
            },

            success: function (response) {

                if (response.success) {

                    $.each(response.status, function (key, value) {

                        city.append(
                            `<option value="${value.id}">
                                ${value.name}
                            </option>`
                        );

                    });

                    city.prop('disabled', false);
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

    });


    // City -> Area
    $(document).on('change', '.location-city', function () {

        let form = $(this).closest('form');

        let country_id = form.find('.location-country').val();
        let state_id = form.find('.location-state').val();
        let district_id = form.find('.location-district').val();
        let city_id = $(this).val();

        let area = form.find('.location-area');

        area.html('<option value="">Choose Area</option>').prop('disabled', true);

        if (!city_id) {
            return;
        }

        $.ajax({
            url: "{{ route('location.fetch') }}",
            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "area",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id,
                city_id: city_id
            },

            success: function (response) {

                if (response.success) {

                    $.each(response.status, function (key, value) {

                        area.append(
                            `<option value="${value.id}">
                                ${value.area_name} - ${value.pincode}
                            </option>`
                        );

                    });

                    area.prop('disabled', false);
                }
            },

            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });

    });

});
</script>


<script>
    function loadStates(form, country_id, selectedState = null) {

        let state = form.find('.location-state');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "state",
                country_id: country_id
            }

        }).then(function (response) {

            state.html('<option value="">Choose State</option>');

            if (response.success) {

                $.each(response.status, function (key, value) {

                    state.append(
                        `<option value="${value.id}">
                            ${value.state_name}
                        </option>`
                    );

                });

                state.prop('disabled', false);

                if (selectedState) {
                    state.val(selectedState);
                }
            }

        });
    }

    function loadDistricts(form, country_id, state_id, selectedDistrict = null) {

        let district = form.find('.location-district');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "district",
                country_id: country_id,
                state_id: state_id
            }

        }).then(function (response) {

            district.html('<option value="">Choose District</option>');

            if (response.success) {

                $.each(response.status, function (key, value) {

                    district.append(
                        `<option value="${value.id}">
                            ${value.district_name}
                        </option>`
                    );

                });

                district.prop('disabled', false);

                if (selectedDistrict) {
                    district.val(selectedDistrict);
                }
            }

        });
    }

    function loadCities(
        form,
        country_id,
        state_id,
        district_id,
        selectedCity = null
    ) {

        let city = form.find('.location-city');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "city",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id
            }

        }).then(function (response) {

            city.html('<option value="">Choose City</option>');

            if (response.success) {

                $.each(response.status, function (key, value) {

                    city.append(
                        `<option value="${value.id}">
                            ${value.city_name}
                        </option>`
                    );

                });

                city.prop('disabled', false);

                if (selectedCity) {
                    city.val(selectedCity);
                }
            }

        });
    }

    function loadAreas(
        form,
        country_id,
        state_id,
        district_id,
        city_id,
        selectedArea = null
    ) {

        let area = form.find('.location-area');

        return $.ajax({

            url: "{{ route('location.fetch') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                type: "area",
                country_id: country_id,
                state_id: state_id,
                district_id: district_id,
                city_id: city_id
            }

        }).then(function (response) {

            area.html('<option value="">Choose Area</option>');

            if (response.success) {

                $.each(response.status, function (key, value) {

                    area.append(
                        `<option value="${value.id}">
                            ${value.area_name}
                        </option>`
                    );

                });

                area.prop('disabled', false);

                if (selectedArea) {
                    area.val(selectedArea);
                }
            }

        });
    }

    function restoreLocation(form, values) {

        let country_id = values.country;
        let state_id = values.state;
        let district_id = values.district;
        let city_id = values.city;
        let area_id = values.area;


        if (!country_id) {
            return;
        }


        loadStates(
            form,
            country_id,
            state_id
        )
        .then(function () {

            if (!state_id) {
                return;
            }

            return loadDistricts(
                form,
                country_id,
                state_id,
                district_id
            );

        })
        .then(function () {

            if (!district_id) {
                return;
            }

            return loadCities(
                form,
                country_id,
                state_id,
                district_id,
                city_id
            );

        })
        .then(function () {

            if (!city_id) {
                return;
            }

            return loadAreas(
                form,
                country_id,
                state_id,
                district_id,
                city_id,
                area_id
            );

        })
        .catch(function (error) {

            console.log(error);

        });
    }
</script>

<script>
$(document).ready(function () {

    @if(session('success'))
        toastr.success(@json(session('success')));
    @endif

    @if(session('error'))
        toastr.error(@json(session('error')));
    @endif


    @if($errors->any() && session('open_modal'))

        let modalId = @json(session('open_modal'));

        let modal = $('#' + modalId);

        if (modal.length) {

            // Open modal
            modal.modal('show');


            /*
            |--------------------------------------------------------------------------
            | PARTNER / AREA MANAGER
            |--------------------------------------------------------------------------
            */

            if (modalId === 'myModal') {

                let form = modal.find('form');

                restoreLocation(form, {

                    country: @json(old('partner_country_id')),
                    state: @json(old('partner_state_id')),
                    district: @json(old('partner_district_id')),
                    city: @json(old('partner_city_id')),
                    area: @json(old('partner_area_id'))

                });

            }


            /*
            |--------------------------------------------------------------------------
            | DRIVER
            |--------------------------------------------------------------------------
            */

            if (modalId === 'driverModal') {

                let form = modal.find('form');

                restoreLocation(form, {

                    country: @json(old('driver_country_id')),
                    state: @json(old('driver_state_id')),
                    district: @json(old('driver_district_id')),
                    city: @json(old('driver_city_id')),
                    area: @json(old('driver_area_id'))

                });

            }

        }

    @endif

});
</script>

<script>
$(document).ready(function () {
    @if(session('open_modal') === 'registerModal')
        // Open modal
        $('#registerModal').modal('show');
        @if(session('open_tab') === 'register')
            // Open SIGN UP tab
            $('#pills-home-tab').tab('show');
        @elseif(session('open_tab') === 'login')
            // Open LOGIN tab
            $('#pills-profile-tab').tab('show');
        @endif
    @endif
});
</script>

<script>
    $(document).ready(function () {
         $(document).on('submit', '#partnerRegistrationForm', function (e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);
            $('#registerBtn')
                .prop('disabled', true)
                .text('Sending OTP...');
            $.ajax({

                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status === true) {
                        $('#myModal').modal('hide');
                        $('#otpEmail')
                            .text(response.email);
                        $('#otp_email')
                            .val(response.email);
                        $('#otp')
                            .val('');
                        $('#otpError')
                            .hide()
                            .text('');
                        $('#otpModal').modal('show');
                        startOtpTimer();
                        if (typeof toastr !== 'undefined') {
                            toastr.success(
                                response.message
                            );
                        }
                    }
                },

                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors =
                            xhr.responseJSON.errors;
                        $.each(
                            errors,
                            function (field, messages) {
                                if (
                                    typeof toastr !==
                                    'undefined'
                                ) {
                                    toastr.error(
                                        messages[0]
                                    );
                                }
                            }
                        );
                    } else {
                        let message =
                            xhr.responseJSON?.message ??
                            'Something went wrong. Please try again.';
                        if (
                            typeof toastr !== 'undefined'
                        ) {
                            toastr.error(message);
                        } else {
                            alert(message);
                        }
                    }
                },

                complete: function () {
                    $('#registerBtn')
                        .prop('disabled', false)
                        .text('Sign Up');

                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#otpVerificationForm').on('submit', function (e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);

            $('#verifyOtpBtn')
                .prop('disabled', true)
                .text('Verifying...');

            $('#otpError')
                .hide()
                .text('');

            $.ajax({
                url: "{{ route('verify.otp') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status === true) {
                        clearInterval(
                            otpTimerInterval
                        );
                        $('#otpModal').modal('hide');
                        // if (typeof toastr !== 'undefined') {
                        //     toastr.success(
                        //         response.message
                        //     );
                        // }
                        window.registeredUserType = response.user_type;
                        window.redirectUserUrl = response.redirectUserUrl;
                        setTimeout(function () {
                            $('#registrationSuccessModal').modal({
                                backdrop: 'static',
                                keyboard: false
                            });
                            $('#registrationSuccessModal').modal('show');
                        }, 1000);
                    }
                },

                error: function (xhr) {
                    if (xhr.status === 422) {
                        let message =
                            xhr.responseJSON?.message ??
                            'Invalid OTP. Please try again.';
                        $('#otpError')
                            .text(message)
                            .show();
                        if (
                            typeof toastr !== 'undefined'
                        ) {
                            toastr.error(message);
                        }

                    } else {
                        let message =
                            xhr.responseJSON?.message ??
                            'Something went wrong. Please try again.';
                        $('#otpError')
                            .text(message)
                            .show();
                    }
                },
                complete: function () {
                    $('#verifyOtpBtn')
                        .prop('disabled', false)
                        .text('Submit');

                }
            });
        });

        $('#successDashboardBtn').on('click', function () {
            // Close success modal
            $('#registrationSuccessModal').modal('hide');
            // Redirect to dashboard
            // const userType = window.registeredUserType;

            // if (userType === 'area_manager') {
            //     window.location.href = "{{ route('manager.dashboard') }}";
            // } else {
            //     window.location.href = "{{ route('user.dashboard') }}";
            // }

            if (window.redirectUserUrl) {
                window.location.href = window.redirectUserUrl;
            } else {
                window.location.href = "{{ route('home.index') }}";
            }

        });
    });
</script>

<script>
    let otpTimerInterval;
    function startOtpTimer()
    {
        let seconds = 60;
        $('#otpTimer').show();
        $('#resendOtpBtn').hide();
        $('#otpTimer').html(
            'Resend OTP in <strong>' +
            seconds +
            '</strong>s'
        );

        clearInterval(otpTimerInterval);
        otpTimerInterval = setInterval(function () {

            seconds--;

            $('#otpTimer').html(
                'Resend OTP in <strong>' +
                seconds +
                '</strong>s'
            );

            if (seconds <= 0) {
                clearInterval(
                    otpTimerInterval
                );
                $('#otpTimer').hide();
                $('#resendOtpBtn').show();
            }
        }, 1000);
    }
</script>

<script>
$(document).ready(function () {
    $('#resendOtpBtn').on('click', function () {
        let email =
            $('#otp_email').val();
        if (!email) {
            toastr.error(
                'Email address not found.'
            );
            return;
        }

        $('#resendOtpBtn')
            .prop('disabled', true)
            .text('Sending...');

        $.ajax({
            url: "{{ route('resend.otp') }}",
            type: "POST",
            data: {
                _token:
                    $('meta[name="csrf-token"]').attr('content'),
                email: email
            },
            success: function (response) {
                if (response.status === true) {
                    toastr.success(
                        response.message
                    );
                    startOtpTimer();
                }
            },
            error: function (xhr) {
                let message =
                    xhr.responseJSON?.message ??
                    'Unable to resend OTP.';
                toastr.error(message);
            },
            complete: function () {
                $('#resendOtpBtn')
                    .prop('disabled', false)
                    .text('Resend OTP');

            }
        });
    });
});
</script>
<script>
$(document).ready(function () {

    // Check URL
    const urlParams = new URLSearchParams(window.location.search);
    const openLogin = urlParams.get('open_login');

    // Only run when email Login Now is clicked
    if (openLogin !== '1') {
        return;
    } 

    @auth
        @if(auth()->user()->user_type === 'area_manager')
            window.location.href = "{{ route('manager.dashboard') }}";
        @else
            window.location.href = "{{ route('user.dashboard') }}";
        @endif
    @else

        // Open the common register/login modal
        $('#registerModal').modal('show');

        // Activate LOGIN tab
        $('#pills-profile-tab').tab('show');

    @endauth

    /*
    |--------------------------------------------------------------------------
    | Remove ?open_login=1 from URL
    |--------------------------------------------------------------------------
    */

    const cleanUrl =
        window.location.origin +
        window.location.pathname;


    window.history.replaceState(
        {},
        document.title,
        cleanUrl
    );

});
</script>

<script>
$(document).ready(function () {
    // Show OTP login
    $('#showEmailOtpLogin').on('click', function () {

        $('#pills-profile form:first').hide();

        $('#emailOtpLoginBox').slideDown();

    });


    // Back to password login
    $('#backToPasswordLogin').on('click', function () {

        $('#emailOtpLoginBox').hide();

        $('#pills-profile form:first').slideDown();

    });


    // Password show/hide
    $('#toggleLoginPassword').on('click', function () {

        let passwordInput = $('#loginPassword');
        let icon = $(this).find('i');

        if (passwordInput.attr('type') === 'password') {

            passwordInput.attr('type', 'text');

            icon.removeClass('fa-eye-slash')
                .addClass('fa-eye');

        } else {

            passwordInput.attr('type', 'password');

            icon.removeClass('fa-eye')
                .addClass('fa-eye-slash');
        }

    });


    // Send OTP
    $('#emailOtpLoginForm').on('submit', function (e) {

        e.preventDefault();

        let email = $('#otpLoginEmail').val();
        let button = $('#sendLoginOtpBtn');

        $('#otpLoginEmailError')
            .hide()
            .text('');

        button.prop('disabled', true);
        button.text('Sending OTP...');

        $.ajax({
            url: "{{ route('login.send.otp') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: email
            },

            success: function (response) {

                button.prop('disabled', false);
                button.text('Send OTP');

        
                if (response.status) {
                    // Store email
                    $('#loginOtp_email').val(response.email);
                    // Show email inside OTP modal
                    $('#loginOtpEmail').text(response.email);
                    // Clear previous OTP
                    $('#login_otp').val('');
                    $('#loginOtpError')
                        .hide()
                        .text('');

                    // Hide login/register modal
                    $('#registerModal').modal('hide');
                    // Wait for previous modal to close
                    setTimeout(function () {
                        $('#loginOtpModal').modal('show');
                        // Start timer
                        if (typeof startLoginOtpTimer === 'function') {
                            startLoginOtpTimer();
                        }
                    }, 300);

                } else {
                    $('#otpLoginEmailError')
                        .text(response.message)
                        .show();
                }
            },
            error: function (xhr) {

                button.prop('disabled', false);
                button.text('Send OTP');

                let message =
                    'Something went wrong. Please try again.';

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    message = xhr.responseJSON.message;
                }

                $('#otpLoginEmailError')
                    .text(message)
                    .show();
            }

        });

    });

    $('#loginOtpVerificationForm').on('submit', function (e) {
        e.preventDefault();
        let form = this;
        let formData = new FormData(form);

        $('#verifyLoginOtpBtn')
            .prop('disabled', true)
            .text('Verifying...');

        $('#loginOtpError')
            .hide()
            .text('');

        $.ajax({
            url: "{{ route('login.verify.otp') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (response) {
                if (response.status === true) {
                    clearInterval(
                        loginotpTimerInterval
                    );
                    $('#loginOtpModal').modal('hide');

                    toastr.success(
                        response.message || 'Login successful!'
                    );

                    // Redirect after toast
                    setTimeout(function () {
                        if (response.redirectUserUrl) {
                            window.location.href = esponse.redirectUserUrl;
                        } else {
                            window.location.href = "{{ route('home.index') }}";
                        }

                    }, 1500); // 1.5 seconds
                
                }
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let message =
                        xhr.responseJSON?.message ??
                        'Invalid OTP. Please try again.';
                    $('#otpError')
                        .text(message)
                        .show();
                    if (
                        typeof toastr !== 'undefined'
                    ) {
                        toastr.error(message);
                    }

                } else {
                    let message =
                        xhr.responseJSON?.message ??
                        'Something went wrong. Please try again.';
                    $('#otpError')
                        .text(message)
                        .show();
                }
            },
            complete: function () {
                $('#verifyOtpBtn')
                    .prop('disabled', false)
                    .text('Submit');

            }
        });
    });

    $('#resendLoginOtpBtn').on('click', function () {
        let email =
            $('#loginOtp_email').val();
        if (!email) {
            toastr.error(
                'Email address not found.'
            );
            return;
        }

        $('#resendLoginOtpBtn')
            .prop('disabled', true)
            .text('Sending...');

        $.ajax({
            url: "{{ route('login.resend.otp') }}",
            type: "POST",
            data: {
                _token:
                    $('meta[name="csrf-token"]').attr('content'),
                email: email
            },
            success: function (response) {
                if (response.status === true) {
                    toastr.success(
                        response.message
                    );
                    startOtpTimer();
                }
            },
            error: function (xhr) {
                let message =
                    xhr.responseJSON?.message ??
                    'Unable to resend OTP.';
                toastr.error(message);
            },
            complete: function () {
                $('#resendLoginOtpBtn')
                    .prop('disabled', false)
                    .text('Resend OTP');

            }
        });
    });

});
</script>

<script>
    let loginotpTimerInterval;
    function startLoginOtpTimer()
    {
        let seconds = 60;
        $('#LoginotpTimer').show();
        $('#resendLoginOtpBtn').hide();
        $('#LoginotpTimer').html(
            'Resend OTP in <strong>' +
            seconds +
            '</strong>s'
        );

        clearInterval(loginotpTimerInterval);
        loginotpTimerInterval = setInterval(function () {

            seconds--;

            $('#LoginotpTimer').html(
                'Resend OTP in <strong>' +
                seconds +
                '</strong>s'
            );

            if (seconds <= 0) {
                clearInterval(
                    loginotpTimerInterval
                );
                $('#LoginotpTimer').hide();
                $('#resendLoginOtpBtn').show();
            }
        }, 1000);
    }
</script>

<script>
$(document).ready(function () {
    $('#userRegistrationForm').on('submit', function (e) {

        e.preventDefault();

        let form = this;

        let button = $('#userRegisterBtn');

        $('#userRegistrationError')
            .hide()
            .text('');

        button
            .prop('disabled', true)
            .text('Sending OTP...');


        $.ajax({

            url: "{{ route('user.register.send.otp') }}",

            type: "POST",

            data: $(form).serialize(),

            success: function (response) {

                console.log(
                    'Registration OTP response:',
                    response
                );

                button
                    .prop('disabled', false)
                    .text('Register');


                if (response.status === true) {

                    // Store email
                    $('#userRegistrationEmail')
                        .val(response.email);

                    // Display email
                    $('#userRegistrationOtpEmail')
                        .text(response.email);

                    // Clear OTP
                    $('#userRegistrationOtp')
                        .val('');

                    // Hide registration modal
                    $('#registerModal').modal('hide');


                    // Show OTP modal
                    setTimeout(function () {

                        $('#userRegistrationOtpModal')
                            .modal('show');

                        startUserRegistrationOtpTimer();

                    }, 300);

                } else {

                    $('#userRegistrationError')
                        .text(response.message)
                        .show();

                }

            },

            error: function (xhr) {

                button
                    .prop('disabled', false)
                    .text('Register');


                let message =
                    'Something went wrong. Please try again.';


                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {

                    message =
                        xhr.responseJSON.message;

                }


                $('#userRegistrationError')
                    .text(message)
                    .show();

            }

        });

    });

    $('#userRegistrationOtpForm').on('submit', function (e) {

        e.preventDefault();

        let button =
            $('#verifyUserRegistrationOtpBtn');


        button
            .prop('disabled', true)
            .text('Verifying...');


        $('#userRegistrationOtpError')
            .hide()
            .text('');


        $.ajax({

            url: "{{ route('user.register.verify.otp') }}",

            type: "POST",

            data: $(this).serialize(),


            success: function (response) {

                console.log(
                    'Registration verification:',
                    response
                );


                if (response.status === true) {

                    clearInterval(
                        userRegistrationOtpTimer
                    );


                    $('#userRegistrationOtpModal')
                        .modal('hide');


                    /*
                    |--------------------------------------------------------------------------
                    | Show success toast
                    |--------------------------------------------------------------------------
                    */

                    if (typeof toastr !== 'undefined') {

                        toastr.success(
                            response.message ||
                            'Registration successful!'
                        );

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Redirect after toast
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(function () {

                        if (
                            response.redirectUserUrl
                        ) {

                            window.location.href =
                                response.redirectUserUrl;

                        } else {

                            window.location.href =
                                "{{ route('user.dashboard') }}";

                        }

                    }, 1500);

                }

            },


            error: function (xhr) {

                let message =
                    'Invalid OTP. Please try again.';


                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {

                    message =
                        xhr.responseJSON.message;

                }


                $('#userRegistrationOtpError')
                    .text(message)
                    .show();


                if (typeof toastr !== 'undefined') {

                    toastr.error(message);

                }

            },


            complete: function () {

                button
                    .prop('disabled', false)
                    .text('Verify OTP');

            }

        });

    });

    $('#resendUserRegistrationOtp').on('click', function () {

        let button = $(this);
        let email = $('#userRegistrationEmail').val();
        if (!email) {
            $('#userRegistrationOtpError')
                .text('Email address is missing. Please register again.')
                .show();

            return;
        }

        button
            .css('pointer-events', 'none')
            .text('Sending...');

        $('#userRegistrationOtpError')
            .hide()
            .text('');

        $.ajax({

            url: "{{ route('user.register.resend.otp') }}",

            type: "POST",

            data: {
                _token: "{{ csrf_token() }}",
                email: email
            },

            success: function (response) {

                console.log('Resend OTP response:', response);

                if (response.status === true) {

                    $('#userRegistrationOtp').val('');

                    $('#userRegistrationOtpError')
                        .hide()
                        .text('');

                    if (typeof toastr !== 'undefined') {
                        toastr.success(
                            response.message || 'OTP has been resent successfully.'
                        );
                    }

                    startUserRegistrationOtpTimer();
                }
                else {

                    let message = response.message ||
                        'Unable to resend OTP. Please try again.';

                    $('#userRegistrationOtpError')
                        .text(message)
                        .show();

                    if (typeof toastr !== 'undefined') {
                        toastr.error(message);
                    }
                }
            },

            error: function (xhr) {

                let message = 'Unable to resend OTP. Please try again.';

                if (
                    xhr.responseJSON &&
                    xhr.responseJSON.message
                ) {
                    message = xhr.responseJSON.message;
                }

                $('#userRegistrationOtpError')
                    .text(message)
                    .show();

                if (typeof toastr !== 'undefined') {
                    toastr.error(message);
                }
            },

            complete: function () {

                button
                    .css('pointer-events', 'auto')
                    .text('Resend OTP');
            }
        });
    });
});
</script>
<script>
    let userRegistrationOtpTimer;

    function startUserRegistrationOtpTimer()
    {
        let seconds = 60;


        clearInterval(
            userRegistrationOtpTimer
        );


        $('#userRegistrationOtpTimer')
            .show();


        $('#resendUserRegistrationOtp')
            .hide();


        $('#userRegistrationOtpTimer').html(

            'Resend OTP in <strong>' +
            seconds +
            '</strong>s'

        );


        userRegistrationOtpTimer =
            setInterval(function () {

                seconds--;


                $('#userRegistrationOtpTimer').html(

                    'Resend OTP in <strong>' +
                    seconds +
                    '</strong>s'

                );


                if (seconds <= 0) {

                    clearInterval(
                        userRegistrationOtpTimer
                    );


                    $('#userRegistrationOtpTimer')
                        .hide();


                    $('#resendUserRegistrationOtp')
                        .show();

                }

            }, 1000);
    }
</script>

<script>
    $(document).ready(function () {
         $(document).on('submit', '#driverRegistrationForm', function (e) {
            e.preventDefault();
            let form = this;
            let formData = new FormData(form);
            $('#driverRegisterButton')
                .prop('disabled', true)
                .text('Sending OTP...');
            $.ajax({

                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,

                success: function (response) {
                    if (response.status === true) {
                        $('#driverModal').modal('hide');
                        $('#otpEmail')
                            .text(response.email);
                        $('#otp_email')
                            .val(response.email);
                        $('#otp')
                            .val('');
                        $('#otpError')
                            .hide()
                            .text('');
                        $('#otpModal').modal('show');
                        startOtpTimer();
                        if (typeof toastr !== 'undefined') {
                            toastr.success(
                                response.message
                            );
                        }
                    }
                },

                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors =
                            xhr.responseJSON.errors;
                        $.each(
                            errors,
                            function (field, messages) {
                                if (
                                    typeof toastr !==
                                    'undefined'
                                ) {
                                    toastr.error(
                                        messages[0]
                                    );
                                }
                            }
                        );
                    } else {
                        let message =
                            xhr.responseJSON?.message ??
                            'Something went wrong. Please try again.';
                        if (
                            typeof toastr !== 'undefined'
                        ) {
                            toastr.error(message);
                        } else {
                            alert(message);
                        }
                    }
                },

                complete: function () {
                    $('#driverRegisterButton')
                        .prop('disabled', false)
                        .text('Sign Up');

                }
            });
        });
    });
</script>