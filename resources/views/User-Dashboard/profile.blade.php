@extends('User-Dashboard.Layouts.App')

@section('main-content')

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
                            class="img-fluid"
                            id="profilePreview"
                            alt="Profile Image">
                    </div>

                    <div class="DetailsData">

                        <h4 class="mb-3">{{ Auth::user()->name }}</h4>
                        {{-- <h6>{{ Auth::user()->user_type ?? 'User' }}</h6> --}}

                        <div class="d-flex justify-content-center align-items-center">

                            <input type="file"
                                id="profileImageInput"
                                accept="image/jpeg,image/png,image/webp"
                                hidden>

                            <a href="javascript:void(0)"
                                class="choose_image"
                                onclick="document.getElementById('profileImageInput').click()">
                                <i class="fa-regular fa-images"></i> Choose
                            </a>

                            <button type="button"
                                class="action_btn upload"
                                id="uploadProfileImage">
                                <i class="fa-solid fa-upload"></i> Upload
                            </button>

                            <button type="button"
                                class="action_btn delete"
                                id="deleteProfileImage">
                                <i class="fa-solid fa-trash"></i> Delete
                            </button>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="user_form">
                    <form method="POST" id="mandatoryForm" action="{{ route('user.profile.update') }}">
                        @csrf
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-circle-user"></i> Account Details</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput1">Name <span>*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="First Name">
                                </div>
                                <div class="col">
                                    <label for="userForminput1"></label>
                                    <input type="text" class="form-control" name="middle_name" value="{{ Auth::user()->middle_name }}" placeholder="Middle Name">
                                </div>
                                <div class="col">
                                    <label for="userForminput1"></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Last Name">
                                </div>
                                
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput2">Email <span>*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Email" readonly>
                                </div>
                                <div class="col">
                                    <label for="userForminput3">Primary Mobile No<span>*</span></label>
                                    <input type="text" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="phone_number" placeholder="Primary Mobile No">
                                </div>
                                <div class="col">
                                    <label for="userForminput3">Secondary Mobile No</label>
                                    <input type="text" class="form-control" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="secondary_mobile" placeholder="Secondary Mobile No">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label class="d-block">Gender</label>

                                    <div class="d-flex align-items-center mt-2">
                                        <div class="form-check mr-4">
                                            <input class="form-check-input" type="radio"
                                                name="gender" id="male" value="male">
                                            <label class="form-check-label" for="male">Male</label>
                                        </div>

                                        <div class="form-check mr-4">
                                            <input class="form-check-input" type="radio"
                                                name="gender" id="female" value="female">
                                            <label class="form-check-label" for="female">Female</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                name="gender" id="other" value="other">
                                            <label class="form-check-label" for="other">Other</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="dob">Date Of Birth</label>
                                    <input type="date" name="dob" id="dob"
                                        class="form-control"
                                        max="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-sliders"></i> Preferences & Settings</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput7">Skill Level</label>
                                    <input type="text" class="form-control" name="skill_level" placeholder="">
                                </div>
                                <div class="col">
                                    <label for="userForminput8">Currency</label>
                                    <input type="text" class="form-control" placeholder="" name="currency">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput9">Time Zone</label>
                                    <input type="text" class="form-control" placeholder="" name="timezone">
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <h4><i class="fa-solid fa-map-location-dot"></i> Location Information</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput9">Country<span>*</span></label>
                                    <select name="country_id" class="form-control location-country" required>
                                        <option value="">
                                            Choose Country
                                        </option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ Auth::user()->country_id == $country->id ? 'selected' : '' }}>
                                                {{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="userForminput8">State<span>*</span></label>
                                    <select name="state_id" class="form-control location-state" disabled required>
                                        <option value="">
                                            Choose State
                                        </option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="userForminput8">District<span>*</span></label>
                                    <select name="district_id" class="form-control location-district" disabled required>
                                        <option value="">
                                            Choose District
                                        </option>
                                    </select>
                                </div>
                            </div>
                            

                        </div>
                        <div>
                            <h4> <i class="fa-solid fa-shield-halved"></i> permissions & Privacy</h4>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Email Notification Permission <span>*</span></label>

                                        <div class="toggle-group">
                                            <button class="toggle-btn active">Yes</button>
                                            <button class="toggle-btn">No</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Call, Text & Chat Consent <span>*</span></label>

                                        <div class="toggle-group">
                                            <button class="toggle-btn active">Yes</button>
                                            <button class="toggle-btn">No</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="submit" class="Primary-btn ml-auto d-table">Save Profile Details</button>
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

});
</script>

<script>
$(document).ready(function () {

    let form = $('#mandatoryForm');

    let countryId = @json(Auth::user()->country_id);
    let stateId = @json(Auth::user()->state_id);
    let districtId = @json(Auth::user()->district_id);

    if (countryId) {

        form.find('.location-country').val(countryId);

        loadStates(form, countryId, stateId).then(function () {

            if (stateId) {

                loadDistricts(
                    form,
                    countryId,
                    stateId,
                    districtId
                );

            }

        });

    }

});
</script>


<script>
$(document).ready(function() {
    $('#mandatoryForm .location-country').on(
        'change',
        function()
        {

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
        function()
        {

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
