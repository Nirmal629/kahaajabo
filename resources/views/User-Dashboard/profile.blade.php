@extends('User-Dashboard.Layouts.App')

@section('main-content')

<style>
    .profile-page {
        padding: 25px 0 40px;
        color: #334155;
    }

    .ProfilepageTitle {
        font-size: 26px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .profile-subtitle {
        color: #64748b;
        font-size: 14px;
        margin-bottom: 25px;
    }

    .user-details,
    .user_form,
    .password-card {
        background: #fff;
        border: 1px solid #e7edf5;
        border-radius: 15px;
        box-shadow: 0 4px 18px rgba(31, 45, 61, 0.055);
    }

    .user-details {
        padding: 25px 18px;
        text-align: center;
        position: sticky;
        top: 20px;
    }

    .profile_img {
        width: 115px;
        height: 115px;
        padding: 4px;
        margin: 0 auto 17px;
        border-radius: 50%;
        background: linear-gradient(135deg, #dbeafe, #eff6ff);
    }

    .profile_img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
    }

    .DetailsData h4 {
        font-size: 21px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .DetailsData h6 {
        display: inline-block;
        padding: 6px 18px;
        border-radius: 20px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .profile-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
        padding-top: 18px;
        border-top: 1px solid #edf1f7;
    }

    .choose_image,
    .action_btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        padding: 9px 11px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none !important;
    }

    .choose_image {
        color: #2563eb;
        background: #eff6ff;
        border-color: #dbeafe;
    }

    .action_btn.upload {
        color: #fff;
        background: #2563eb;
    }

    .action_btn.delete {
        color: #dc2626;
        background: #fff1f2;
        border-color: #fecdd3;
    }

    .user_form,
    .password-card {
        padding: 25px;
    }

    .form-section {
        margin-bottom: 26px;
    }

    .form-section h4,
    .password-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1e293b;
        font-size: 17px;
        font-weight: 700;
        padding-bottom: 14px;
        margin-bottom: 19px;
        border-bottom: 1px solid #edf1f7;
    }

    .form-section h4 i,
    .password-heading i {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 33px;
        height: 33px;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 15px;
    }

    .user_form label,
    .password-card label {
        display: block;
        margin-bottom: 8px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .user_form label span,
    .password-card label span {
        color: #ef4444;
    }

    .user_form .form-control,
    .password-card .form-control {
        height: 44px;
        padding: 10px 12px;
        border: 1px solid #dbe3ee;
        border-radius: 8px;
        background: #fff;
        color: #334155;
        font-size: 14px;
        box-shadow: none;
    }

    .user_form .form-control:focus,
    .password-card .form-control:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .10);
    }

    .field-row {
        margin-bottom: 17px;
    }

    .toggle-group {
        display: inline-flex;
        gap: 3px;
        padding: 4px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 9px;
    }

    .toggle-btn {
        min-width: 55px;
        padding: 8px 14px;
        border: 0;
        border-radius: 6px;
        background: transparent;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .toggle-btn.active {
        color: #2563eb;
        background: #fff;
        box-shadow: 0 1px 4px rgba(15, 23, 42, .12);
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        margin-top: 20px;
        border-top: 1px solid #edf1f7;
    }

    .btn-profile,
    .btn-password {
        padding: 11px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-reset {
        background: #fff;
        border: 1px solid #dbe3ee;
        color: #475569;
    }

    .btn-save,
    .btn-password {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .btn-save:hover,
    .btn-password:hover {
        color: #fff;
        background: #1d4ed8;
    }

    .password-card {
        margin-top: 22px;
    }

    .password-description {
        font-size: 13px;
        color: #64748b;
        margin-top: -8px;
        margin-bottom: 20px;
    }

    .password-input-wrap {
        position: relative;
    }

    .password-input-wrap .form-control {
        padding-right: 42px;
    }

    .password-eye {
        position: absolute;
        right: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        cursor: pointer;
        z-index: 2;
    }

    .password-error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 5px;
    }

    @media (max-width: 991px) {
        .user-details {
            position: static;
            margin-bottom: 22px;
        }
    }

    @media (max-width: 575px) {
        .ProfilepageTitle {
            font-size: 22px;
        }

        .user_form,
        .password-card {
            padding: 18px 14px;
        }

        .user_form .row > [class*="col-"] {
            margin-bottom: 15px;
        }

        .form-section h4,
        .password-heading {
            font-size: 15px;
        }

        .form-footer {
            flex-wrap: wrap;
        }
    }
</style>

<div class="container-fluid profile-page">

    <div class="page_Title">
        <h2 class="ProfilepageTitle">Profile Settings</h2>
        <p class="profile-subtitle">
            Manage your personal information and account security.
        </p>
    </div>

    {{-- Success messages --}}
    @if(session('profile_success'))
        <div class="alert alert-success">
            {{ session('profile_success') }}
        </div>
    @endif

    @if(session('password_success'))
        <div class="alert alert-success">
            {{ session('password_success') }}
        </div>
    @endif

    <div class="employeeDetails">
        <div class="row">

            {{-- Profile Card --}}
            <div class="col-lg-4 col-md-4 col-12">

                <div class="user-details">

                    <div class="profile_img">
                        <img id="profilePreview"
                             src="{{ Auth::user()?->profile_picture
                                ? asset('storage/' . Auth::user()?->profile_picture)
                                : asset('Assets/images/image1.jpg') }}"
                             class="img-fluid"
                             alt="Profile photo">
                    </div>

                    <div class="DetailsData">

                        <h4>{{ Auth::user()?->name }}</h4>

                        <h6>Passenger</h6>

                        <form id="profileImageForm"
                              action="{{ route('user.profile.image.update') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf

                            <input type="file"
                                   id="profileImage"
                                   name="profile_image"
                                   accept="image/jpeg,image/png,image/webp"
                                   hidden>

                            <div class="profile-actions">

                                <label for="profileImage"
                                       class="choose_image mb-0">
                                    <i class="fa-regular fa-images"></i>
                                    Choose
                                </label>

                                <button type="submit"
                                        class="action_btn upload">
                                    <i class="fa-solid fa-upload"></i>
                                    Upload
                                </button>

                                <button type="button"
                                        class="action_btn delete"
                                        id="deleteImage">
                                    <i class="fa-solid fa-trash"></i>
                                    Delete
                                </button>

                            </div>

                        </form>

                        @error('profile_image')
                            <div class="password-error">{{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>

            {{-- Profile Information --}}
            <div class="col-lg-8 col-md-8 col-12">

                <div class="user_form">

                    <form action="{{ route('user.profile.update') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        {{-- Account Details --}}
                        <div class="form-section">

                            <h4>
                                <i class="fa-solid fa-circle-user"></i>
                                Account Details
                            </h4>

                            <div class="row field-row">

                                <div class="col-md-6">
                                    <label for="full_name">
                                        Full Name <span>*</span>
                                    </label>

                                    <input type="text"
                                           id="full_name"
                                           name="name"
                                           class="form-control"
                                           value="{{ old('name', Auth::user()?->name) }}"
                                           required>

                                    @error('name')
                                        <div class="password-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email">
                                        Email Address <span>*</span>
                                    </label>

                                    <input type="email"
                                           id="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email', Auth::user()?->email) }}"
                                           required>

                                    @error('email')
                                        <div class="password-error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row field-row">

                                <div class="col-md-6">
                                    <label for="phone_number">
                                        Mobile Number <span>*</span>
                                    </label>

                                    <input type="tel"
                                           id="phone_number"
                                           name="phone_number"
                                           class="form-control"
                                           value="{{ old('phone_number', Auth::user()?->phone_number) }}"
                                           required>

                                    @error('phone_number')
                                        <div class="password-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="alternate_phone">
                                        Alternate Contact Number
                                    </label>

                                    <input type="tel"
                                           id="alternate_phone"
                                           name="alternate_phone"
                                           class="form-control"
                                           value="{{ old('alternate_phone', Auth::user()?->alternate_phone) }}">

                                    @error('alternate_phone')
                                        <div class="password-error">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="gender">Gender</label>

                                    <select id="gender"
                                            name="gender"
                                            class="form-control">
                                        <option value="">Select gender</option>
                                        <option value="male"
                                            @selected(old('gender', Auth::user()?->gender) == 'male')>
                                            Male
                                        </option>
                                        <option value="female"
                                            @selected(old('gender', Auth::user()?->gender) == 'female')>
                                            Female
                                        </option>
                                        <option value="other"
                                            @selected(old('gender', Auth::user()?->gender) == 'other')>
                                            Other
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="date_of_birth">Date Of Birth</label>

                                    <input type="date"
                                           id="date_of_birth"
                                           name="date_of_birth"
                                           class="form-control"
                                           value="{{ old('date_of_birth', Auth::user()?->date_of_birth) }}">
                                </div>

                            </div>

                        </div>

                        {{-- Ride Preferences --}}
                        <div class="form-section">

                            <h4>
                                <i class="fa-solid fa-sliders"></i>
                                Ride Preferences &amp; Settings
                            </h4>

                            <div class="row field-row">

                                <div class="col-md-6">
                                    <label for="payment_method">
                                        Preferred Payment Method
                                    </label>

                                    <select id="payment_method"
                                            name="preferred_payment_method"
                                            class="form-control">
                                        <option value="">Select payment method</option>
                                        <option value="cash"
                                            @selected(old('preferred_payment_method', Auth::user()?->preferred_payment_method) == 'cash')>
                                            Cash
                                        </option>
                                        <option value="upi"
                                            @selected(old('preferred_payment_method', Auth::user()?->preferred_payment_method) == 'upi')>
                                            UPI
                                        </option>
                                        <option value="card"
                                            @selected(old('preferred_payment_method', Auth::user()?->preferred_payment_method) == 'card')>
                                            Credit/Debit Card
                                        </option>
                                        <option value="wallet"
                                            @selected(old('preferred_payment_method', Auth::user()?->preferred_payment_method) == 'wallet')>
                                            Wallet
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="currency">Preferred Currency</label>

                                    <select id="currency"
                                            name="currency"
                                            class="form-control">
                                        <option value="INR"
                                            @selected(old('currency', Auth::user()?->currency) == 'INR')>
                                            INR (₹)
                                        </option>
                                        <option value="USD"
                                            @selected(old('currency', Auth::user()?->currency) == 'USD')>
                                            USD ($)
                                        </option>
                                        <option value="EUR"
                                            @selected(old('currency', Auth::user()?->currency) == 'EUR')>
                                            EUR (€)
                                        </option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="preferred_language">
                                        Preferred Language
                                    </label>

                                    <select id="preferred_language"
                                            name="preferred_language"
                                            class="form-control">
                                        <option value="en"
                                            @selected(old('preferred_language', Auth::user()?->preferred_language) == 'en')>
                                            English
                                        </option>
                                        <option value="bn"
                                            @selected(old('preferred_language', Auth::user()?->preferred_language) == 'bn')>
                                            Bengali
                                        </option>
                                        <option value="hi"
                                            @selected(old('preferred_language', Auth::user()?->preferred_language) == 'hi')>
                                            Hindi
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="time_zone">Time Zone</label>

                                    <select id="time_zone"
                                            name="time_zone"
                                            class="form-control">
                                        <option value="Asia/Kolkata"
                                            @selected(old('time_zone', Auth::user()?->time_zone) == 'Asia/Kolkata')>
                                            Asia/Kolkata (IST)
                                        </option>
                                        <option value="UTC"
                                            @selected(old('time_zone', Auth::user()?->time_zone) == 'UTC')>
                                            UTC
                                        </option>
                                    </select>
                                </div>

                            </div>

                        </div>

                        {{-- Location --}}
                        <div class="form-section">

                            <h4>
                                <i class="fa-solid fa-map-location-dot"></i>
                                Location Information
                            </h4>

                            <div class="row field-row">

                                <div class="col-md-6">
                                    <label for="country">Country</label>

                                    <input type="text"
                                           id="country"
                                           name="country"
                                           class="form-control"
                                           value="{{ old('country', Auth::user()?->country) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="state">State / Province</label>

                                    <input type="text"
                                           id="state"
                                           name="state"
                                           class="form-control"
                                           value="{{ old('state', Auth::user()?->state) }}">
                                </div>

                            </div>

                            <div class="row field-row">

                                <div class="col-md-6">
                                    <label for="city">City</label>

                                    <input type="text"
                                           id="city"
                                           name="city"
                                           class="form-control"
                                           value="{{ old('city', Auth::user()?->city) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="area">Area / Locality</label>

                                    <input type="text"
                                           id="area"
                                           name="area"
                                           class="form-control"
                                           value="{{ old('area', Auth::user()?->area) }}">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-12">
                                    <label for="pickup_address">
                                        Default Pickup Address
                                    </label>

                                    <input type="text"
                                           id="pickup_address"
                                           name="pickup_address"
                                           class="form-control"
                                           value="{{ old('pickup_address', Auth::user()?->pickup_address) }}">
                                </div>

                            </div>

                        </div>

                        {{-- Permissions --}}
                        <div class="form-section">

                            <h4>
                                <i class="fa-solid fa-shield-halved"></i>
                                Permissions &amp; Privacy
                            </h4>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Email Notifications</label>

                                    <div class="toggle-group">

                                        <button type="button"
                                                class="toggle-btn {{ old('email_notifications', Auth::user()?->email_notifications ?? 1) == 1 ? 'active' : '' }}"
                                                data-group="email_notifications"
                                                data-value="1">
                                            Yes
                                        </button>

                                        <button type="button"
                                                class="toggle-btn {{ old('email_notifications', Auth::user()?->email_notifications ?? 1) == 0 ? 'active' : '' }}"
                                                data-group="email_notifications"
                                                data-value="0">
                                            No
                                        </button>

                                    </div>

                                    <input type="hidden"
                                           name="email_notifications"
                                           id="email_notifications"
                                           value="{{ old('email_notifications', Auth::user()?->email_notifications ?? 1) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Ride Updates &amp; SMS Notifications</label>

                                    <div class="toggle-group">

                                        <button type="button"
                                                class="toggle-btn {{ old('ride_notifications', Auth::user()?->ride_notifications ?? 1) == 1 ? 'active' : '' }}"
                                                data-group="ride_notifications"
                                                data-value="1">
                                            Yes
                                        </button>

                                        <button type="button"
                                                class="toggle-btn {{ old('ride_notifications', Auth::user()?->ride_notifications ?? 1) == 0 ? 'active' : '' }}"
                                                data-group="ride_notifications"
                                                data-value="0">
                                            No
                                        </button>

                                    </div>

                                    <input type="hidden"
                                           name="ride_notifications"
                                           id="ride_notifications"
                                           value="{{ old('ride_notifications', Auth::user()?->ride_notifications ?? 1) }}">
                                </div>

                            </div>

                        </div>

                        <div class="form-footer">

                            <button type="reset"
                                    class="btn-profile btn-reset">
                                Reset
                            </button>

                            <button type="submit"
                                    class="btn-profile btn-save">
                                <i class="fa-solid fa-floppy-disk mr-1"></i>
                                Save Changes
                            </button>

                        </div>

                    </form>

                </div>

                {{-- Separate Change Password Form --}}
                <div class="password-card">

                    <h4 class="password-heading">
                        <i class="fa-solid fa-lock"></i>
                        Change Password
                    </h4>

                    <p class="password-description">
                        Update your password to help keep your account secure.
                    </p>

                    <form action="{{ route('user.password.update') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label for="current_password">
                                    Current Password <span>*</span>
                                </label>

                                <div class="password-input-wrap">
                                    <input type="password"
                                           id="current_password"
                                           name="current_password"
                                           class="form-control"
                                           autocomplete="current-password"
                                           required>

                                    <i class="fa-regular fa-eye password-eye"
                                       data-target="current_password"></i>
                                </div>

                                @error('current_password')
                                    <div class="password-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="new_password">
                                    New Password <span>*</span>
                                </label>

                                <div class="password-input-wrap">
                                    <input type="password"
                                           id="new_password"
                                           name="new_password"
                                           class="form-control"
                                           autocomplete="new-password"
                                           required>

                                    <i class="fa-regular fa-eye password-eye"
                                       data-target="new_password"></i>
                                </div>

                                @error('new_password')
                                    <div class="password-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="new_password_confirmation">
                                    Confirm New Password <span>*</span>
                                </label>

                                <div class="password-input-wrap">
                                    <input type="password"
                                           id="new_password_confirmation"
                                           name="new_password_confirmation"
                                           class="form-control"
                                           autocomplete="new-password"
                                           required>

                                    <i class="fa-regular fa-eye password-eye"
                                       data-target="new_password_confirmation"></i>
                                </div>
                            </div>

                        </div>

                        <div class="form-footer">

                            <button type="submit" class="btn-password">
                                <i class="fa-solid fa-shield-halved mr-1"></i>
                                Update Password
                            </button>

                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Yes / No notification toggles
    document.querySelectorAll('.toggle-btn').forEach(function (button) {

        button.addEventListener('click', function () {

            const group = this.dataset.group;
            const value = this.dataset.value;

            document.querySelectorAll(
                '.toggle-btn[data-group="' + group + '"]'
            ).forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');

            document.getElementById(group).value = value;
        });

    });

    // Show / hide password
    document.querySelectorAll('.password-eye').forEach(function (icon) {

        icon.addEventListener('click', function () {

            const input = document.getElementById(this.dataset.target);

            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }

        });

    });

    // Profile image preview
    const imageInput = document.getElementById('profileImage');
    const imagePreview = document.getElementById('profilePreview');

    if (imageInput && imagePreview) {

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                alert('Please select a JPG, PNG or WEBP image.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('Profile image must be 2 MB or smaller.');
                this.value = '';
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
        });

    }

});
</script>

@endsection
