@extends('Manager-Dashboard.Layouts.App')

@section('main-content')
    <?php
    $passwordTabActive = $errors->has('current_password') || $errors->has('password');
    ?>


    <div class="container-fluid">
        <div class="page_Title">
            <h2 class="ProfilepageTitle mt-3">Profile Settings</h2>
        </div>
        <div class="employeeDetails">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="user-details">

                        <div class="profile_img">
                            <img src="{{ Auth::user()->profile_picture
                                ? asset('storage/' . Auth::user()->profile_picture)
                                : asset('Frontend/Assets/images/default-profile.png') }}"
                                class="img-fluid" id="profilePreview" alt="Profile Image">
                        </div>

                        <div class="DetailsData">

                            <h4 class="mb-3">{{ Auth::user()->name }}</h4>
                            {{-- <h6>{{ Auth::user()->user_type ?? 'User' }}</h6> --}}

                            <div class="d-flex justify-content-center align-items-center">

                                <input type="file" id="profileImageInput" accept="image/jpeg,image/png,image/webp"
                                    hidden>

                                <a href="javascript:void(0)" class="choose_image"
                                    onclick="document.getElementById('profileImageInput').click()">
                                    <i class="fa-regular fa-images"></i> Choose
                                </a>

                                <button type="button" class="action_btn upload" id="uploadProfileImage">
                                    <i class="fa-solid fa-upload"></i> Upload
                                </button>

                                <button type="button" class="action_btn delete" id="deleteProfileImage">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="user_form profile-tabs-wrapper">

                        <!-- TAB NAVIGATION -->
                        <ul class="nav nav-tabs profile-nav-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ !$passwordTabActive ? 'active' : '' }}" id="profile-tab"
                                    data-toggle="tab" href="#profileDetails" role="tab">

                                    <i class="fa-solid fa-circle-user"></i>
                                    Profile Details

                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ $passwordTabActive ? 'active' : '' }}" id="password-tab"
                                    data-toggle="tab" href="#changePassword" role="tab">

                                    <i class="fa-solid fa-lock"></i>
                                    Change Password

                                </a>
                            </li>
                        </ul>

                        <div class="tab-content profile-tab-content">

                            <!-- ================================= -->
                            <!-- PROFILE DETAILS TAB -->
                            <!-- ================================= -->

                            <div class="tab-pane fade {{ !$passwordTabActive ? 'show active' : '' }}" id="profileDetails"
                                role="tabpanel">

                                <form method="POST" id="mandatoryForm" action="{{ route('manager.profile.update') }}"
                                    enctype="multipart/form-data">

                                    @csrf
                                    @method('PUT')

                                    <!-- ACCOUNT DETAILS -->
                                    <div class="mb-3">
                                        <h4><i class="fa-solid fa-circle-user"></i> Account Details</h4>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>Name <span>*</span></label>
                                                <input type="text" class="form-control" name="first_name"
                                                    value="{{ old('first_name', Auth::user()->first_name) }}"
                                                    placeholder="First Name">
                                            </div>

                                            <div class="col-md-6">
                                                <label>&nbsp;</label>
                                                <input type="text" class="form-control" name="last_name"
                                                    value="{{ old('last_name', Auth::user()->last_name) }}"
                                                    placeholder="Last Name">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>Email <span>*</span></label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Mobile No <span>*</span></label>
                                                <input type="text" class="form-control" maxlength="10"
                                                    name="phone_number"
                                                    value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    placeholder="Primary Mobile No">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- LOCATION INFORMATION -->
                                    <div class="mb-3">
                                        <h4><i class="fa-solid fa-map-location-dot"></i> Location Information</h4>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label>Country <span>*</span></label>
                                                <select name="country_id" class="form-control location-country" required>
                                                    <option value="">Choose Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}"
                                                            {{ old('country_id', Auth::user()->country_id) == $country->id ? 'selected' : '' }}>
                                                            {{ $country->country_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label>State <span>*</span></label>
                                                <select name="state_id" class="form-control location-state" disabled
                                                    required>
                                                    <option value="">Choose State</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label>District <span>*</span></label>
                                                <select name="district_id" class="form-control location-district" disabled
                                                    required>
                                                    <option value="">Choose District</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label>City <span>*</span></label>
                                                <select name="city_id" class="form-control location-city" disabled
                                                    required>
                                                    <option value="">Choose City</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Area <span>*</span></label>
                                                <select name="area_id" class="form-control location-area" disabled
                                                    required>
                                                    <option value="">Choose Area</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Complete Address</label>
                                                <textarea name="complete_address" rows="3" class="form-control">{{ old('complete_address', $external_user->complete_address) }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- IDENTITY & DOCUMENT INFORMATION -->
                                    <div class="mb-3 mt-4">
                                        <h4><i class="fa-solid fa-id-card"></i> Identity & Document Information</h4>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Aadhaar Number</label>
                                                <input type="text" name="aadhar_card_number" maxlength="12"
                                                    inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                    class="form-control" placeholder="Enter 12-digit Aadhaar Number"
                                                    value="{{ old('aadhar_card_number', $external_user->aadhar_card_number) }}">
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label">Aadhaar Card Document</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="file" name="aadhar_card_file" class="form-control"
                                                        accept=".pdf,.jpg,.jpeg,.png">

                                                    @if ($external_user->aadhar_card_file)
                                                        <a href="{{ asset('uploads/area-manager/' . $external_user->aadhar_card_file) }}"
                                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                                            <i class="bx bx-show"></i> View
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-secondary text-nowrap" disabled>
                                                            No File
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">PAN Number</label>
                                                <input type="text" name="pan_card_number" maxlength="10"
                                                    class="form-control text-uppercase" placeholder="Enter PAN Number"
                                                    value="{{ old('pan_card_number', $external_user->pan_card_number) }}">
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label">PAN Card Document</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="file" name="pan_card_file" class="form-control"
                                                        accept=".pdf,.jpg,.jpeg,.png">

                                                    @if ($external_user->pan_card_file)
                                                        <a href="{{ asset('uploads/area-manager/' . $external_user->pan_card_file) }}"
                                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                                            <i class="bx bx-show"></i> View
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-secondary text-nowrap" disabled>
                                                            No File
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <small class="text-muted">
                                            <i class="fa-solid fa-circle-info"></i>
                                            Accepted formats: PDF, JPG, JPEG and PNG.
                                        </small>
                                    </div>

                                    <hr>

                                    <!-- BANK DETAILS -->
                                    <div class="mb-3 mt-4">
                                        <h4><i class="fa-solid fa-building-columns"></i> Bank Details</h4>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Bank Name</label>
                                                <input type="text" name="bank_name" class="form-control"
                                                    value="{{ old('bank_name', $external_user->bank_name) }}"
                                                    placeholder="Enter Bank Name">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Account Holder Name</label>
                                                <input type="text" name="account_holder_name" class="form-control"
                                                    value="{{ old('account_holder_name', $external_user->account_holder_name) }}"
                                                    placeholder="Enter Account Holder Name">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Account Number</label>
                                                <input type="text" name="account_number" class="form-control"
                                                    value="{{ old('account_number', $external_user->account_number) }}"
                                                    placeholder="Enter Account Number">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">IFSC Code</label>
                                                <input type="text" name="ifsc_code" maxlength="11"
                                                    class="form-control text-uppercase"
                                                    value="{{ old('ifsc_code', $external_user->ifsc_code) }}"
                                                    placeholder="Enter IFSC Code">
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Passbook</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="file" name="bank_passBook_file" class="form-control"
                                                        accept=".pdf,.jpg,.jpeg,.png">

                                                    @if ($external_user->bank_passBook_file)
                                                        <a href="{{ asset('uploads/area-manager/' . $external_user->bank_passBook_file) }}"
                                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                                            <i class="bx bx-show me-1"></i> View Current File
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-secondary text-nowrap" disabled>
                                                            <i class="bx bx-file me-1"></i> No File
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- DRIVING LICENSE -->
                                    <div class="mb-3 mt-4">
                                        <h4><i class="fa-solid fa-id-card"></i> Driving License</h4>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Driving License Number</label>
                                                <input type="text" name="driving_license" class="form-control"
                                                    value="{{ old('driving_license', $external_user->driving_license) }}"
                                                    placeholder="Enter Driving License Number">
                                            </div>

                                            <div class="col-md-8">
                                                <label class="form-label">Driving License Document</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input type="file" name="driving_license_file"
                                                        class="form-control" accept=".pdf,.jpg,.jpeg,.png">

                                                    @if ($external_user->driving_license_file)
                                                        <a href="{{ asset('uploads/area-manager/' . $external_user->driving_license_file) }}"
                                                            target="_blank" class="btn btn-outline-primary text-nowrap">
                                                            <i class="bx bx-show me-1"></i> View Current File
                                                        </a>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-outline-secondary text-nowrap" disabled>
                                                            <i class="bx bx-file me-1"></i> No File
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">License Start Date</label>
                                                <input type="date" name="license_start_date" class="form-control"
                                                    value="{{ old('license_start_date', $external_user->license_start_date) }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">License End Date</label>
                                                <input type="date" name="license_end_date" class="form-control"
                                                    value="{{ old('license_end_date', $external_user->license_end_date) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- PERMISSIONS & PRIVACY -->
                                    <div class="mb-3">
                                        <h4><i class="fa-solid fa-shield-halved"></i> Permissions & Privacy</h4>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Notification Permission <span>*</span></label>

                                                    <div class="toggle-group" data-input="email_notification">
                                                        <button type="button"
                                                            class="toggle-btn {{ old('email_notification', $user->email_notification ?? 'yes') == 'yes' ? 'active' : '' }}"
                                                            data-value="yes">Yes</button>

                                                        <button type="button"
                                                            class="toggle-btn {{ old('email_notification', $user->email_notification ?? 'yes') == 'no' ? 'active' : '' }}"
                                                            data-value="no">No</button>
                                                    </div>

                                                    <input type="hidden" name="email_notification"
                                                        value="{{ old('email_notification', $user->email_notification ?? 'yes') }}">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Call, Text & Chat Consent <span>*</span></label>

                                                    <div class="toggle-group" data-input="call_text_chat_consent">
                                                        <button type="button"
                                                            class="toggle-btn {{ old('call_text_chat_consent', $user->call_text_chat_consent ?? 'yes') == 'yes' ? 'active' : '' }}"
                                                            data-value="yes">Yes</button>

                                                        <button type="button"
                                                            class="toggle-btn {{ old('call_text_chat_consent', $user->call_text_chat_consent ?? 'yes') == 'no' ? 'active' : '' }}"
                                                            data-value="no">No</button>
                                                    </div>

                                                    <input type="hidden" name="call_text_chat_consent"
                                                        value="{{ old('call_text_chat_consent', $user->call_text_chat_consent ?? 'yes') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="Primary-btn ml-auto d-table">
                                        Save Profile Details
                                    </button>

                                </form>

                            </div>

                            <!-- ================================= -->
                            <!-- CHANGE PASSWORD TAB -->
                            <!-- ================================= -->

                            <div class="tab-pane fade {{ $passwordTabActive ? 'show active' : '' }}" id="changePassword"
                                role="tabpanel">

                                <div class="password-content">

                                    <h4>
                                        <i class="fa-solid fa-lock"></i>
                                        Change Password
                                    </h4>

                                    <p class="password-description">
                                        Update your password to keep your account secure.
                                    </p>


                                    <!-- SEPARATE PASSWORD FORM -->
                                    <form method="POST" action="{{ route('password.update') }}"
                                        id="changePasswordForm">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-md-12 mb-3">

                                                <label for="current_password">
                                                    Current Password <span>*</span>
                                                </label>

                                                <div class="password-input-wrapper">

                                                    <input type="password" name="current_password" id="current_password"
                                                        class="form-control" placeholder="Enter Current Password"
                                                        required>

                                                    <i class="fa-regular fa-eye password-eye"
                                                        data-target="current_password"></i>

                                                </div>

                                                @error('current_password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>


                                            <!-- NEW PASSWORD -->
                                            <div class="col-md-6 mb-3">

                                                <label for="new_password">
                                                    New Password <span>*</span>
                                                </label>

                                                <div class="password-input-wrapper">

                                                    <input type="password" name="password" id="new_password"
                                                        class="form-control" placeholder="Enter New Password" required>

                                                    <i class="fa-regular fa-eye password-eye"
                                                        data-target="new_password"></i>

                                                </div>

                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror

                                            </div>


                                            <!-- CONFIRM PASSWORD -->
                                            <div class="col-md-6 mb-3">

                                                <label for="password_confirmation">
                                                    Confirm New Password <span>*</span>
                                                </label>

                                                <div class="password-input-wrapper">

                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control"
                                                        placeholder="Confirm New Password" required>

                                                    <i class="fa-regular fa-eye password-eye"
                                                        data-target="password_confirmation"></i>

                                                </div>

                                            </div>

                                        </div>


                                        <!-- UPDATE PASSWORD BUTTON -->
                                        <button type="submit" class="Primary-btn ml-auto d-table">

                                            <i class="fa-solid fa-key"></i>
                                            Update Password

                                        </button>

                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.toggle-group .toggle-btn').on('click', function() {

                let button = $(this);
                let group = button.closest('.toggle-group');

                let value = button.data('value');
                let inputName = group.data('input');

                group.find('.toggle-btn').removeClass('active');
                button.addClass('active');

                $('input[name="' + inputName + '"]').val(value);

            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show / hide password
            document.querySelectorAll('.password-eye').forEach(function(icon) {

                icon.addEventListener('click', function() {

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

        });
    </script>

    <script>
        $(document).ready(function() {

            let form = $('#mandatoryForm');

            let countryId = @json(Auth::user()->country_id);
            let stateId = @json(Auth::user()->state_id);
            let districtId = @json(Auth::user()->district_id);
            let cityId = @json(Auth::user()->city_id);
            let areaId = @json(Auth::user()->area_id);

            // Load Country
            if (countryId) {

                form.find('.location-country').val(countryId);

                // Load State
                loadStates(form, countryId, stateId).then(function() {

                    if (!stateId) return;

                    // Load District
                    return loadDistricts(
                        form,
                        countryId,
                        stateId,
                        districtId
                    );

                }).then(function() {

                    if (!districtId) return;

                    // Load City
                    return loadCities(
                        form,
                        countryId,
                        stateId,
                        districtId,
                        cityId
                    );

                }).then(function() {

                    if (!cityId) return;

                    // Load Area
                    return loadAreas(
                        form,
                        countryId,
                        stateId,
                        districtId,
                        cityId,
                        areaId
                    );

                }).catch(function(error) {

                    console.error('Location loading error:', error);

                });

            }

        });
    </script>


    <script>
        $(document).ready(function() {
            $('#mandatoryForm .location-country').on(
                'change',
                function() {

                    let form =
                        $('#mandatoryForm');

                    let country_id =
                        $(this).val();


                    form.find('.location-state')
                        .html(
                            '<option value="">Choose State</option>'
                        )
                        .prop('disabled', true);


                    form.find('.location-district')
                        .html(
                            '<option value="">Choose District</option>'
                        )
                        .prop('disabled', true);

                    form.find('.location-city')
                        .html(
                            '<option value="">Choose City</option>'
                        )
                        .prop('disabled', true);


                    form.find('.location-area')
                        .html(
                            '<option value="">Choose Area</option>'
                        )
                        .prop('disabled', true);

                    if (!country_id) {
                        return;
                    }

                    loadStates(
                        form,
                        country_id
                    );

                }
            );

            $('#mandatoryForm .location-state').on(
                'change',
                function() {

                    let form =
                        $('#mandatoryForm');

                    let country_id =
                        form.find('.location-country').val();

                    let state_id =
                        $(this).val();


                    form.find('.location-district')
                        .html(
                            '<option value="">Choose District</option>'
                        )
                        .prop('disabled', true);

                    form.find('.location-city')
                        .html(
                            '<option value="">Choose City</option>'
                        )
                        .prop('disabled', true);


                    form.find('.location-area')
                        .html(
                            '<option value="">Choose Area</option>'
                        )
                        .prop('disabled', true);

                    if (!state_id) {
                        return;
                    }


                    loadDistricts(
                        form,
                        country_id,
                        state_id
                    );

                }
            );


            $('#mandatoryProfileForm .location-district').on(
                'change',
                function() {

                    let form =
                        $('#mandatoryProfileForm');

                    let country_id =
                        form.find('.location-country').val();

                    let state_id =
                        form.find('.location-state').val();

                    let district_id =
                        $(this).val();


                    form.find('.location-city')
                        .html(
                            '<option value="">Choose City</option>'
                        )
                        .prop('disabled', true);


                    form.find('.location-area')
                        .html(
                            '<option value="">Choose Area</option>'
                        )
                        .prop('disabled', true);


                    if (!district_id) {
                        return;
                    }


                    loadCities(
                        form,
                        country_id,
                        state_id,
                        district_id
                    );

                }
            );

            $('#mandatoryProfileForm .location-city').on(
                'change',
                function() {

                    let form =
                        $('#mandatoryProfileForm');

                    let country_id =
                        form.find('.location-country').val();

                    let state_id =
                        form.find('.location-state').val();

                    let district_id =
                        form.find('.location-district').val();

                    let city_id =
                        $(this).val();


                    form.find('.location-area')
                        .html(
                            '<option value="">Choose Area</option>'
                        )
                        .prop('disabled', true);


                    if (!city_id) {
                        return;
                    }


                    loadAreas(
                        form,
                        country_id,
                        state_id,
                        district_id,
                        city_id
                    );

                }
            );
        })
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

            }).then(function(response) {

                state.html('<option value="">Choose State</option>');

                if (response.success) {

                    $.each(response.status, function(key, value) {

                        state.append(
                            `<option value="${value.id}">
                        ${value.name}
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

            return jQuery.ajax({

                url: "{{ route('location.fetch') }}",

                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                    type: "district",
                    country_id: country_id,
                    state_id: state_id
                }

            }).then(function(response) {

                district.html('<option value="">Choose District</option>');

                if (response.success) {

                    $.each(response.status, function(key, value) {

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

            }).then(function(response) {

                city.html('<option value="">Choose City</option>');

                if (response.success) {

                    $.each(response.status, function(key, value) {

                        city.append(
                            `<option value="${value.id}">
                        ${value.name}
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

            }).then(function(response) {

                area.html('<option value="">Choose Area</option>');

                if (response.success) {

                    $.each(response.status, function(key, value) {

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
    </script>


    <script>
        const profileInput = document.getElementById('profileImageInput');
        const profilePreview = document.getElementById('profilePreview');

        const defaultProfileImage = "{{ asset('images/default-profile.png') }}";

        // Preview selected image
        profileInput.addEventListener('change', function() {

            const file = this.files[0];

            if (!file) return;

            if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)) {
                toastr.error('Please select a JPG, PNG or WEBP image.');
                this.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                toastr.error('Image size must not exceed 2MB.');
                this.value = '';
                return;
            }

            profilePreview.src = URL.createObjectURL(file);
        });


        // Upload profile image
        document.getElementById('uploadProfileImage').addEventListener('click', function() {

            const file = profileInput.files[0];

            if (!file) {
                toastr.warning('Please choose an image first.');
                return;
            }

            const formData = new FormData();
            formData.append('profile_image', file);

            let button = this;
            button.disabled = true;

            fetch("{{ route('profile.image.upload') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async response => {

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Image upload failed.');
                    }

                    return data;
                })
                .then(data => {

                    profilePreview.src = data.image_url + '?t=' + Date.now();

                    profileInput.value = '';

                    toastr.success(data.message);

                })
                .catch(error => {

                    toastr.error(error.message);

                })
                .finally(() => {

                    button.disabled = false;

                });

        });


        // Delete profile image
        document.getElementById('deleteProfileImage').addEventListener('click', function() {

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to delete your profile image?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then(result => {

                if (!result.isConfirmed) return;

                let button = this;
                button.disabled = true;

                fetch("{{ route('profile.image.delete') }}", {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(async response => {

                        const data = await response.json();

                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Image deletion failed.');
                        }

                        return data;
                    })
                    .then(data => {

                        profilePreview.src = data.image_url + '?t=' + Date.now();

                        profileInput.value = '';

                        toastr.success(data.message);

                    })
                    .catch(error => {

                        toastr.error(error.message);

                    })
                    .finally(() => {

                        button.disabled = false;

                    });

            });

        });
    </script>
@endsection
