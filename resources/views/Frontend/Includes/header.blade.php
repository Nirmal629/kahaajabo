  <header class="mainheader_wrap" id="myHeader">
        <div class="cust_container">
            <div class="content_wrap">
                <a href="#" class="logo_wrap">
                    <img src="{{ asset('Frontend/Assets/images/logo1.png') }}" class="img-fluid" alt="logo" />
                </a>
                <!-- 
                <ul class="navlist">
                    <li class="navlink"><a href="#">Home</a></li>
                    <li class="navlink"><a href="#">About</a></li>
                    <li class="navlink"><a href="#">Blog</a></li>
                    <li class="navlink"><a href="#">Contact us</a></li>
                </ul> -->
                <div class=" align-items-center right-part">
                    <button type="button" class="Primary-btn" data-toggle="modal" data-target="#myModal">Register as a
                        Partner</button>
                    
                    <button class="Primary-btn" data-toggle="modal" data-target="#carModal">Register your Car</button>
                    
                    <button class="Primary-btn" data-toggle="modal" data-target="#driverModal">Register as a
                        Driver</button>
                    
                    <button class="Primary-btn" data-toggle="modal" data-target="#bookingModal"><i
                            class="fa-solid fa-phone mr-2"></i>Request a Call</button>

                    @if(Auth::check())

                        <a href="{{ route('user.dashboard') }}">
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
                <form method="POST"
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
                    <!-- Country -->
                    <div class="form-group">
                        <label>Country</label>

                        <select id="partner_country_id"
                                name="partner_country_id"
                                class="form-control location-country">

                            <option value="">Choose Country</option>

                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('partner_country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('partner_country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- State -->
                    <div class="form-group">
                        <label>State</label>

                        <select id="partner_state_id"
                                name="partner_state_id"
                                class="form-control location-state"
                                disabled>

                            <option value="">Choose State</option>

                        </select>

                        @error('partner_state_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- District -->
                    <div class="form-group">
                        <label>District</label>

                        <select id="partner_district_id"
                                name="partner_district_id"
                                class="form-control location-district"
                                disabled>

                            <option value="">Choose District</option>

                        </select>

                        @error('partner_district_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- City -->
                    <div class="form-group">
                        <label>City Of Operation</label>

                        <select id="partner_city_id"
                                name="partner_city_id"
                                class="form-control location-city"
                                disabled>

                            <option value="">Choose City</option>

                        </select>

                        @error('partner_city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Area</label>

                        <select id="partner_area_id"
                                name="partner_area_id"
                                class="form-control location-area"
                                disabled>

                            <option value="">Choose Area..</option>

                        </select>

                        @error('partner_area_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
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
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
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
                    </div>

                    <button type="submit"
                            class="Primary-btn m-auto d-table">
                        Submit
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
                <form method="POST"
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
                    <!-- Country -->
                    <div class="form-group">
                        <label>Country</label>

                        <select id="driver_country_id"
                                name="driver_country_id"
                                class="form-control location-country">

                            <option value="">Choose Country</option>

                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ old('driver_country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->country_name }}
                                </option>
                            @endforeach

                        </select>

                        @error('driver_country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- State -->
                    <div class="form-group">
                        <label>State</label>

                        <select id="driver_state_id"
                                name="driver_state_id"
                                class="form-control location-state"
                                disabled>

                            <option value="">Choose State</option>

                        </select>

                        @error('driver_state_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- District -->
                    <div class="form-group">
                        <label>District</label>

                        <select id="driver_district_id"
                                name="driver_district_id"
                                class="form-control location-district"
                                disabled>

                            <option value="">Choose District</option>

                        </select>

                        @error('driver_district_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- City -->
                    <div class="form-group">
                        <label>City Of Operation</label>

                        <select id="driver_city_id"
                                name="driver_city_id"
                                class="form-control location-city"
                                disabled>

                            <option value="">Choose City</option>

                        </select>

                        @error('driver_city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Area</label>

                        <select id="driver_area_id"
                                name="driver_area_id"
                                class="form-control location-area"
                                disabled>

                            <option value="">Choose Area..</option>

                        </select>

                        @error('driver_area_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <button type="submit"
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
<div class="modal fade" id="registerModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">


                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="pills-home-tab" data-toggle="pill"
                            href="#pills-home" role="tab" aria-controls="pills-home"
                            aria-selected="true">
                            <h4 class="modal-title">SIGN UP</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill"
                            href="#pills-profile" role="tab" aria-controls="pills-profile"
                            aria-selected="false">
                            <h4 class="modal-title">LOGIN</h4>
                        </a>
                    </li>

                </ul>
                <button type="button" class="close" data-dismiss="modal"><i
                        class="fa-solid fa-x"></i></button>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <form action="{{ route('user.register') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Name *</label>

                                <div class="row">
                                    <div class="col">
                                        <input type="text"
                                            name="first_name"
                                            class="form-control @error('first_name', 'registration') is-invalid @enderror"
                                            placeholder="First name"
                                            value="{{ old('first_name') }}"
                                            required>

                                        @error('first_name', 'registration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <input type="text"
                                            name="middle_name"
                                            class="form-control @error('middle_name', 'registration') is-invalid @enderror"
                                            placeholder="Middle name"
                                            value="{{ old('middle_name') }}">

                                        @error('middle_name', 'registration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <input type="text"
                                            name="last_name"
                                            class="form-control @error('last_name', 'registration') is-invalid @enderror"
                                            placeholder="Last name"
                                            value="{{ old('last_name') }}"
                                            required>

                                        @error('last_name', 'registration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email address *</label>

                                <input type="email"
                                    name="email"
                                    class="form-control @error('email', 'registration') is-invalid @enderror"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}"
                                    required>

                                @error('email', 'registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Primary Mobile No *</label>

                                <input type="text"
                                    name="primary_mobile"
                                    class="form-control @error('primary_mobile', 'registration') is-invalid @enderror"
                                    placeholder="Enter your mobile no"
                                    value="{{ old('primary_mobile') }}"
                                    maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    required>

                                @error('primary_mobile', 'registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Secondary Mobile No</label>

                                <input type="text"
                                    name="secondary_mobile"
                                    class="form-control @error('secondary_mobile', 'registration') is-invalid @enderror"
                                    placeholder="Enter your secondary mobile no"
                                    value="{{ old('secondary_mobile') }}"
                                    maxlength="10"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                    >

                                @error('secondary_mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address *</label>

                                <input type="text"
                                    name="address"
                                    class="form-control @error('address', 'registration') is-invalid @enderror"
                                    placeholder="Enter your address"
                                    value="{{ old('address') }}"
                                    required>

                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Password *</label>

                                <input type="password"
                                    name="password"
                                    class="form-control @error('password', 'registration') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required>

                                @error('password', 'registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Confirm Password *</label>

                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control @error('password_confirmation', 'registration') is-invalid @enderror"
                                    placeholder="Confirm your password"
                                    required>

                                @error('password_confirmation', 'registration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="Primary-btn m-auto d-table">
                                Register
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        @if(session('login_error'))
                            <div class="alert alert-danger">
                                {{ session('login_error') }}
                            </div>
                        @endif

                        <form action="{{ route('user.login') }}" method="POST">
                            @csrf
                            {{-- <div class="form-group">
                                <label for="exampleInputEmail1">Username*</label>
                                <input type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter Username">
                            </div> --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email*</label>
                                <input type="email"
                                    name="login_email"
                                    class="form-control @error('login_email', 'login') is-invalid @enderror"
                                    placeholder="Enter Email"
                                    value="{{ old('login_email') }}"
                                    required>

                                @error('login_email', 'login')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password*</label>
                                <input type="password"
                                    name="login_password"
                                    class="form-control @error('login_password', 'login') is-invalid @enderror"
                                    placeholder="Password"
                                    required>

                                @error('login_password', 'login')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="Primary-btn m-auto d-table">Sign
                                in</button>
                            <p class="forget_password"><a href="#">Forgot password?</a></p>
                        </form>
                    </div>
                </div>

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

    /*
    |--------------------------------------------------------------------------
    | SUCCESS TOAST
    |--------------------------------------------------------------------------
    */

    @if(session('success'))
        toastr.success(@json(session('success')));
    @endif


    /*
    |--------------------------------------------------------------------------
    | NORMAL ERROR TOAST
    |--------------------------------------------------------------------------
    */

    @if(session('error'))
        toastr.error(@json(session('error')));
    @endif


    /*
    |--------------------------------------------------------------------------
    | VALIDATION ERROR
    |--------------------------------------------------------------------------
    | Validation errors will NOT show in toastr.
    | The appropriate modal will open instead.
    |--------------------------------------------------------------------------
    */

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